<?php

/**
 * Make factory `users` definition for
 * seeding entries of the `user`.
 */
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

/**
 * Generate specified $count number
 * seeds of `users` definition.
 */
add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('users', $count);
});

/**
 * Before running seeding, we will delete
 * all current entries of `user`.
 */
add_action('wp_seeder/before/run', function () {
    $users = get_users(['exclude' => 1]);

    foreach ($users as $user) {
        wp_delete_user($user->ID, 1);
    }
});
