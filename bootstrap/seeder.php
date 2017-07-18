<?php

if (! defined('WPINC')) {
	die();
}

if (! defined('WPSEEDER_ACTIVE')) {
	define('WPSEEDER_ACTIVE', WP_DEBUG);
	define('WPSEEDER_LOCALE', 'en_US');
}

if (constant('WPSEEDER_ACTIVE')) {
	$faker = Faker\Factory::create(constant('WPSEEDER_LOCALE'));

	$factory = new WPSeeder\Factory($faker);
	$seeder = new WPSeeder\Seeder($factory);

	require_once __DIR__ . '/command.php';
	require_once __DIR__ . '/plugin.php';
}
