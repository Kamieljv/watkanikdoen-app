<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UmamiStatsWidget extends Widget
{
    protected string $view = 'filament.widgets.umami-stats';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public int $days = 7;

    public function setPeriod(int $days): void
    {
        $this->days = $days;
    }

    public function getStats(): array
    {
        return Cache::remember('umami_stats_' . $this->days, now()->addMinutes(30), function () {
            try {
                // Get current period stats
                $currentStats = $this->fetchUmamiStats($this->days, 0);
                
                // Get previous period stats for comparison
                $previousStats = $this->fetchUmamiStats($this->days * 2, $this->days);
                
                return $this->processStats($currentStats, $previousStats);
            } catch (\Exception $e) {
                \Log::error('Umami stats fetch failed: ' . $e->getMessage());
                return $this->getDefaultStats();
            }
        });
    }

    protected function fetchUmamiStats(int $startDaysAgo, int $endDaysAgo): array
    {
        $url = config('umami.url');
        $username = config('umami.username');
        $password = config('umami.password');
        $websiteId = config('umami.websiteId');

        // Authenticate
        $authResponse = Http::post("{$url}/api/auth/login", [
            'username' => $username,
            'password' => $password,
        ]);

        if (!$authResponse->successful()) {
            throw new \Exception('Umami authentication failed');
        }

        $token = $authResponse->json('token');

        // Get millisecond timestamps for the API
        // startAt is 0:00 seven days ago, endAt is today at 23:59:59
        $startAt = now()->subDays($startDaysAgo)->timestamp * 1000;
        $endAt = now()->subDays($endDaysAgo)->timestamp * 1000;

        $statsResponse = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->get("{$url}/api/websites/{$websiteId}/stats", [
            'startAt' => $startAt,
            'endAt' => $endAt,
        ]);

        if (!$statsResponse->successful()) {
            throw new \Exception('Umami stats fetch failed');
        }

        return $statsResponse->json();
    }

    protected function processStats(array $current, array $previous): array
    {
        $stats = [];

        // Pageviews
        $stats['pageviews'] = [
            'value' => $current['pageviews']['value'] ?? 0,
            'change' => ($current['pageviews']['value'] ?? 0) - ($previous['pageviews']['value'] ?? 0),
            'label' => 'Views',
        ];

        // Visitors
        $stats['visitors'] = [
            'value' => $current['visitors']['value'] ?? 0,
            'change' => ($current['visitors']['value'] ?? 0) - ($previous['visitors']['value'] ?? 0),
            'label' => 'Bezoekers',
        ];

        // Bounce rate
        $currentBounces = $current['bounces']['value'] ?? 0;
        $currentVisitors = $current['visitors']['value'] ?? 1;
        $previousBounces = $previous['bounces']['value'] ?? 0;
        $previousVisitors = $previous['visitors']['value'] ?? 1;

        $currentBounceRate = $currentVisitors > 0 ? ($currentBounces / $currentVisitors) * 100 : 0;
        $previousBounceRate = $previousVisitors > 0 ? ($previousBounces / $previousVisitors) * 100 : 0;

        $stats['bouncerate'] = [
            'value' => round($currentBounceRate, 0),
            'change' => round($currentBounceRate - $previousBounceRate, 0),
            'label' => 'Bounce rate',
            'suffix' => '%',
            'inverse' => true, // Higher is worse
        ];

        // Average time
        $currentTotalTime = $current['totaltime']['value'] ?? 0;
        $currentPageviews = $current['pageviews']['value'] ?? 1;
        $currentBounces = $current['bounces']['value'] ?? 0;
        
        $previousTotalTime = $previous['totaltime']['value'] ?? 0;
        $previousPageviews = $previous['pageviews']['value'] ?? 1;
        $previousBounces = $previous['bounces']['value'] ?? 0;

        $currentAvgTime = ($currentPageviews - $currentBounces) > 0 
            ? $currentTotalTime / ($currentPageviews - $currentBounces) 
            : 0;
        
        $previousAvgTime = ($previousPageviews - $previousBounces) > 0 
            ? $previousTotalTime / ($previousPageviews - $previousBounces) 
            : 0;

        $stats['avgtime'] = [
            'value' => $currentAvgTime,
            'change' => $currentAvgTime - $previousAvgTime,
            'label' => 'Gem. bezoektijd',
            'format' => 'time',
        ];

        return $stats;
    }

    protected function getDefaultStats(): array
    {
        return [
            'pageviews' => ['value' => 'N/A', 'change' => 0, 'label' => 'Views'],
            'visitors' => ['value' => 'N/A', 'change' => 0, 'label' => 'Bezoekers'],
            'bouncerate' => ['value' => 'N/A', 'change' => 0, 'label' => 'Bounce rate', 'suffix' => '%'],
            'avgtime' => ['value' => 'N/A', 'change' => 0, 'label' => 'Gem. bezoektijd', 'format' => 'time'],
        ];
    }

    public function formatTime(float $seconds): string
    {
        $minutes = floor(abs($seconds) / 60);
        $secs = abs($seconds) % 60;
        
        $result = '';
        if ($minutes > 0) {
            $result .= "{$minutes}m ";
        }
        if ($secs > 0 || $result === '') {
            $result .= round($secs) . "s";
        }
        
        return ($seconds < 0 ? '-' : '') . trim($result);
    }
}
