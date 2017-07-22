<?php

add_action('wp_seeder/define/factory/post', function (WPSeeder\Factory $factory) {
    $factory->define('posts', function (Faker\Generator $faker) {
        return ['post_type' => 'post'];
    });
});

add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('posts', $count);
});

add_action('wp_seeder/before/run', function () {
    $posts = get_posts([
        'post_type' => 'post',
        'posts_per_page' => -1,
    ]);

    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }
});
