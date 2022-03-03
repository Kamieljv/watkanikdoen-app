<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ActieCategoryTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('actie_category')->delete();

        DB::table('actie_category')->insert(array (
            0 =>
            array (
                'id' => 11,
                'actie_id' => 16,
                'category_id' => 6,
            ),
            1 =>
            array (
                'id' => 12,
                'actie_id' => 17,
                'category_id' => 6,
            ),
            2 =>
            array (
                'id' => 13,
                'actie_id' => 12,
                'category_id' => 6,
            ),
            3 =>
            array (
                'id' => 14,
                'actie_id' => 11,
                'category_id' => 6,
            ),
            4 =>
            array (
                'id' => 15,
                'actie_id' => 23,
                'category_id' => 6,
            ),
            5 =>
            array (
                'id' => 16,
                'actie_id' => 24,
                'category_id' => 6,
            ),
            6 =>
            array (
                'id' => 17,
                'actie_id' => 19,
                'category_id' => 6,
            ),
            7 =>
            array (
                'id' => 18,
                'actie_id' => 20,
                'category_id' => 6,
            ),
            8 =>
            array (
                'id' => 19,
                'actie_id' => 25,
                'category_id' => 6,
            ),
        ));
    }
}
