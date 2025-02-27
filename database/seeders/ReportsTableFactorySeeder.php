<?php

namespace Database\Seeders;



use App\Models\Actie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizer;
use App\Models\Report;
use DB;

class ReportsTableFactorySeeder extends Seeder
{
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
            #Select organizers
            $organizers = Organizer::all()
                            ->random(1)
                            ->pluck('id')
                            ->toArray();
        
            #Select Actie
            $actie = Actie::all()
                        ->random(1)
                        ->pluck('id')
                        ->toArray();

            #Update columns
            DB::table('reports')->where('id',$id)->update([
                'organizer_ids' => implode(',',$organizers),
                'actie_id'=> $actie[0],
            ]);
        }
    }
}
