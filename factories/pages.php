<?php

/**
 * Make factory `pages` definition for seeding
 * entries of the `page` post type.
 */
add_action('wp_seeder/define/factory/post', function (WPSeeder\Factory $factory) {
    $factory->define('pages', function (Faker\Generator $faker) {
        return ['post_type' => 'page'];
    });
});

/**
 * Generate specified $count number
 * seeds of `pages` definition.
 */
add_action('wp_seeder/generate/seeds', function (WPSeeder\Factory $factory) use ($count) {
    $factory->create('pages', $count);
});

/**
 * Before running seeding, we will delete all
 * current entries of `page` post type.
 */
add_action('wp_seeder/before/run', function () {
    $pages = get_posts([
        'post_type' => 'page',
        'posts_per_page' => -1,
    ]);

    foreach ($pages as $page) {
        wp_delete_post($page->ID, true);
    }
});

/**
 * We also have to delete attachments of every
 * `page` entry which will be deleted.
 */
add_action('before_delete_post', function ($id) {
    if (get_post_type($id) === 'page') {
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
