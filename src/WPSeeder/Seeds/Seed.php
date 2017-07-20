<?php

namespace WPSeeder\Seeds;

use Faker\Generator;
use WPSeeder\Contracts\SeedInterface;

abstract class Seed implements SeedInterface
{
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
	protected $properties = [];

	/**
	 * Construct seed.
	 *
	 * @param \Faker\Generator $faker
	 */
	public function __construct(Generator $faker)
	{
		$this->faker = $faker;
	}

	/**
	 * Sets values of seed properies.
	 *
	 * @param  array  $properties
	 * @return self
	 */
	public function properties(array $properties)
	{
		$this->properties = $properties;

		return $this;
	}
}