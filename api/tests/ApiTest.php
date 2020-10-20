<?php

use App\Models\Auth\User;
use App\Models\Client;
use App\Models\Tag;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{

    public function testList()
    {
        $user = factory(User::class)->create();

        $clients = factory(Client::class, 3)->create();

        $response = $this->actingAs($user)->get('/api/clientes');

        $response->assertResponseStatus(200);
        $response->assertJson(json_encode(['clients' => $clients->toArray()]));
    }

    public function testShow()
    {
        $user = User::where('id', '>=', 1)->first();

        $client = Client::where('id', '>=', 1)->first();

        $response = $this->actingAs($user)->json('GET', "/api/clientes/{$client->id}");

        $response->assertResponseStatus(200);
        $response->assertJson(json_encode(['client' => $client->find($client->id)]));
    }

    public function testCreate()
    {
        $user = User::where('id', '>=', 1)->first();

        $newClient = factory(Client::class)->make()->toArray();
        $newClient['selectedTags'] = factory(Tag::class, 2)->make()->toArray();

        $response = $this->actingAs($user)->post('/api/clientes/', $newClient);

        $response->assertResponseStatus(201);
        $response->assertJson(json_encode(['client' => $newClient]));
    }

    public function testUpdate()
    {
        $user = User::where('id', '>=', 1)->first();

        $client = Client::where('id', '>=', 1)->first();
        $client->name = 'TDD';
        $client->email = 'tdd@email.com';
        $client->save();
        $client = $client->toArray();
        $client['selectedTags'] = factory(Tag::class, 1)->make()->toArray();


        $response = $this->actingAs($user)->put("/api/clientes/{$client['id']}", $client);

        $response->assertResponseStatus(200);
        $response->assertJson(json_encode(['client' => $client]));
    }

    public function testDelete()
    {
        $user = User::where('id', '>=', 1)->first();
        $client = Client::where('id', '>=', 1)->first();

        $response = $this->actingAs($user)->delete("/api/clientes/{$client->id}", $client->toArray());

        $response->assertResponseStatus(200);
    }
}
