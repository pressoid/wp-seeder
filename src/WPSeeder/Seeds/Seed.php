<?php

namespace WPSeeder\Seeds;

use Faker\Generator;
use WPSeeder\Contracts\SeedInterface;

abstract class Seed implements SeedInterface
{
	public $faker;
	public $properties = [];

	public function __construct(Generator $faker)
	{
		$this->faker = $faker;
	}

	public function properties(array $properties)
	{
		$this->properties = $properties;

		return $this;
	}
}