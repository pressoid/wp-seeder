<?php

/**
 * Make factory `posts` definition for seeding
 * entries of the `post` posttype.
 */
add_action('wp_seeder/define/factory/post', function (WPSeeder\Factory $factory) {
    $factory->define('posts', function (Faker\Generator $faker) {
        return ['post_type' => 'post'];
    });
});

/**
 * Generate specified $count number
 * seeds of `posts` definition.
 */
add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('posts', $count);
});

/**
 * Before running seeding, we will delete all
 * current entries of `post` post type.
 */
add_action('wp_seeder/before/run', function () {
    $posts = get_posts([
        'post_type' => 'post',
        'posts_per_page' => -1,
    ]);

    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }
});

/**
 * We also have to delete attachments of every
 * `post` entry which will be deleted.
 */
add_action('before_delete_post', function ($id) {
    global $post_type;

    if ($post_type === 'post') {
        $media = get_children([
            'post_parent' => $id,
            'post_type'   => 'attachment'
        ]);

        if(! empty($media)) {
            foreach($media as $file) {
                wp_delete_attachment($file->ID);
            }
        }
    }
});
