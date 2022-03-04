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
                'excerpt' => 'Watkanikdoen.nl is dé site waarop jij op de hoogte blijft van wat jij kan doen voor een inclusieve, eerlijke en duurzame samenleving. In één oogopslag zie je een complete en up-to-date agenda van alle acties die worden georganiseerd waarin jij actief kan participeren!',
                'body' => '<p><span style="font-weight: 400;">Watkanikdoen.nl is d&eacute; site waarop jij op de hoogte blijft van wat jij kan doen voor een inclusieve, eerlijke en duurzame samenleving. In &eacute;&eacute;n oogopslag zie je een complete en up-to-date agenda van alle acties die worden georganiseerd waarin jij actief kan participeren!&nbsp;</span></p>
<p><strong>Wie zijn wij?</strong></p>
<p><span style="font-weight: 400;">Watkanikdoen.nl is een onafhankelijk platform dat zich inzet voor een sterke en actieve democratie met &eacute;&eacute;n helder doel: het bevorderen van een inclusieve, eerlijke en duurzame samenleving. Dit doel willen we bereiken door het stimuleren van actief burgerschap: burgers nemen zelf de verantwoordelijkheid voor het oplossen van maatschappelijke vraagstukken, door zelf initiatieven te organiseren.&nbsp;</span></p>
<p><strong>Wat kan </strong><strong><em>jij</em></strong><strong> doen op onze site?</strong></p>
<p><span style="font-weight: 400;">Op onze site kun jij als actieve burger zien hoe je kan bijdragen aan een progressief Nederland. We zetten alle demonstraties, stakingen, inzamelacties, petities, meet-ups, marsen en sit-ins voor je op een rijtje, en zo blijf jij op de hoogte van wat jij kan doen. Daarnaast kan je ook zelf acties aanmelden! Staat een bepaalde actie niet in onze agenda? Meld hem dan aan via de knop &ldquo;actie aanmelden&rdquo;. Met jouw hulp brengen we een complete agenda tot stand!&nbsp;</span></p>
<p><strong>Onze huisstijl<br /></strong>Grafisch ontwerpbureau <a href="https://studiomes.nl/">Studio MES</a> heeft ons geholpen met het ontwerpen van deze website en ons logo. </p>',
                'image' => NULL,
                'slug' => 'over-ons',
                'meta_description' => 'Watkanikdoen.nl is dé site waarop jij op de hoogte blijft van wat jij kan doen voor een inclusieve, eerlijke en duurzame samenleving. In één oogopslag zie je een complete en up-to-date agenda van alle acties die worden georganiseerd waarin jij actief kan participeren!',
                'meta_keywords' => 'about, over ons, watkanikdoen',
                'status' => 'ACTIVE',
                'created_at' => '2018-03-30 03:04:51',
                'updated_at' => '2022-03-04 11:29:03',
            ),
            1 => 
            array (
                'id' => 3,
                'author_id' => 1,
                'title' => 'Privacybeleid',
                'excerpt' => 'Privacybeleid.',
                'body' => '<p>Watkanikdoen.nl is verantwoordelijk voor de verwerking van persoonsgegevens zoals weergegeven in deze privacyverklaring.</p>
<p><strong>Contactgegevens:</strong><br /><a href="mailto:info@watkanikdoen.nl">info@watkanikdoen.nl</a></p>
<p><strong>Persoonsgegevens die wij verwerken<br /></strong>Watkanikdoen.nl verwerkt uw persoonsgegevens doordat u gebruik maakt van onze diensten en/of omdat u deze zelf aan ons verstrekt.<br />Hieronder vindt u een overzicht van de persoonsgegevens die wij verwerken:</p>
<ul>
<li>Voor- en achternaam</li>
<li>E-mailadres</li>
<li>Overige persoonsgegevens die u actief verstrekt bijvoorbeeld door een profiel op deze website aan te maken, in correspondentie en telefonisch</li>
<li>Locatiegegevens (uitsluitend met uw toestemming via de browser)</li>
</ul>
<p><strong>Bijzondere en/of gevoelige persoonsgegevens die wij verwerken<br /></strong>Onze website en/of dienst heeft niet de intentie gegevens te verzamelen over websitebezoekers die jonger zijn dan 16 jaar. Tenzij ze toestemming hebben van ouders of voogd. We kunnen echter niet controleren of een bezoeker ouder dan 16 is. Wij raden ouders dan ook aan betrokken te zijn bij de online activiteiten van hun kinderen, om zo te voorkomen dat er gegevens over kinderen verzameld worden zonder ouderlijke toestemming. Als u er van overtuigd bent dat wij zonder die toestemming persoonlijke gegevens hebben verzameld over een minderjarige, neem dan contact met ons op via <a href="mailto:info@watkanikdoen.nl">info@watkanikdoen.nl</a>, dan verwijderen wij deze informatie.</p>
<p><strong>Met welk doel en op basis van welke grondslag wij persoonsgegevens verwerken<br /></strong>Watkanikdoen.nl verwerkt uw persoonsgegevens voor de volgende doelen:</p>
<ul>
<li>Verzenden van onze nieuwsbrief en/of reclamefolder</li>
<li>U te kunnen bellen of e-mailen indien dit nodig is om onze dienstverlening uit te kunnen voeren</li>
<li>U te informeren over wijzigingen van onze diensten en producten</li>
<li>U de mogelijkheid te bieden een account aan te maken</li>
<li>Watkanikdoen.nl analyseert uw gedrag op de website om daarmee de website te verbeteren en het aanbod van producten en diensten af te stemmen op uw voorkeuren.</li>
</ul>
<p><strong>Geautomatiseerde besluitvorming<br /></strong>Watkanikdoen.nl neemt geen automatische besluiten die van aanzienlijke invloed kunnen zijn op haar gebruikers. <br /><br /><strong>Hoe lang we persoonsgegevens bewaren</strong><br />Watkanikdoen.nl bewaart uw persoonsgegevens niet langer dan strikt nodig is om de doelen te realiseren waarvoor uw gegevens worden verzameld. Wij hanteren een algemene bewaartermijn voor persoonsgegevens van 30 dagen na de datum waarop deze gegevens nog nodig waren.<br /><br /><strong>Delen van persoonsgegevens met derden</strong><br />Watkanikdoen.nl verstrekt uitsluitend aan derden en alleen als dit nodig is voor de uitvoering van onze overeenkomst met u of om te voldoen aan een wettelijke verplichting.<br /><br /><strong>Cookies, of vergelijkbare technieken, die wij gebruiken</strong><br />Watkanikdoen.nl gebruikt alleen technische en functionele cookies. En analytische cookies die geen inbreuk maken op uw privacy. Een cookie is een klein tekstbestand dat bij het eerste bezoek aan deze website wordt opgeslagen op uw computer, tablet of smartphone. De cookies die wij gebruiken zijn noodzakelijk voor het functioneren van het login-systeem en voor het bijhouden van bezoekersstatistieken.</p>
<p>&nbsp;</p>',
                'image' => NULL,
                'slug' => 'privacybeleid',
                'meta_description' => 'Lees hier meer over ons privacybeleid.',
                'meta_keywords' => 'privacy',
                'status' => 'ACTIVE',
                'created_at' => '2022-01-05 10:18:41',
                'updated_at' => '2022-03-04 11:05:12',
            ),
            2 => 
            array (
                'id' => 4,
                'author_id' => 1,
                'title' => 'Contact',
                'excerpt' => 'Je kunt ons bereiken via info@watkanikdoen.nl.',
                'body' => '<p><span style="font-weight: 400;">Wil je contact met ons opnemen? Stuur ons dan een mail via </span><a href="mailto:info@watkanikdoen.nl"><span style="font-weight: 400;">info@watkanikdoen.nl</span></a><span style="font-weight: 400;">!</span></p>
<p><span style="font-weight: 400;">We zijn ook te vinden op diverse sociale media:</span></p>
<p><span style="font-weight: 400;">Instagram: <a href="https://www.instagram.com/watkanikdoen.nl">@watkanikdoen.nl</a></span></p>
<p><span style="font-weight: 400;">Twitter: <a href="https://twitter.com/watkanikdoen_nl">@watkanikdoen_nl</a></span></p>',
                'image' => NULL,
                'slug' => 'contact',
                'meta_description' => 'Je kunt ons bereiken via info@watkanikdoen.nl.',
                'meta_keywords' => 'contact',
                'status' => 'ACTIVE',
                'created_at' => '2022-01-11 09:53:31',
                'updated_at' => '2022-03-04 11:29:29',
            ),
        ));
        
        
    }
}