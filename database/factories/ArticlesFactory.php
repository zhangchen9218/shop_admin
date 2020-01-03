<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence,
        "intro" => Str::limit($faker->paragraph,50),
        "author" => $faker->name,
        "comment_state" => rand(1,2),
        "icon" => "aaa",
        "column_id" => 1,
        "source" => $faker->name,
        "content" => $faker->paragraph,
        "operator_id" => 1,
        "verifier_id" => 1,
        "impression" => rand(100,9999),
        "category_id" => rand(1,4),
        'key_words'=> "1,2,3,4,5",
        "state" => rand(1,4)
    ];
});
