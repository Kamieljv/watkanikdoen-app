<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('acties')->delete();
        
        \DB::table('acties')->insert(array (
            0 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'created_at' => '2021-11-29 16:26:00',
                'disobedient' => 1,
                'end_date' => '2025-02-06',
                'end_time' => '16:45:00',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'externe_link' => '#',
                'id' => 11,
                'image' => NULL,
                'keywords' => NULL,
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'ÂÄ]$m@' . "\0" . '‚19UJ@',
                'location_human' => 'De Dam, Amsterdam',
                'pageviews' => 324,
                'slug' => 'klimaatdemo-amsterdam',
                'start_date' => '2025-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Klimaatdemo',
                'updated_at' => '2022-01-04 08:57:30',
                'user_id' => 1,
            ),
            1 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'created_at' => '2021-12-02 18:26:00',
                'disobedient' => 0,
                'end_date' => '2025-02-06',
                'end_time' => '15:45:00',
                'excerpt' => NULL,
                'externe_link' => '#',
                'id' => 12,
                'image' => 'acties/pexels-paddy-o-sullivan-2369217-resize-500.jpg',
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'De Dam, Amsterdam',
                'pageviews' => 97,
                'slug' => 'black-lives-matter-amsterdam',
                'start_date' => '2025-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Black Lives Matter',
                'updated_at' => '2022-01-03 16:27:19',
                'user_id' => 1,
            ),
            2 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu felis sodales, ullamcorper diam quis, condimentum velit. Vestibulum nisl augue, mattis ultricies laoreet a, maximus vitae tellus. Aenean imperdiet, mauris vitae ornare convallis, sem massa hendrerit diam, auctor aliquet est augue scelerisque elit. Nam volutpat mi eget fringilla dignissim. Integer varius sagittis nisi vel viverra. Etiam sit amet feugiat ligula. Donec quis hendrerit purus. Duis placerat iaculis massa, ac imperdiet nisi luctus eget. Praesent vel massa vel arcu efficitur bibendum non a arcu. Quisque ornare facilisis enim dapibus auctor. Fusce laoreet nunc non massa auctor, sit amet blandit urna bibendum. Aliquam efficitur porttitor justo, a mollis orci egestas ac.</p>
