<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 2,
                'author_id' => 1,
                'title' => 'Over ons',
                'excerpt' => 'This is the about page.',
                'body' => '<p>Wave is the ultimate&nbsp;Software as a Service Starter kit. If you\'ve ever wanted to create your own SAAS application, Wave can help save you hundreds of hours. Wave is one of a kind and it is built on top of Laravel and Voyager. Building your application is going to be funner&nbsp;than ever before... Funner may not be a real word, but you get where I\'m trying to go.</p>
<p>Wave has a bunch of functionality built-in that will save you a bunch of time. Your users will be able to update their settings, billing information, profile information and so much more. You will also be able to accept&nbsp;payments from your user with multiple vendors.</p>
<p>We want to help you build the SAAS of your dreams by making it easier and less time-consuming. Let\'s start creating some "Waves" and build out the SAAS in your particular niche... Sorry about that Wave pun...</p>',
                'image' => NULL,
                'slug' => 'over-ons',
                'meta_description' => 'Over Wat Kan Ik Doen',
                'meta_keywords' => 'about',
                'status' => 'ACTIVE',
                'created_at' => '2018-03-30 03:04:51',
                'updated_at' => '2022-01-05 10:17:38',
            ),
            1 => 
            array (
                'id' => 3,
                'author_id' => 1,
                'title' => 'Privacybeleid',
                'excerpt' => 'Privacybeleid.',
                'body' => '<p>Privacybeleid.</p>',
                'image' => NULL,
                'slug' => 'privacybeleid',
                'meta_description' => 'privacybeleid',
                'meta_keywords' => 'privacy',
                'status' => 'ACTIVE',
                'created_at' => '2022-01-05 10:18:41',
                'updated_at' => '2022-01-05 10:20:05',
            ),
        ));
        
        
    }
}