<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use MWGuerra\FileManager\Models\FileSystemItem;

class UsersTableSeeder extends Seeder
{

    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/avatars starting with seed_
        $storagePath = storage_path('app/public/avatars');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'avatars/' . basename($file);
            }
        }
        return $imageFiles;
    }

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();

        DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Web Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$VY8t2wYOJOBxvvf5PhmxtO3MMYSOhPLNj9q9EXLnhD.jgvgL0Abd2',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => 'E1accom2Xw9MAjECL0g89GHwyWKDD5MAXXZKtVa99XCCh68ThKKeTFhmnfKa',
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2022-01-27 14:59:38',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => '$2y$10$VY8t2wYOJOBxvvf5PhmxtO3MMYSOhPLNj9q9EXLnhD.jgvgL0Abd2',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => 'z6b3X6Y2f6nJ5g3p1qW0JH1eXK3D1g4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u',
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2022-01-27 14:59:38',
            ),
        ));

        // Add an avatar to the non-admin user
        $user = \App\Models\User::find(2);
        $imageMap = $this->getImageMap();
        $storagePath = !empty($imageMap) ? $imageMap[array_rand($imageMap)] : null;
        if ($storagePath) {
            $folderId = FileSystemItem::where('name', 'avatars')
                ->where('type', 'folder')
                ->first()->id ?? null;
            
            $fileSystemItem = FileSystemItem::create([
                'parent_id' => $folderId,
                'name' => basename($storagePath),
                'type' => 'file',
                'file_type' => 'image',
                'size' => filesize(storage_path('app/public/' . $storagePath)),
                'storage_path' => $storagePath,
            ]);
            $user->image()->attach($fileSystemItem->id);
        }
    }
}