<p>Phasellus aliquam laoreet nibh id auctor. Nulla auctor, nisl vel dictum tristique, lacus felis lacinia ligula, ac mollis velit justo ut magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elit magna, maximus id egestas in, elementum id turpis. Sed vitae neque vestibulum, auctor lacus elementum, elementum purus. Ut aliquet justo et lacus consequat hendrerit eget ac elit. Morbi rhoncus a dolor vel vehicula. Aliquam erat volutpat. Vivamus pulvinar mi sit amet libero finibus, ut sodales sapien gravida. Aliquam erat volutpat.</p>',
                'created_at' => '2021-12-08 09:00:00',
                'disobedient' => 1,
                'end_date' => '2025-02-09',
                'end_time' => '15:00:00',
                'excerpt' => NULL,
                'externe_link' => '#',
                'id' => 16,
                'image' => 'acties/pexels-markus-spiske-3039036-resize-500.jpg',
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'De Dam, Amsterdam',
                'pageviews' => 89,
                'slug' => 'kick-out-zwarte-piet',
                'start_date' => '2025-02-08',
                'start_time' => '09:00:00',
                'status' => 'PUBLISHED',
                'title' => 'Kick Out Zwarte Piet',
                'updated_at' => '2022-01-04 08:55:07',
                'user_id' => 1,
            ),
            3 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultrices tortor in auctor pulvinar. In enim enim, tristique a erat quis, venenatis facilisis dui. Maecenas eget ligula ut ipsum lobortis tristique in non diam. Pellentesque quis orci tempus, accumsan velit a, sodales sem. Ut elementum nunc viverra augue imperdiet euismod. Praesent venenatis tempus dolor. Maecenas venenatis laoreet sem et ultricies. Sed augue sapien, mollis a eros at, bibendum placerat arcu. Phasellus vitae dui gravida, semper augue non, sagittis lacus. Curabitur non metus eget quam consequat tincidunt. Duis feugiat dignissim felis. In egestas ante arcu, nec scelerisque quam suscipit sit amet. Aliquam et ex at sapien sodales pharetra nec at leo. Donec hendrerit pulvinar ipsum sit amet elementum. Pellentesque placerat enim ligula, cursus vulputate augue mollis vel.</p>',
                'created_at' => '2021-12-11 18:00:00',
                'disobedient' => 0,
                'end_date' => '2025-01-24',
                'end_time' => '19:00:00',
                'excerpt' => NULL,
                'externe_link' => '#',
                'id' => 17,
                'image' => 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg',
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'De Dam, Amsterdam',
                'pageviews' => 67,
                'slug' => 'woonprotest-amsterdam',
                'start_date' => '2025-01-15',
                'start_time' => '18:59:00',
                'status' => 'PUBLISHED',
                'title' => 'Woonprotest',
                'updated_at' => '2022-01-03 16:08:47',
                'user_id' => 1,
            ),
            4 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'created_at' => '2021-11-29 16:26:00',
                'disobedient' => 0,
                'end_date' => '2025-02-06',
                'end_time' => '15:45:00',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'externe_link' => '#',
                'id' => 19,
                'image' => NULL,
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'Jaarbeursplein, Utrecht',
                'pageviews' => 93,
                'slug' => 'klimaatdemo-utrecht',
                'start_date' => '2025-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Klimaatdemo',
                'updated_at' => '2022-01-04 08:58:26',
                'user_id' => 1,
            ),
            5 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'created_at' => '2021-11-29 16:26:00',
                'disobedient' => 0,
                'end_date' => '2025-02-06',
                'end_time' => '15:45:00',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'externe_link' => '#',
                'id' => 20,
                'image' => NULL,
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'Valkhofpark, Nijmegen',
                'pageviews' => 923,
                'slug' => 'klimaatdemo-nijmegen',
                'start_date' => '2025-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Klimaatdemo',
                'updated_at' => '2022-01-04 08:58:58',
                'user_id' => 1,
            ),
            6 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'created_at' => '2021-12-02 18:26:00',
                'disobedient' => 0,
                'end_date' => '2025-02-06',
                'end_time' => '15:45:00',
                'excerpt' => NULL,
                'externe_link' => 'https://utrecht.nl',
                'id' => 23,
                'image' => NULL,
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'Jaarbeursplein, Utrecht',
                'pageviews' => 123,
                'slug' => 'black-lives-matter-utrecht',
                'start_date' => '2025-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Black Lives Matter',
                'updated_at' => '2022-01-04 08:55:59',
                'user_id' => 1,
            ),
            7 => 
            array (
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'created_at' => '2021-12-02 18:26:00',
                'disobedient' => 0,
                'end_date' => '2023-02-06',
                'end_time' => '15:45:00',
                'excerpt' => NULL,
                'externe_link' => 'https://nijmegen.nl',
                'id' => 24,
                'image' => NULL,
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'Valkhofpark, Nijmegen',
                'pageviews' => 32,
                'slug' => 'black-lives-matter-nijmegen',
                'start_date' => '2023-02-06',
                'start_time' => '15:45:00',
                'status' => 'PUBLISHED',
                'title' => 'Black Lives Matter',
                'updated_at' => '2022-01-04 08:56:59',
                'user_id' => 1,
            ),
            8 => 
            array (
                'body' => '<p>Dit is de beschrijving. Lorem Ipsum lorem ipsum</p>',
                'created_at' => '2021-12-18 10:02:00',
                'disobedient' => 1,
                'end_date' => '2023-02-17',
                'end_time' => '10:02:00',
                'excerpt' => NULL,
                'externe_link' => 'https://partijvoordedieren.nl',
                'id' => 25,
                'image' => 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg',
                'keywords' => NULL,
                'location' => NULL,
                'location_human' => 'Museumplein, Amsterdam',
                'pageviews' => 89,
                'slug' => 'bio-industrie-protest',
                'start_date' => '2023-02-17',
                'start_time' => '10:02:00',
                'status' => 'PUBLISHED',
                'title' => 'Bio-industrie Protest',
                'updated_at' => '2022-01-21 10:05:51',
                'user_id' => 1,
            ),
        ));
        
        
    }
}