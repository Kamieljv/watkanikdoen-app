<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('answers')->delete();
        
        \DB::table('answers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'answer' => 'Op straat',
                'question_id' => 2,
                'created_at' => '2024-06-02 09:47:00',
                'updated_at' => '2024-06-02 09:50:55',
            ),
            1 => 
            array (
                'id' => 2,
                'answer' => 'Vanuit huis',
                'question_id' => 2,
                'created_at' => '2024-06-02 09:51:18',
                'updated_at' => '2024-06-02 09:51:18',
            ),
            2 => 
            array (
                'id' => 3,
                'answer' => 'Zowel op straat als vanuit huis',
                'question_id' => 2,
                'created_at' => '2024-06-02 09:52:00',
                'updated_at' => '2024-06-02 09:53:07',
            ),
            3 => 
            array (
                'id' => 4,
            'answer' => 'Heel veel tijd (meer dan 2 dagen per week)',
                'question_id' => 4,
                'created_at' => '2024-06-02 09:59:00',
                'updated_at' => '2024-06-02 10:00:55',
            ),
            4 => 
            array (
                'id' => 5,
            'answer' => 'Veel tijd (meer dan een dag per week)',
                'question_id' => 4,
                'created_at' => '2024-06-02 10:00:00',
                'updated_at' => '2024-06-02 10:01:26',
            ),
            5 => 
            array (
                'id' => 6,
            'answer' => 'Een beetje tijd (een paar uur per week of minder)',
                'question_id' => 4,
                'created_at' => '2024-06-02 10:00:00',
                'updated_at' => '2025-02-18 17:43:02',
            ),
            6 => 
            array (
                'id' => 7,
                'answer' => 'Geen tijd',
                'question_id' => 4,
                'created_at' => '2024-06-02 10:00:00',
                'updated_at' => '2024-06-02 10:01:52',
            ),
            7 => 
            array (
                'id' => 8,
                'answer' => 'Veel geld',
                'question_id' => 3,
                'created_at' => '2024-06-02 10:03:00',
                'updated_at' => '2024-06-02 10:03:30',
            ),
            8 => 
            array (
                'id' => 9,
                'answer' => 'Een beetje geld',
                'question_id' => 3,
                'created_at' => '2024-06-02 10:03:00',
                'updated_at' => '2024-06-02 10:04:00',
            ),
            9 => 
            array (
                'id' => 10,
                'answer' => 'Geen geld',
                'question_id' => 3,
                'created_at' => '2024-06-02 10:03:00',
                'updated_at' => '2024-06-02 10:04:08',
            ),
            10 => 
            array (
                'id' => 17,
                'answer' => 'Liever alleen',
                'question_id' => 5,
                'created_at' => '2025-02-18 17:45:13',
                'updated_at' => '2025-02-18 17:45:13',
            ),
            11 => 
            array (
                'id' => 18,
                'answer' => 'Maakt niet zo veel uit',
                'question_id' => 5,
                'created_at' => '2025-02-18 17:45:23',
                'updated_at' => '2025-02-18 17:45:23',
            ),
            12 => 
            array (
                'id' => 19,
                'answer' => 'Liever samen',
                'question_id' => 5,
                'created_at' => '2025-02-18 17:45:31',
                'updated_at' => '2025-02-18 17:45:31',
            ),
            13 => 
            array (
                'id' => 20,
                'answer' => 'Ja, de politieke wereld spreekt me aan',
                'question_id' => 6,
                'created_at' => '2025-02-18 17:46:30',
                'updated_at' => '2025-02-18 17:46:30',
            ),
            14 => 
            array (
                'id' => 21,
                'answer' => 'Nee, de politiek is niets voor mij',
                'question_id' => 6,
                'created_at' => '2025-02-18 17:46:56',
                'updated_at' => '2025-02-18 17:46:56',
            ),
            15 => 
            array (
                'id' => 22,
                'answer' => 'Maakt niet zo veel uit',
                'question_id' => 6,
                'created_at' => '2025-02-18 17:47:06',
                'updated_at' => '2025-02-18 17:47:06',
            ),
        ));
        
        
    }
}