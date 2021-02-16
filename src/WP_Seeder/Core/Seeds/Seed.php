<?php

namespace WP_Seeder\Core\Seeds;

use Faker\Generator;
use WP_Seeder\Core\Contracts\Seed_Interface;

abstract class Seed implements Seed_Interface {

	/**
	 * Faker instance.
	 *
	 * @var \Faker\Generator
	 */
	protected $faker;

	/**
	 * Properties of the seed.
	 *
	 * @var array
	 */
	protected $properties = array();

	/**
	 * Construct seed.
	 *
	 * @param \Faker\Generator $faker
	 */
	public function __construct( Generator $faker ) {
		$this->faker = $faker;
	}

	/**
	 * Sets values of seed properies.
	 *
	 * @param  array  $properties
	 * @return self
	 */
	public function properties( array $properties ) {
		$this->properties = $properties;

		return $this;
	}
}
