<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     *
     * @param  RegisterRequest  $request
     * @return JSON
     */
    public function register(RegisterRequest $request)
    {
        $user = new User($request->all());
        $user->save();

        return response()->json(['message' => __('general_words.process_success')], 201);
    }
}
