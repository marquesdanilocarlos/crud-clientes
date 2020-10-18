<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Tag;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all()->toArray();

        if (empty($clients)) {
            return response()->json(['message' => __('general_words.process_fail')], 204);
        }

        return response()->json($clients);
    }

    public function store(ClientRequest $request)
    {
        $client = new Client($request->all());

        if (!$client->save()) {
            return response()->json(['message' => __('general_words.process_fail')], 500);
        }

        $this->relatedTags($request->selectedTags, $client);

        return response()->json(
            [
                'client' => $client->toArray(),
                'message' => __('general_words.process_success')
            ],
            201
        );
    }

    public function show(int $id)
    {
        $client = Client::with('tags')->find($id);

        if (empty($client)) {
            return response()->json(['message' => __('general_words.process_fail')], 204);
        }

        return response()->json(
            [
                'client' => $client,
                'message' => __('general_words.process_success')
            ],
            200
        );
    }

    public function update(int $id, ClientRequest $request)
    {
        $client = Client::find($id);

        if (empty($client)) {
            return response()->json(['message' => __('general_words.not_found')], 404);
        }

        $client->fill($request->all());
        $client->save();

        $this->relatedTags($request->selectedTags, $client);

        return response()->json(
            [
                'client' => $client->toArray(),
                'message' => __('general_words.process_success')
            ],
            200
        );
    }

    public function destroy(int $id)
    {
        try {
            $client = Client::find($id);

            if (empty($client)) {
                return response()->json(['message' => __('general_words.not_found')], 404);
            }

            $client->tags()->detach();

            $client->delete();

            return response()->json(
                [
                    'message' => __('general_words.process_success')
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(['message' => __('general_words.process_fail')], 500);
        }
    }

    private function relatedTags(array $tags, Client $client)
    {
        $client->tags()->detach();

        $newTags = array_filter(
            $tags,
            function ($tag) {
                return empty($tag['id']);
            }
        );

        $existingTags = Tag::find(
            array_column(
                array_filter(
                    $tags,
                    function ($tag) {
                        return !empty($tag['id']);
                    }
                ),
                'id'
            )
        );

        $client->tags()->createMany($newTags);
        $client->tags()->saveMany($existingTags);
    }
}
