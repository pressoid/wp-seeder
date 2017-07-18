<?php

if (class_exists(WP_CLI::class)) {
	WP_CLI::add_command('seed', new WPSeeder\Command($seeder));
}