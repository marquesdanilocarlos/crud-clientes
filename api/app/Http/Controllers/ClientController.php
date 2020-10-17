<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
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

    public function store(Request $request)
    {
        $client = new Client($request->all());

        if (!$client->save()) {
            return response()->json(['message' => __('general_words.process_fail')], 500);
        }

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
        $client = Client::find($id);

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

    public function update(int $id, Request $request)
    {
        $client = Client::find($id);

        if (empty($client)) {
            return response()->json(['message' => __('general_words.not_found')], 404);
        }

        $client->fill($request->all());

        return response()->json(
            [
                'client' => $client->toArray(),
                'message' => __('general_words.process_success')
            ],
            201
        );
    }

    public function destroy(int $id)
    {
        try {
            $removedClients = Client::destroy($id);
        } catch (\Exception $exception) {
            return response()->json(['message' => __('general_words.process_fail')], 500);
        }

        if (!$removedClients) {
            return response()->json(['message' => __('general_words.not_found')], 404);
        }

        return response()->json(
            [
                'message' => __('general_words.process_success')
            ],
            204
        );
    }
}
