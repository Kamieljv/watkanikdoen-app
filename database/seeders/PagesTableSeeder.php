<?php

namespace Database\Seeders;

use DB;
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


        DB::table('pages')->delete();

        DB::table('pages')->insert(array (
            0 =>
            array (
                'author_id' => 1,
            'body' => '<p><em><span style="font-weight: 400;">Watkanikdoen </span></em><span style="font-weight: 400;">is een onafhankelijk platform waarop alle initiatieven te vinden zijn, die zich inzetten voor een eerlijke, inclusieve en duurzame wereld, die in Nederland georganiseerd worden en die burgers inspireren om in actie te komen. Alle demonstraties, stakingen, inzamelacties, petities, meet-ups, marsen en sit-ins zijn voortaan in &eacute;&eacute;n oogopslag bij elkaar te vinden. </span><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> zet zich in voor een sterke en actieve democratie met &eacute;&eacute;n helder doel: het bevorderen van een inclusieve, eerlijke en duurzame samenleving door het stimuleren van actief burgerschap. Wij richten ons hierbij op de (potenti&euml;le) actievoerder tussen de 18 en 28 jaar.&nbsp;</span></p>
<p><span style="font-weight: 400;"><img title="Image of a demonstration" src="http://localhost:8000/storage/pages/January2022/pexels-markus-spiske-2990644.jpg" alt="Image of a demonstration" width="900" height="600" /></span></p>
<h2><span style="font-weight: 400;">Missie</span></h2>
<p><span style="font-weight: 400;">De missie van </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> is het bevorderen van een inclusieve, eerlijke en duurzame samenleving. Inclusief omdat wij vinden dat iedereen mee moet kunnen komen. Eerlijk omdat wij geloven in gelijke kansen en openheid van zaken. En duurzaam omdat wij waarde hechten aan de generaties na ons.&nbsp;</span></p>
<p><span style="font-weight: 400;">Het team van </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> is optimistisch als het gaat over de toekomst; wij zien veel welwillendheid bij Nederlandse burgers om te staan voor de goede zaak en daarvoor de regen te trotseren als dat nodig is. Wij willen die betrokkenheid stimuleren, want alleen als een democratie goed functioneert, wordt een samenleving inclusiever, eerlijker en duurzamer. Onze tijd kent uiteenlopende maatschappelijke uitdagingen. Van klimaatverandering tot lerarentekorten en van te lage salarissen in de zorgsector tot institutioneel racisme. Ieder onderwerp vraagt om een eigen benadering en aandacht maar ze hebben &eacute;&eacute;n gemene deler: ze worden het best aangepakt door een actieve deelname van burgers.&nbsp;</span></p>
<p><span style="font-weight: 400;">Democratie is niet vanzelfsprekend en moet actief worden onderhouden; een sterke democratie vraagt om actief burgerschap. Er worden in Nederland dan ook talloze acties georganiseerd in de vorm van bijvoorbeeld demonstraties, stakingen en petities. Waar </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> voor staat is om deze acties kracht bij te zetten en het bereik ervan te vergroten om zo bij te dragen aan een progressief klimaat.&nbsp;</span></p>
<h2><span style="font-weight: 400;">Visie</span></h2>
<p><span style="font-weight: 400;">Actief burgerschap klinkt goed, maar hoe wordt iemand een actieve burger? Wat kan je doen om je in te zetten? Om die vraag te beantwoorden speelt informatievoorziening een primaire rol. Informatie over hoe zet ik me in voor een progressief doel en waar moet ik zijn om dat te realiseren? Voordat een potenti&euml;le actievoerder de stap zet naar het demonstratieveld moet diegene allereerst op de hoogte zijn van wat er speelt en wat er te doen is. De mogelijkheid om informatie in te winnen is eindeloos, je moet echter wel de </span><em><span style="font-weight: 400;">juiste </span></em><span style="font-weight: 400;">informatie zien te vinden. </span><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> komt hieraan tegemoet door &eacute;&eacute;n overzicht te bieden van alle acties die worden georganiseerd en gebruikers daar bovendien actief over op de hoogte te houden.</span></p>
<p><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> onderscheidt zich door zich niet voor &eacute;&eacute;n specifiek thema in te zetten, maar een platform te bieden aan alle acties met een progressief doeleinde. Onze overtuiging is dat de uitdagingen waar onze samenleving voor staat niet los van elkaar te zien zijn, maar onderdeel zijn van hetzelfde systeem. Dit is terug te zien in de diversiteit aan thema&rsquo;s van de acties waaraan </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> een platform biedt, alsmede in de samenwerkingen die wij aangaan en het netwerk van organisatoren waar wij als verbinder een rol in willen spelen.</span></p>',
                'created_at' => '2018-03-30 03:04:51',
                'excerpt' => 'This is the about page.',
                'id' => 2,
                'image' => null,
                'meta_description' => 'Dit is de over ons pagina.',
                'meta_keywords' => 'about',
                'slug' => 'over-ons',
                'status' => 'ACTIVE',
                'title' => 'Over ons',
                'updated_at' => '2022-01-18 21:32:01',
            ),
            1 =>
            array (
                'author_id' => 1,
                'body' => '<p>Dit is het privacybeleid.</p>
<p>&nbsp;</p>',
                'created_at' => '2022-01-05 10:18:41',
                'excerpt' => 'Privacybeleid.',
                'id' => 3,
                'image' => null,
                'meta_description' => 'Lees hier meer over ons privacybeleid.',
                'meta_keywords' => 'privacy',
                'slug' => 'privacybeleid',
                'status' => 'ACTIVE',
                'title' => 'Privacybeleid',
                'updated_at' => '2022-01-18 21:25:02',
            ),
            2 =>
            array (
                'author_id' => 1,
                'body' => '<p>Dit is de contactpagina.</p>',
                'created_at' => '2022-01-11 09:53:31',
                'excerpt' => 'Dit is de contactpagina.',
                'id' => 4,
                'image' => null,
                'meta_description' => 'Dit is de contactpagina.',
                'meta_keywords' => 'contact',
                'slug' => 'contact',
                'status' => 'ACTIVE',
                'title' => 'Contact',
                'updated_at' => '2022-01-11 09:53:31',
            ),
        ));
    }
}
