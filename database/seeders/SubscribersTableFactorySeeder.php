<?php

namespace Database\Seeders;


use App\Models\Subscriber;
use Illuminate\Database\Seeder;
use DB;

class SubscribersTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscribers')->delete();
        Subscriber::factory()->count(10)->create();
    }
}