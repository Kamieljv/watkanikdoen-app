<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->insert([
            [
                'id' => 1,
                'name' => 'beginner',
                'slug' => 'beginner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'advanced',
                'slug' => 'advanced',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'tutorial',
                'slug' => 'tutorial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
