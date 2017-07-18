<?php

// add_action('wpseeder/define/factory/user', function (WPSeeder\Factory $factory) {
// 	$factory->define('users', function (Faker\Generator $faker) {
// 		return [
// 			'display_name' => $faker->name(),
// 			'user_login' => $faker->unique()->userName(),
// 			'user_pass' => wp_hash_password('password'),
// 			'user_email' => $faker->unique()->email(),
// 	    ];
// 	});

// 	$factory->make('users', 5);
// });

add_action('wpseeder/define/factory/post', function (WPSeeder\Factory $factory) {
	$factory->define('posts', function (Faker\Generator $faker) {
		return ['post_type' => 'post'];
	});
});

add_action('wpseeder/define/factory/post', function (WPSeeder\Factory $factory) {
	$factory->define('books', function (Faker\Generator $faker) {
		return ['post_type' => 'book'];
	});
});

add_action('wpseeder/generate/seeds', function (WPSeeder\Factory $factory) {
	$factory->create('posts', 1);
	$factory->create('books', 2);
});