<?php

namespace Database\Seeders;



use App\Models\Actie;
use App\Models\Image;
use App\Models\Organizer;
use App\Models\Report;
use Illuminate\Database\Seeder;
use MWGuerra\FileManager\Models\FileSystemItem;
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

    protected static function attachImage(Report $report, string $storagePath): void
    {
        // Find or create the folder in the file system
        $folderId = FileSystemItem::where('name', 'reports')
                 ->where('type', 'folder')
                 ->first()->id ?? null;
             
        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => $report->id . '_' . basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        // Attach the image to the report
        $report->image()->attach($fileSystemItem->id);
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
            $this->attachImage(Report::find($id), $imageMap[array_rand($imageMap)]);
        }
    }
}
