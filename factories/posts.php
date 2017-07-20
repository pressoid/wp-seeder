<?php

add_action('wp_seeder/define/factory/post', function (WPSeeder\Factory $factory) {
    $factory->define('posts', function (Faker\Generator $faker) {
        return ['post_type' => 'post'];
    });
});

add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('posts', $count);
});
