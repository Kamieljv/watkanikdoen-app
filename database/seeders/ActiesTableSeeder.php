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
                'author_id' => 2,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>',
                'category_id' => 1,
                'created_at' => '2021-11-29 16:26:15',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.',
                'featured' => 0,
                'id' => 11,
                'image' => 'acties/November2021/wqjkXjNuFLcyFzVe2FmE.jpg',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'seo_title' => NULL,
                'slug' => 'klimaatdemo',
                'status' => 'PUBLISHED',
                'title' => 'Klimaatdemo',
                'updated_at' => '2021-11-30 13:29:18',
            ),
            1 => 
            array (
                'author_id' => 2,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>
<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>',
                'category_id' => 1,
                'created_at' => '2021-12-02 18:26:31',
                'excerpt' => NULL,
                'featured' => 0,
                'id' => 12,
                'image' => 'acties/November2021/yfojGFp140y9MfStJ16k.jpg',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'seo_title' => NULL,
                'slug' => 'black-lives-matter',
                'status' => 'PUBLISHED',
                'title' => 'Black Lives Matter',
                'updated_at' => '2021-12-03 17:24:18',
            ),
            2 => 
            array (
                'author_id' => 1,
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu felis sodales, ullamcorper diam quis, condimentum velit. Vestibulum nisl augue, mattis ultricies laoreet a, maximus vitae tellus. Aenean imperdiet, mauris vitae ornare convallis, sem massa hendrerit diam, auctor aliquet est augue scelerisque elit. Nam volutpat mi eget fringilla dignissim. Integer varius sagittis nisi vel viverra. Etiam sit amet feugiat ligula. Donec quis hendrerit purus. Duis placerat iaculis massa, ac imperdiet nisi luctus eget. Praesent vel massa vel arcu efficitur bibendum non a arcu. Quisque ornare facilisis enim dapibus auctor. Fusce laoreet nunc non massa auctor, sit amet blandit urna bibendum. Aliquam efficitur porttitor justo, a mollis orci egestas ac.</p>
<p>Phasellus aliquam laoreet nibh id auctor. Nulla auctor, nisl vel dictum tristique, lacus felis lacinia ligula, ac mollis velit justo ut magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elit magna, maximus id egestas in, elementum id turpis. Sed vitae neque vestibulum, auctor lacus elementum, elementum purus. Ut aliquet justo et lacus consequat hendrerit eget ac elit. Morbi rhoncus a dolor vel vehicula. Aliquam erat volutpat. Vivamus pulvinar mi sit amet libero finibus, ut sodales sapien gravida. Aliquam erat volutpat.</p>',
                'category_id' => 1,
                'created_at' => '2021-12-03 15:31:00',
                'excerpt' => NULL,
                'featured' => 0,
                'id' => 16,
                'image' => 'acties/December2021/L0SMqL5yXToSIjX7xGXx-cropped.jpg',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'seo_title' => NULL,
                'slug' => 'kick-out-zwarte-piet',
                'status' => 'PUBLISHED',
                'title' => 'Kick Out Zwarte Piet',
                'updated_at' => '2021-12-03 17:23:40',
            ),
        ));
        
        
    }
}