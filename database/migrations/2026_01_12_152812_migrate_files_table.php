<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create a folder for each image type
        $imageTypes = ['acties', 'avatars', 'organizers', 'referenties', 'reports'];
        foreach ($imageTypes as $type) {
            \DB::table('file_system_items')->insert([
                'name' => $type,
                'type' => 'folder',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Migrate existing Images and relations from old table
        if (Schema::hasTable('images')) {
            $images = \DB::table('images')->get();

            foreach ($images as $image) {
                // Get the image type based on which id column is not null
                $imageType = null;
                if ($image->actie_id) {
                    $imageType = 'acties';
                    $class = 'App\\Models\\Actie';
                    $id = $image->actie_id;
                } elseif ($image->user_id) {
                    $imageType = 'avatars';
                    $class = 'App\\Models\\User';
                    $id = $image->user_id;
                } elseif ($image->organizer_id) {
                    $imageType = 'organizers';
                    $class = 'App\\Models\\Organizer';
                    $id = $image->organizer_id;
                } elseif ($image->referentie_id) {
                    $imageType = 'referenties';
                    $class = 'App\\Models\\Referentie';
                    $id = $image->referentie_id;
                } elseif ($image->report_id) {
                    $imageType = 'reports';
                    $class = 'App\\Models\\Report';
                    $id = $image->report_id;
                }

                // Get filename and extension from image path
                $filename = pathinfo($image->path, PATHINFO_FILENAME);
                $extension = pathinfo($image->path, PATHINFO_EXTENSION);

                // Determine parent_id for the image type folder
                $parent_id = \DB::table('file_system_items')
                    ->where('type', 'folder')
                    ->where('name', $imageType)
                    ->value('id');

                // Check if filename already exists in the table, if so, generate a postfix
                $existingCount = \DB::table('file_system_items')
                    ->where('parent_id', $parent_id)
                    ->where('name', 'LIKE', $filename . '%.' . $extension)
                    ->count();
                if ($existingCount > 0) {
                    $filename .= '_' . ($existingCount + 1);
                }

                // Insert into file_system_items
                $fileId = \DB::table('file_system_items')->insertGetId([
                    'parent_id' => $parent_id,
                    'name' => $filename . '.' . $extension,
                    'type' => 'file',
                    'file_type' => 'image',
                    'size' => $image->size * 1024, // Convert KB to bytes
                    'storage_path' => $image->path,
                    'created_at' => $image->created_at,
                    'updated_at' => $image->updated_at,
                ]);

                // Insert into file_has_models
                \DB::table('file_has_models')->insert([
                    'file_id' => $fileId,
                    'model_type' => $class,
                    'model_id' => $id,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Drop the file_has_models entries
        \DB::table('file_has_models')->delete();

        // Drop the file_system_items entries
        \DB::table('file_system_items')->delete();
    }
};
