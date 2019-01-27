<?php

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    $name = $faker->text(50);
    return [
        "title" => $name,
        "slug" => str_slug($name),
        "short_text" => $faker->paragraph(),
        "full_text" => $faker->text(1000),
        "position" => rand(0, 1),
        "published" => rand(0, 1),
    ];
});
