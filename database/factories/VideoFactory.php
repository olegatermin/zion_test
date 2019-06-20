<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'size' => $faker->randomNumber(4),
        'viewers' => $faker->randomNumber(4)
    ];
});
