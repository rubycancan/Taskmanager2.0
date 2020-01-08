<?php

use Faker\Generator as Faker;

$factory->define(App\Step::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(),
        'completion'=>$faker->boolean(),
        'task_id'=>\App\Task::all()->random()->id
    ];
});
