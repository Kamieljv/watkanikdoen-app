<?php

namespace Database\Seeders;



use App\Models\Actie;
use App\Models\Image;
use Illuminate\Database\Seeder;
use App\Models\Organizer;
use App\Models\Report;
use DB;

class ReportsTableFactorySeeder extends Seeder
{

    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/reports starting with seed_
        $storagePath = storage_path('app/public/reports');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'reports/' . basename($file);
            }
        }
        return $imageFiles;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('reports')->delete();

        Report::factory()->count(10)->create();

        #Quantity of Reports
        $reports = Report::all()
                        ->pluck('id')
                        ->toArray();
        
        foreach($reports as $id){
            // Select organizers
            $organizers = Organizer::all()
                            ->random(1)
                            ->pluck('id')
                            ->toArray();
        
            // Select Actie
            $actie = Actie::all()
                        ->random(1)
                        ->pluck('id')
                        ->toArray();

            // Update columns
            DB::table('reports')->where('id',$id)->update([
                'organizer_ids' => implode(',',$organizers),
                'actie_id'=> $actie[0],
            ]);

            // Create image with report_id
            $imageMap = $this->getImageMap();
            Image::create([
                'path' => !empty($imageMap) ? $imageMap[array_rand($imageMap)] : null,
                'report_id' => $id,
            ]);
        }
    }
}
