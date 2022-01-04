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
                'id' => 11,
                'author_id' => 2,
                'title' => 'Klimaatdemo Amsterdam',
                'seo_title' => NULL,
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'externe_link' => '#',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 16:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'Õ¿ ¬@å lP6,J@',
                'location_human' => 'De Dam, Amsterdam',
                'image' => NULL,
                'slug' => 'klimaatdemo-amsterdam',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-11-29 16:26:00',
                'updated_at' => '2022-01-04 08:57:30',
            ),
            1 => 
            array (
                'id' => 12,
                'author_id' => 2,
                'title' => 'Black Lives Matter Amsterdam',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'externe_link' => '#',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 15:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'u“VŽ@oƒÀÊ1J@',
                'location_human' => 'De Dam, Amsterdam',
                'image' => 'acties/pexels-paddy-o-sullivan-2369217-resize-500.jpg',
                'slug' => 'black-lives-matter-amsterdam',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-12-02 18:26:00',
                'updated_at' => '2022-01-03 16:27:19',
            ),
            2 => 
            array (
                'id' => 16,
                'author_id' => 1,
                'title' => 'Kick Out Zwarte Piet',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu felis sodales, ullamcorper diam quis, condimentum velit. Vestibulum nisl augue, mattis ultricies laoreet a, maximus vitae tellus. Aenean imperdiet, mauris vitae ornare convallis, sem massa hendrerit diam, auctor aliquet est augue scelerisque elit. Nam volutpat mi eget fringilla dignissim. Integer varius sagittis nisi vel viverra. Etiam sit amet feugiat ligula. Donec quis hendrerit purus. Duis placerat iaculis massa, ac imperdiet nisi luctus eget. Praesent vel massa vel arcu efficitur bibendum non a arcu. Quisque ornare facilisis enim dapibus auctor. Fusce laoreet nunc non massa auctor, sit amet blandit urna bibendum. Aliquam efficitur porttitor justo, a mollis orci egestas ac.</p>
<p>Phasellus aliquam laoreet nibh id auctor. Nulla auctor, nisl vel dictum tristique, lacus felis lacinia ligula, ac mollis velit justo ut magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elit magna, maximus id egestas in, elementum id turpis. Sed vitae neque vestibulum, auctor lacus elementum, elementum purus. Ut aliquet justo et lacus consequat hendrerit eget ac elit. Morbi rhoncus a dolor vel vehicula. Aliquam erat volutpat. Vivamus pulvinar mi sit amet libero finibus, ut sodales sapien gravida. Aliquam erat volutpat.</p>',
                'externe_link' => '#',
                'time_start' => '2022-02-08 09:00:00',
                'time_end' => '2022-02-09 15:00:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'u“VŽ@oƒÀÊ1J@',
                'location_human' => 'De Dam, Amsterdam',
                'image' => 'acties/pexels-markus-spiske-3039036-resize-500.jpg',
                'slug' => 'kick-out-zwarte-piet',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-12-08 09:00:00',
                'updated_at' => '2022-01-04 08:55:07',
            ),
            3 => 
            array (
                'id' => 17,
                'author_id' => 1,
                'title' => 'Woonprotest Amsterdam',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultrices tortor in auctor pulvinar. In enim enim, tristique a erat quis, venenatis facilisis dui. Maecenas eget ligula ut ipsum lobortis tristique in non diam. Pellentesque quis orci tempus, accumsan velit a, sodales sem. Ut elementum nunc viverra augue imperdiet euismod. Praesent venenatis tempus dolor. Maecenas venenatis laoreet sem et ultricies. Sed augue sapien, mollis a eros at, bibendum placerat arcu. Phasellus vitae dui gravida, semper augue non, sagittis lacus. Curabitur non metus eget quam consequat tincidunt. Duis feugiat dignissim felis. In egestas ante arcu, nec scelerisque quam suscipit sit amet. Aliquam et ex at sapien sodales pharetra nec at leo. Donec hendrerit pulvinar ipsum sit amet elementum. Pellentesque placerat enim ligula, cursus vulputate augue mollis vel.</p>',
                'externe_link' => '#',
                'time_start' => '2022-01-15 18:59:00',
                'time_end' => '2022-01-24 19:00:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'u“VŽ@oƒÀÊ1J@',
                'location_human' => 'De Dam, Amsterdam',
                'image' => 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg',
                'slug' => 'woonprotest-amsterdam',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-12-11 18:00:00',
                'updated_at' => '2022-01-03 16:08:47',
            ),
            4 => 
            array (
                'id' => 19,
                'author_id' => 2,
                'title' => 'Klimaatdemo Utrecht',
                'seo_title' => NULL,
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'externe_link' => '#',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 15:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'QÎ^Õt@Û—d
J@',
                'location_human' => 'Jaarbeursplein, Utrecht',
                'image' => NULL,
                'slug' => 'klimaatdemo-utrecht',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-11-29 16:26:00',
                'updated_at' => '2022-01-04 08:58:26',
            ),
            5 => 
            array (
                'id' => 20,
                'author_id' => 2,
                'title' => 'Klimaatdemo Nijmegen',
                'seo_title' => NULL,
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'externe_link' => '#',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 15:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'S;uðEa@<ý@þôëI@',
                'location_human' => 'Valkhofpark, Nijmegen',
                'image' => NULL,
                'slug' => 'klimaatdemo-nijmegen',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-11-29 16:26:00',
                'updated_at' => '2022-01-04 08:58:58',
            ),
            6 => 
            array (
                'id' => 23,
                'author_id' => 2,
                'title' => 'Black Lives Matter Utrecht',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'externe_link' => 'https://utrecht.nl',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 15:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'sBÔDÚp@’ýŽ§ü
J@',
                'location_human' => 'Jaarbeursplein, Utrecht',
                'image' => NULL,
                'slug' => 'black-lives-matter-utrecht',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-12-02 18:26:00',
                'updated_at' => '2022-01-04 08:55:59',
            ),
            7 => 
            array (
                'id' => 24,
                'author_id' => 2,
                'title' => 'Black Lives Matter Nijmegen',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'externe_link' => 'https://nijmegen.nl',
                'time_start' => '2022-02-06 15:45:00',
                'time_end' => '2022-02-06 15:45:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'Yêà‹Ff@+ruw$ëI@',
                'location_human' => 'Valkhofpark, Nijmegen',
                'image' => NULL,
                'slug' => 'black-lives-matter-nijmegen',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2021-12-02 18:26:00',
                'updated_at' => '2022-01-04 08:56:59',
            ),
            8 => 
            array (
                'id' => 25,
                'author_id' => 1,
                'title' => 'Bio-industrie Protest',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p>Dit is de beschrijving. Lorem Ipsum lorem ipsum</p>',
                'externe_link' => 'https://partijvoordedieren.nl',
                'time_start' => '2022-02-17 10:02:00',
                'time_end' => '2022-02-18 10:02:00',
                'location' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . 'u“VŽ@oƒÀÊ1J@',
                'location_human' => 'Museumplein, Amsterdam',
                'image' => 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg',
                'slug' => 'bio-industrie-protest',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2022-01-04 09:03:00',
                'updated_at' => '2022-01-04 09:09:09',
            ),
        ));
        
        
    }
}