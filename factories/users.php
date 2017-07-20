<?php

add_action('wp_seeder/define/factory/user', function (WPSeeder\Factory $factory) {
    $factory->define('users', function (Faker\Generator $faker) {
        return [
            'display_name' => $faker->name(),
            'user_login' => $faker->unique()->userName(),
            'user_pass' => wp_hash_password('password'),
            'user_email' => $faker->unique()->email(),
        ];
    });
});

add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('users', $count);
});
