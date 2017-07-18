<?php

if (! defined('WPINC')) {
	die();
}

if (! defined('WP_SEEDER_ACTIVE')) {
	define('WP_SEEDER_ACTIVE', WP_DEBUG);
	define('WP_SEEDER_LOCALE', 'en_US');
}

if (constant('WP_SEEDER_ACTIVE')) {
	$faker = Faker\Factory::create(constant('WP_SEEDER_LOCALE'));

	$factory = new WPSeeder\Factory($faker);
	$seeder = new WPSeeder\Seeder($factory);

	require_once __DIR__ . '/command.php';
	require_once __DIR__ . '/plugin.php';
}
