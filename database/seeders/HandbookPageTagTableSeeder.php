<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HandbookPageTagTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('handbook_page_tag')->insert([
            [
                'handbook_page_id' => 1,
                'tag_id' => 1,
            ],
            [
                'handbook_page_id' => 1,
                'tag_id' => 3,
            ],
            [
                'handbook_page_id' => 3,
                'tag_id' => 2,
            ],
        ]);
    }
}
