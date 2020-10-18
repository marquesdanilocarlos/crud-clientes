<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Client;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = factory(Tag::class, 5)->create();

        Client::all()->each(function ($client) use ($tags){
            $client->tags()->saveMany($tags);
        });
    }
}
