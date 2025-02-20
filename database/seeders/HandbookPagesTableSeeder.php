<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HandbookPagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('handbook_pages')->insert([
            [
                'id' => 1,
                'title' => 'Getting Started',
                'slug' => 'getting-started',
                'content' => 'Welcome to the handbook. This guide will help you get started.',
                'parent_id' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Basic Concepts',
                'slug' => 'basic-concepts',
                'content' => 'Learn about the basic concepts and terminology.',
                'parent_id' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Advanced Topics',
                'slug' => 'advanced-topics',
                'content' => 'Dive into advanced topics and features.',
                'parent_id' => null,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
