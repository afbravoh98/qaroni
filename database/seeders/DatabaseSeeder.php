<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var  Category $firstCategory*/
        [$firstCategory, $secondCategory] = Category::factory(2)->create();

        $firstCategory->description()->create([
            'name' => 'Musica',
            'language' => 'es',
        ]);
        $firstCategory->description()->create([
            'name' => 'Music',
            'language' => 'en',
        ]);
        $firstCategory->description()->create([
            'name' => 'Música',
            'language' => 'gl',
        ]);

        $secondCategory->description()->create([
            'name' => 'Cine y Television',
            'language' => 'es',
        ]);
        $secondCategory->description()->create([
            'name' => 'Movies and TV',
            'language' => 'en',
        ]);
        $secondCategory->description()->create([
            'name' => 'Cine e Televisión',
            'language' => 'gl',
        ]);

        /** @var  Event $firstEvent*/
        [$firstEvent, $secondEvent] = Event::factory(2)->create([
            'categoryId' => $firstCategory->id
        ]);

        $firstEvent->description()->create([
            'name' => 'El gran concierto',
            'language' => 'es',
        ]);

        $firstEvent->description()->create([
            'name' => 'The great concert',
            'language' => 'en',
        ]);
        $firstEvent->description()->create([
            'name' => 'O gran concerto',
            'language' => 'gl',
        ]);

        $secondEvent->description()->create([
            'name' => 'El gran concierto Dos',
            'language' => 'es',
        ]);

        $secondEvent->description()->create([
            'name' => 'The great concert Two',
            'language' => 'en',
        ]);

        $secondEvent->description()->create([
            'name' => 'O gran concerto dous',
            'language' => 'gl',
        ]);


        /** @var  Event $firstEvent*/
        [$thirdEvent, $fourthEvent] = Event::factory(2)->create([
            'categoryId' => $secondCategory->id
        ]);

        $thirdEvent->description()->create([
            'name' => 'La gran película',
            'language' => 'es',
        ]);

        $thirdEvent->description()->create([
            'name' => 'The great movie',
            'language' => 'en',
        ]);
        $thirdEvent->description()->create([
            'name' => 'A gran película',
            'language' => 'gl',
        ]);

        $fourthEvent->description()->create([
            'name' => 'La gran película Dos',
            'language' => 'es',
        ]);

        $fourthEvent->description()->create([
            'name' => 'The great movie Two',
            'language' => 'en',
        ]);

        $fourthEvent->description()->create([
            'name' => 'A gran película dous',
            'language' => 'gl',
        ]);



    }
}
