<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('translations')->delete();
        
        \DB::table('translations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Post',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            1 => 
            array (
                'id' => 2,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Página',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            2 => 
            array (
                'id' => 3,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Utilizador',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            3 => 
            array (
                'id' => 4,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Categoria',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            4 => 
            array (
                'id' => 5,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Menu',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            5 => 
            array (
                'id' => 6,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Função',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            6 => 
            array (
                'id' => 7,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Posts',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            7 => 
            array (
                'id' => 8,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Páginas',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            8 => 
            array (
                'id' => 9,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Utilizadores',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            9 => 
            array (
                'id' => 10,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Categorias',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            10 => 
            array (
                'id' => 11,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Menus',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            11 => 
            array (
                'id' => 12,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Funções',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            12 => 
            array (
                'id' => 13,
                'table_name' => 'categories',
                'column_name' => 'slug',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'categoria-1',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            13 => 
            array (
                'id' => 14,
                'table_name' => 'categories',
                'column_name' => 'name',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Categoria 1',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            14 => 
            array (
                'id' => 15,
                'table_name' => 'categories',
                'column_name' => 'slug',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'categoria-2',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            15 => 
            array (
                'id' => 16,
                'table_name' => 'categories',
                'column_name' => 'name',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Categoria 2',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            16 => 
            array (
                'id' => 17,
                'table_name' => 'pages',
                'column_name' => 'title',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Olá Mundo',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            17 => 
            array (
                'id' => 18,
                'table_name' => 'pages',
                'column_name' => 'slug',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'ola-mundo',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            18 => 
            array (
                'id' => 19,
                'table_name' => 'pages',
                'column_name' => 'body',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>
<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            19 => 
            array (
                'id' => 20,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 1,
                'locale' => 'pt',
                'value' => 'Painel de Controle',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            20 => 
            array (
                'id' => 21,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 2,
                'locale' => 'pt',
                'value' => 'Media',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            21 => 
            array (
                'id' => 22,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 3,
                'locale' => 'pt',
                'value' => 'Publicações',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            22 => 
            array (
                'id' => 23,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 4,
                'locale' => 'pt',
                'value' => 'Utilizadores',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            23 => 
            array (
                'id' => 24,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 5,
                'locale' => 'pt',
                'value' => 'Categorias',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            24 => 
            array (
                'id' => 25,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 6,
                'locale' => 'pt',
                'value' => 'Páginas',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            25 => 
            array (
                'id' => 26,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 7,
                'locale' => 'pt',
                'value' => 'Funções',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            26 => 
            array (
                'id' => 27,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 8,
                'locale' => 'pt',
                'value' => 'Ferramentas',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            27 => 
            array (
                'id' => 28,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 9,
                'locale' => 'pt',
                'value' => 'Menus',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            28 => 
            array (
                'id' => 29,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 10,
                'locale' => 'pt',
                'value' => 'Base de dados',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            29 => 
            array (
                'id' => 30,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 13,
                'locale' => 'pt',
                'value' => 'Configurações',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
            30 => 
            array (
                'id' => 31,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 77,
                'locale' => 'en',
                'value' => 'Id',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            31 => 
            array (
                'id' => 32,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 78,
                'locale' => 'en',
                'value' => 'Title',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            32 => 
            array (
                'id' => 33,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 79,
                'locale' => 'en',
                'value' => 'Excerpt',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            33 => 
            array (
                'id' => 34,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 81,
                'locale' => 'en',
                'value' => 'Created At',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            34 => 
            array (
                'id' => 35,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 82,
                'locale' => 'en',
                'value' => 'Updated At',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            35 => 
            array (
                'id' => 36,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 9,
                'locale' => 'en',
                'value' => 'Event',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            36 => 
            array (
                'id' => 37,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 9,
                'locale' => 'en',
                'value' => 'Events',
                'created_at' => '2021-11-29 13:27:22',
                'updated_at' => '2021-11-29 13:27:22',
            ),
            37 => 
            array (
                'id' => 38,
                'table_name' => 'pages',
                'column_name' => 'title',
                'foreign_key' => 2,
                'locale' => 'en',
                'value' => 'About',
                'created_at' => '2021-11-30 12:38:41',
                'updated_at' => '2021-11-30 12:38:41',
            ),
            38 => 
            array (
                'id' => 39,
                'table_name' => 'pages',
                'column_name' => 'body',
                'foreign_key' => 2,
                'locale' => 'en',
                'value' => '<p>Wave is the ultimate&nbsp;Software as a Service Starter kit. If you\'ve ever wanted to create your own SAAS application, Wave can help save you hundreds of hours. Wave is one of a kind and it is built on top of Laravel and Voyager. Building your application is going to be funner&nbsp;than ever before... Funner may not be a real word, but you get where I\'m trying to go.</p>
<p>Wave has a bunch of functionality built-in that will save you a bunch of time. Your users will be able to update their settings, billing information, profile information and so much more. You will also be able to accept&nbsp;payments from your user with multiple vendors.</p>
<p>We want to help you build the SAAS of your dreams by making it easier and less time-consuming. Let\'s start creating some "Waves" and build out the SAAS in your particular niche... Sorry about that Wave pun...</p>',
                'created_at' => '2021-11-30 12:38:41',
                'updated_at' => '2021-11-30 12:38:41',
            ),
            39 => 
            array (
                'id' => 40,
                'table_name' => 'pages',
                'column_name' => 'slug',
                'foreign_key' => 2,
                'locale' => 'en',
                'value' => 'about',
                'created_at' => '2021-11-30 12:38:41',
                'updated_at' => '2021-11-30 12:38:41',
            ),
            40 => 
            array (
                'id' => 41,
                'table_name' => 'posts',
                'column_name' => 'title',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => 'Best ways to market your application',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            41 => 
            array (
                'id' => 42,
                'table_name' => 'posts',
                'column_name' => 'body',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => '<p>There are many different ways to market your application. First, let\'s start off at the beginning and then we will get more in-depth. You\'ll want to discover your target audience and after that, you\'ll want to run some ads.</p>
<p>Let\'s not complicate things here, if you build a good product, you are going to have users. But you will need to let your users know where to find you. This is where social media and ads come in to play. You\'ll need to boast about your product and your app. If it\'s something that you really believe in, the odds are others will too.</p>
<blockquote>
<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>
</blockquote>
<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>
<h2>Seamlessly promote flexible growth strategies.</h2>
<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p> Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>
<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>
<h3>Seamlessly promote flexible growth strategies.</h3>
<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>
<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />
<figcaption>Keep working until you find success.</figcaption>
</figure>
<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>
<h4>Seamlessly promote flexible growth strategies.</h4>
<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>
<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>
<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            42 => 
            array (
                'id' => 43,
                'table_name' => 'posts',
                'column_name' => 'slug',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => 'best-ways-to-market-your-application',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            43 => 
            array (
                'id' => 44,
                'table_name' => 'posts',
                'column_name' => 'meta_description',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => 'Find out the best ways to market your application in this article.',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            44 => 
            array (
                'id' => 45,
                'table_name' => 'posts',
                'column_name' => 'meta_keywords',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => 'market, saas, market your app',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            45 => 
            array (
                'id' => 46,
                'table_name' => 'posts',
                'column_name' => 'seo_title',
                'foreign_key' => 5,
                'locale' => 'en',
                'value' => 'Best ways to market your application',
                'created_at' => '2021-11-30 12:39:16',
                'updated_at' => '2021-11-30 12:39:16',
            ),
            46 => 
            array (
                'id' => 47,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 93,
                'locale' => 'en',
                'value' => 'ID',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            47 => 
            array (
                'id' => 48,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 94,
                'locale' => 'en',
                'value' => 'Author',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            48 => 
            array (
                'id' => 49,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 95,
                'locale' => 'en',
                'value' => 'Category',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            49 => 
            array (
                'id' => 50,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 96,
                'locale' => 'en',
                'value' => 'Title',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            50 => 
            array (
                'id' => 51,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 97,
                'locale' => 'en',
                'value' => 'excerpt',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            51 => 
            array (
                'id' => 52,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 98,
                'locale' => 'en',
                'value' => 'Body',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            52 => 
            array (
                'id' => 53,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 99,
                'locale' => 'en',
                'value' => 'Post Image',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            53 => 
            array (
                'id' => 54,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 100,
                'locale' => 'en',
                'value' => 'slug',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            54 => 
            array (
                'id' => 55,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 101,
                'locale' => 'en',
                'value' => 'meta_description',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            55 => 
            array (
                'id' => 56,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 102,
                'locale' => 'en',
                'value' => 'meta_keywords',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            56 => 
            array (
                'id' => 57,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 103,
                'locale' => 'en',
                'value' => 'status',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            57 => 
            array (
                'id' => 58,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 104,
                'locale' => 'en',
                'value' => 'created_at',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            58 => 
            array (
                'id' => 59,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 105,
                'locale' => 'en',
                'value' => 'updated_at',
                'created_at' => '2021-11-30 13:30:47',
                'updated_at' => '2021-11-30 13:30:47',
            ),
            59 => 
            array (
                'id' => 60,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 120,
                'locale' => 'en',
                'value' => 'Seo Title',
                'created_at' => '2021-11-30 13:35:12',
                'updated_at' => '2021-11-30 13:35:12',
            ),
            60 => 
            array (
                'id' => 61,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 121,
                'locale' => 'en',
                'value' => 'Featured',
                'created_at' => '2021-11-30 13:35:12',
                'updated_at' => '2021-11-30 13:35:12',
            ),
            61 => 
            array (
                'id' => 65,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 34,
                'locale' => 'en',
                'value' => 'Events',
                'created_at' => '2021-12-06 10:22:59',
                'updated_at' => '2021-12-06 10:22:59',
            ),
            62 => 
            array (
                'id' => 66,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 122,
                'locale' => 'en',
                'value' => 'Id',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            63 => 
            array (
                'id' => 67,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 123,
                'locale' => 'en',
                'value' => 'Author Id',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            64 => 
            array (
                'id' => 68,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 124,
                'locale' => 'en',
                'value' => 'Category Id',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            65 => 
            array (
                'id' => 69,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 125,
                'locale' => 'en',
                'value' => 'Title',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            66 => 
            array (
                'id' => 70,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 126,
                'locale' => 'en',
                'value' => 'Seo Title',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            67 => 
            array (
                'id' => 71,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 127,
                'locale' => 'en',
                'value' => 'Excerpt',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            68 => 
            array (
                'id' => 72,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 128,
                'locale' => 'en',
                'value' => 'Body',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            69 => 
            array (
                'id' => 73,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 129,
                'locale' => 'en',
                'value' => 'Image',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            70 => 
            array (
                'id' => 74,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 130,
                'locale' => 'en',
                'value' => 'Slug',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            71 => 
            array (
                'id' => 75,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 131,
                'locale' => 'en',
                'value' => 'Meta Description',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            72 => 
            array (
                'id' => 76,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 132,
                'locale' => 'en',
                'value' => 'Meta Keywords',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            73 => 
            array (
                'id' => 77,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 133,
                'locale' => 'en',
                'value' => 'Status',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            74 => 
            array (
                'id' => 78,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 134,
                'locale' => 'en',
                'value' => 'Featured',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            75 => 
            array (
                'id' => 79,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 135,
                'locale' => 'en',
                'value' => 'Created At',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            76 => 
            array (
                'id' => 80,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 136,
                'locale' => 'en',
                'value' => 'Updated At',
                'created_at' => '2021-12-06 10:38:21',
                'updated_at' => '2021-12-06 10:38:21',
            ),
            77 => 
            array (
                'id' => 81,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 39,
                'locale' => 'en',
                'value' => 'id',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            78 => 
            array (
                'id' => 82,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 40,
                'locale' => 'en',
                'value' => 'parent_id',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            79 => 
            array (
                'id' => 83,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 41,
                'locale' => 'en',
                'value' => 'order',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            80 => 
            array (
                'id' => 84,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 42,
                'locale' => 'en',
                'value' => 'name',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            81 => 
            array (
                'id' => 85,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 43,
                'locale' => 'en',
                'value' => 'slug',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            82 => 
            array (
                'id' => 86,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 44,
                'locale' => 'en',
                'value' => 'created_at',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            83 => 
            array (
                'id' => 87,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 45,
                'locale' => 'en',
                'value' => 'updated_at',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            84 => 
            array (
                'id' => 88,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 4,
                'locale' => 'en',
                'value' => 'Category',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            85 => 
            array (
                'id' => 89,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 4,
                'locale' => 'en',
                'value' => 'Categories',
                'created_at' => '2021-12-06 11:11:11',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            86 => 
            array (
                'id' => 90,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 137,
                'locale' => 'en',
                'value' => 'categories',
                'created_at' => '2021-12-06 14:00:52',
                'updated_at' => '2021-12-06 14:00:52',
            ),
            87 => 
            array (
                'id' => 91,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 139,
                'locale' => 'en',
                'value' => 'Time Start',
                'created_at' => '2021-12-06 14:50:30',
                'updated_at' => '2021-12-06 14:50:30',
            ),
            88 => 
            array (
                'id' => 92,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 140,
                'locale' => 'en',
                'value' => 'Time End',
                'created_at' => '2021-12-06 14:50:30',
                'updated_at' => '2021-12-06 14:50:30',
            ),
            89 => 
            array (
                'id' => 93,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 141,
                'locale' => 'en',
                'value' => 'Location',
                'created_at' => '2021-12-06 14:50:30',
                'updated_at' => '2021-12-06 14:50:30',
            ),
            90 => 
            array (
                'id' => 94,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 142,
                'locale' => 'en',
                'value' => 'Location Human',
                'created_at' => '2021-12-06 14:50:30',
                'updated_at' => '2021-12-06 14:50:30',
            ),
            91 => 
            array (
                'id' => 95,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 145,
                'locale' => 'en',
                'value' => 'Location',
                'created_at' => '2021-12-10 17:02:15',
                'updated_at' => '2021-12-10 17:02:15',
            ),
            92 => 
            array (
                'id' => 96,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 36,
                'locale' => 'en',
                'value' => 'Actie Themes',
                'created_at' => '2021-12-20 12:58:14',
                'updated_at' => '2021-12-20 12:58:14',
            ),
            93 => 
            array (
                'id' => 97,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 38,
                'locale' => 'en',
                'value' => 'Acties & meer',
                'created_at' => '2021-12-21 15:14:34',
                'updated_at' => '2021-12-21 15:14:34',
            ),
            94 => 
            array (
                'id' => 98,
                'table_name' => 'menu_items',
                'column_name' => 'title',
                'foreign_key' => 37,
                'locale' => 'en',
                'value' => 'Accounts',
                'created_at' => '2021-12-21 15:18:02',
                'updated_at' => '2021-12-21 15:18:02',
            ),
            95 => 
            array (
                'id' => 99,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 153,
                'locale' => 'en',
                'value' => 'themes',
                'created_at' => '2021-12-31 11:42:22',
                'updated_at' => '2021-12-31 11:42:22',
            ),
            96 => 
            array (
                'id' => 100,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 154,
                'locale' => 'en',
                'value' => 'Externe Link',
                'created_at' => '2022-01-03 16:09:54',
                'updated_at' => '2022-01-03 16:09:54',
            ),
            97 => 
            array (
                'id' => 101,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 163,
                'locale' => 'en',
                'value' => 'organizers',
                'created_at' => '2022-01-03 16:09:54',
                'updated_at' => '2022-01-03 16:09:54',
            ),
            98 => 
            array (
                'id' => 102,
                'table_name' => 'pages',
                'column_name' => 'title',
                'foreign_key' => 3,
                'locale' => 'en',
                'value' => 'Privacybeleid',
                'created_at' => '2022-01-05 10:20:05',
                'updated_at' => '2022-01-05 10:20:05',
            ),
            99 => 
            array (
                'id' => 103,
                'table_name' => 'pages',
                'column_name' => 'body',
                'foreign_key' => 3,
                'locale' => 'en',
                'value' => '<p>Privacybeleid.</p>',
                'created_at' => '2022-01-05 10:20:05',
                'updated_at' => '2022-01-05 10:20:05',
            ),
            100 => 
            array (
                'id' => 104,
                'table_name' => 'pages',
                'column_name' => 'slug',
                'foreign_key' => 3,
                'locale' => 'en',
                'value' => 'privacybeleid',
                'created_at' => '2022-01-05 10:20:05',
                'updated_at' => '2022-01-05 10:20:05',
            ),
            101 => 
            array (
                'id' => 105,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 14,
                'locale' => 'en',
                'value' => 'id',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            102 => 
            array (
                'id' => 106,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 15,
                'locale' => 'en',
                'value' => 'author_id',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            103 => 
            array (
                'id' => 107,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 16,
                'locale' => 'en',
                'value' => 'title',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            104 => 
            array (
                'id' => 108,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 17,
                'locale' => 'en',
                'value' => 'excerpt',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            105 => 
            array (
                'id' => 109,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 18,
                'locale' => 'en',
                'value' => 'body',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            106 => 
            array (
                'id' => 110,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 25,
                'locale' => 'en',
                'value' => 'image',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            107 => 
            array (
                'id' => 111,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 19,
                'locale' => 'en',
                'value' => 'slug',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            108 => 
            array (
                'id' => 112,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 20,
                'locale' => 'en',
                'value' => 'meta_description',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            109 => 
            array (
                'id' => 113,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 21,
                'locale' => 'en',
                'value' => 'meta_keywords',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            110 => 
            array (
                'id' => 114,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 22,
                'locale' => 'en',
                'value' => 'status',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            111 => 
            array (
                'id' => 115,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 23,
                'locale' => 'en',
                'value' => 'created_at',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            112 => 
            array (
                'id' => 116,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 24,
                'locale' => 'en',
                'value' => 'updated_at',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            113 => 
            array (
                'id' => 117,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 2,
                'locale' => 'en',
                'value' => 'Page',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            114 => 
            array (
                'id' => 118,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 2,
                'locale' => 'en',
                'value' => 'Pages',
                'created_at' => '2022-01-18 17:37:03',
                'updated_at' => '2022-01-18 17:37:03',
            ),
            115 => 
            array (
                'id' => 121,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 176,
                'locale' => 'en',
                'value' => 'Id',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            116 => 
            array (
                'id' => 122,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 177,
                'locale' => 'en',
                'value' => 'User Id',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            117 => 
            array (
                'id' => 123,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 178,
                'locale' => 'en',
                'value' => 'Title',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            118 => 
            array (
                'id' => 124,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 179,
                'locale' => 'en',
                'value' => 'Body',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            119 => 
            array (
                'id' => 125,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 180,
                'locale' => 'en',
                'value' => 'Externe Link',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            120 => 
            array (
                'id' => 126,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 181,
                'locale' => 'en',
                'value' => 'Time Start',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            121 => 
            array (
                'id' => 127,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 182,
                'locale' => 'en',
                'value' => 'Time End',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            122 => 
            array (
                'id' => 128,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 183,
                'locale' => 'en',
                'value' => 'Location',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            123 => 
            array (
                'id' => 129,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 184,
                'locale' => 'en',
                'value' => 'Location Human',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            124 => 
            array (
                'id' => 130,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 185,
                'locale' => 'en',
                'value' => 'Image',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            125 => 
            array (
                'id' => 131,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 186,
                'locale' => 'en',
                'value' => 'Status',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            126 => 
            array (
                'id' => 132,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 187,
                'locale' => 'en',
                'value' => 'Created At',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            127 => 
            array (
                'id' => 133,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 188,
                'locale' => 'en',
                'value' => 'Updated At',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            128 => 
            array (
                'id' => 134,
                'table_name' => 'data_rows',
                'column_name' => 'display_name',
                'foreign_key' => 189,
                'locale' => 'en',
                'value' => 'users',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            129 => 
            array (
                'id' => 135,
                'table_name' => 'data_types',
                'column_name' => 'display_name_singular',
                'foreign_key' => 21,
                'locale' => 'en',
                'value' => 'Report',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            130 => 
            array (
                'id' => 136,
                'table_name' => 'data_types',
                'column_name' => 'display_name_plural',
                'foreign_key' => 21,
                'locale' => 'en',
                'value' => 'Reports',
                'created_at' => '2022-01-19 15:51:49',
                'updated_at' => '2022-01-19 15:51:49',
            ),
        ));
        
        
    }
}