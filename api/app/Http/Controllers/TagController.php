<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->toArray();

        if (empty($tags)) {
            return response()->json(['message' => __('general_words.process_fail')], 204);
        }

        return response()->json($tags);
    }
}
