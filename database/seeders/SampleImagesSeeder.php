<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SampleImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->command->confirm('Do you want to seed sample images? This will delete existing sample images.', true)) {
            $this->seedSampleImages();
        }
    }

    protected function seedSampleImages(): void
    {
        // Clear all existing sample images (starting with seed_)
        $storagePath = storage_path('app/public');
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/*/seed_*.png');
            foreach ($files as $file) {
                unlink($file);
            }
        }
        // Images and sizes to seed per model type
        $imagesToSeed = [
            'acties' => [
                'sizes' => [
                    [600, 400],
                    [400, 400],
                ],
                'numImages' => 10,
            ],
            'avatars' => [
                'sizes' => [
                    [100, 100],
                ],
                'numImages' => 2,
            ],
            'organizers' => [
                'sizes' => [
                    [300, 200],
                    [200, 200],
                ],
                'numImages' => 5,
            ],
            'referenties' => [
                'sizes' => [
                    [500, 300],
                    [300, 300],
                ],
                'numImages' => 8,
            ],
            'reports' => [
                'sizes' => [
                    [600, 400],
                    [400, 400],
                ],
                'numImages' => 5,
            ],
        ];
        $urlFormat = 'https://picsum.photos/%d/%d';

        foreach ($imagesToSeed as $index => $data) {
            $storagePath = storage_path('app/public/' . $index);

            foreach ($data['sizes'] as [$width, $height]) {
                $url = sprintf($urlFormat, $width, $height);

                for ($i = 0; $i < $data['numImages'] / count($data['sizes']); $i++) {
                    $imageContents = file_get_contents($url);
                    $imageName = 'seed_' . $index . '_' . $width . '_' . $height . '_' . $i . '.png';
                    file_put_contents($storagePath . '/' . $imageName, $imageContents);
                }
            }
        }
    }
}