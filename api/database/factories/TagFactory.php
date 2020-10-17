<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => "#$faker->word"
    ];
});
