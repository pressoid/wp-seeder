<?php

namespace WP_Seeder\Core\Contracts;

interface Seeder_Interface {

	/**
	 * Runs seeding with registered factories and generators.
	 *
	 * @return void
	 */
	public function run();
}
