<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Actie;

class TagTableFactorySeeder extends Seeder
{
    public function run()
    {
        // Create 10 tags
        $tags = Tag::factory()->count(10)->create();

        // Get all acties
        $acties = Actie::all();

        // Attach each tag to a random actie
        foreach ($tags as $tag) {
            $actie = $acties->random();
            $actie->tags()->save($tag);
        }

        // Attach some tags to multiple acties
        foreach ($tags->take(5) as $tag) {
            $randomActies = $acties->random(3);
            foreach ($randomActies as $actie) {
                $actie->tags()->save($tag);
            }
        }

        // Attach some tags to multiple organizers
        $organizers = \App\Models\Organizer::all();
        foreach ($tags->skip(5) as $tag) {
            $randomOrganizers = $organizers->random(2);
            foreach ($randomOrganizers as $organizer) {
                $organizer->tags()->save($tag);
            }
        }

        // Attach some tags to multiple referenties
        $referenties = \App\Models\Referentie::all();
        foreach ($tags->skip(7) as $tag) {
            $randomReferenties = $referenties->random(2);
            foreach ($randomReferenties as $referentie) {
                $referentie->tags()->save($tag);
            }
        }
    }
}