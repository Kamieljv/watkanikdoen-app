<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentieTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referentie_types')->delete();
        
        \DB::table('referentie_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Vrijwilligerswerk',
                'slug' => 'vrijwilligerswerk',
                'description' => '<p>Doneer je tijd! Veel organisaties kunnen altijd helpende handen gebruiken. Vaak zijn er mogelijkheden om op je eigen manier bij te dragen, bijvoorbeeld op afstand of met specifieke taken. Durf te vragen bij organisaties wat er te doen valt en/of eigen idee&euml;n aan te dragen. Ook met kleine acties zijn organisaties vaak blij.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-06-02 10:15:00',
                'updated_at' => '2025-02-10 19:59:42',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Doneren',
                'slug' => 'doneren',
            'description' => '<p>Wist je dat geld doneren een van de meest effectieve manieren is om je steentje bij te dragen aan een betere wereld? En iedere Euro telt want (vrijwilligers)organisaties hebben vaak weinig geld. Om actie te voeren, om mensen te kunnen helpen, om rechtszaken aan te spannen - voor dit alles is geld nodig. Kies een organisator naar jouw hart en geef.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2025-02-10 20:12:28',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Petities',
                'slug' => 'petities',
                'description' => '<p>Petities: kleine moeite, groot plezier. Samen met anderen geef je jouw mening over een belangrijk onderwerp en de betreffende overheidsinstantie of de politiek moet er vervolgens mee aan de slag. Samen staan we sterk.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2025-02-10 20:11:51',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'De straat op',
                'slug' => 'de-straat-op',
                'description' => '<p>De straat op gaan om te demonstreren is een grondrecht. Om je te laten horen over belangrijke zaken en ook om jouw punt onder de aandacht van anderen te krijgen. Een demonstratie kan ook voor een gevoel van saamhorigheid zorgen als je je alleen voelt in je zorgen om een onderwerp.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2025-02-10 20:20:19',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Lobby & Politiek',
                'slug' => 'politiek',
            'description' => '<p>In de politiek worden de echte beslissingen gemaakt. Wil je dichtbij het vuur zitten en echt een verschil maken dan is de politiek of lobby (manieren om de politiek te beinvloeden) mogelijk iets voor jou. Met minder tijd of ambitie kan je ook een belangrijke bijdrage leveren door lid te worden van een Politieke Partij die jouw meningen vertegenwoordigt.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2025-02-10 20:26:41',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Leren',
                'slug' => 'leren',
                'description' => '<p>Kennis opdoen verrijkt je blik. Veel organisaties hebben kennisarchieven die openbaar zijn. Wij hebben voor jou de organisaties geselecteerd waar je, vaak naast andere activiteiten, ook kan leren.</p>',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2025-02-10 20:24:56',
            ),
        ));
        
        
    }
}