<?php

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        // "title" => $faker->name,
        "title" => $name,
        "slug" => str_slug($name),
        "description" => $faker->text(),
        "start_date" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "published" => 0,
    ];
});
