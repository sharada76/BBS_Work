<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
  return [
    'title' => '明日の天気',
    'content' => '明日の天気はなんでしょう',
  ];
});
