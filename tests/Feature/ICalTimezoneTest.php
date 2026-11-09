<?php

namespace Tests\Feature;

use App\Models\Actie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ICalTimezoneTest extends TestCase
{
    use RefreshDatabase;

    private const TIMEZONE = 'Europe/Amsterdam';

    private function createActie(string $startDate, string $startTime, string $endDate, string $endTime): Actie
    {
        $user = User::factory()->create();

        return Actie::factory()->create([
            'user_id' => $user->id,
            'status' => 'PUBLISHED',
            'start_date' => $startDate,
            'start_time' => $startTime,
            'end_date' => $endDate,
            'end_time' => $endTime,
        ]);
    }

    /**
     * Fetch the .ics for an actie and return its unfolded lines.
     */
    private function getIcsLines(Actie $actie): array
    {
        $response = $this->get(route('ical.actie', $actie->slug));

        $response->assertOk();
        $this->assertStringStartsWith('text/calendar', $response->headers->get('Content-Type'));

        // Unfold folded lines (RFC 5545 §3.1) and split on CRLF/LF.
        $content = preg_replace("/\r?\n[ \t]/", '', $response->getContent());

        return preg_split("/\r?\n/", trim($content));
    }

    /**
     * Find a property line inside the VEVENT block (VTIMEZONE also has DTSTART lines).
     */
    private function findLine(array $lines, string $property): ?string
    {
        $inEvent = false;

        foreach ($lines as $line) {
            if ($line === 'BEGIN:VEVENT') {
                $inEvent = true;
            } elseif ($line === 'END:VEVENT') {
                $inEvent = false;
            } elseif ($inEvent && preg_match('/^' . preg_quote($property, '/') . '[;:]/', $line)) {
                return $line;
            }
        }

        return null;
    }

    public function test_app_timezone_is_europe_amsterdam(): void
    {
        $this->assertSame(self::TIMEZONE, config('app.timezone'));
        $this->assertSame(self::TIMEZONE, date_default_timezone_get());
    }

    public function test_actie_start_and_end_are_in_europe_amsterdam(): void
    {
        $actie = Actie::factory()->make([
            'start_date' => '2030-07-15',
            'start_time' => '14:00:00',
            'end_date' => '2030-07-15',
            'end_time' => '16:30:00',
        ]);

        $this->assertSame(self::TIMEZONE, $actie->start->getTimezone()->getName());
        $this->assertSame(self::TIMEZONE, $actie->end->getTimezone()->getName());

        // 14:00 CEST is 12:00 UTC
        $this->assertSame('2030-07-15 12:00:00', $actie->start->copy()->utc()->format('Y-m-d H:i:s'));
    }

    public function test_summer_event_is_exported_in_europe_amsterdam_timezone(): void
    {
        $year = now()->addYear()->year;
        $actie = $this->createActie("$year-07-15", '14:00:00', "$year-07-15", '16:30:00');

        $lines = $this->getIcsLines($actie);

        // Local wall-clock time, tagged with the Amsterdam TZID (not converted to UTC)
        $this->assertSame("DTSTART;TZID=Europe/Amsterdam:{$year}0715T140000", $this->findLine($lines, 'DTSTART'));
        $this->assertSame("DTEND;TZID=Europe/Amsterdam:{$year}0715T163000", $this->findLine($lines, 'DTEND'));

        // The calendar must define the referenced timezone, including the summer (CEST) offset
        $this->assertContains('TZID:Europe/Amsterdam', $lines);
        $this->assertContains('BEGIN:DAYLIGHT', $lines);
        $this->assertContains('TZOFFSETTO:+0200', $lines);
    }

    public function test_winter_event_is_exported_in_europe_amsterdam_timezone(): void
    {
        $year = now()->addYears(2)->year;
        $actie = $this->createActie("$year-01-15", '19:00:00', "$year-01-15", '21:00:00');

        $lines = $this->getIcsLines($actie);

        $this->assertSame("DTSTART;TZID=Europe/Amsterdam:{$year}0115T190000", $this->findLine($lines, 'DTSTART'));
        $this->assertSame("DTEND;TZID=Europe/Amsterdam:{$year}0115T210000", $this->findLine($lines, 'DTEND'));

        // Standard time (CET) offset must be defined
        $this->assertContains('TZID:Europe/Amsterdam', $lines);
        $this->assertContains('BEGIN:STANDARD', $lines);
        $this->assertContains('TZOFFSETTO:+0100', $lines);
    }

    public function test_event_times_are_not_exported_as_utc(): void
    {
        $year = now()->addYear()->year;
        $actie = $this->createActie("$year-07-15", '14:00:00', "$year-07-15", '16:30:00');

        $lines = $this->getIcsLines($actie);

        foreach (['DTSTART', 'DTEND'] as $property) {
            $line = $this->findLine($lines, $property);

            $this->assertNotNull($line, "$property missing from ics");
            $this->assertStringNotContainsString('TZID=UTC', $line);
            $this->assertStringEndsNotWith('Z', $line, "$property should not be a UTC timestamp");
        }
    }

    public function test_event_spanning_dst_change_uses_correct_local_times(): void
    {
        // Last Sunday of October: clocks go back from CEST to CET
        $year = now()->addYear()->year;
        $dstEnd = Carbon::parse("last sunday of october $year", self::TIMEZONE);
        $start = $dstEnd->copy()->subDay()->setTime(20, 0);
        $end = $dstEnd->copy()->setTime(10, 0);

        $actie = $this->createActie(
            $start->toDateString(), $start->toTimeString(),
            $end->toDateString(), $end->toTimeString(),
        );

        $lines = $this->getIcsLines($actie);

        $this->assertSame('DTSTART;TZID=Europe/Amsterdam:' . $start->format('Ymd\THis'), $this->findLine($lines, 'DTSTART'));
        $this->assertSame('DTEND;TZID=Europe/Amsterdam:' . $end->format('Ymd\THis'), $this->findLine($lines, 'DTEND'));

        // Both offsets must be present so clients can resolve each side of the change
        $this->assertContains('TZOFFSETTO:+0200', $lines);
        $this->assertContains('TZOFFSETTO:+0100', $lines);
    }
}
