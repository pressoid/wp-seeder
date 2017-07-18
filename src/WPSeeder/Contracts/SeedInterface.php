<?php

namespace WPSeeder\Contracts;

interface SeedInterface
{
	public function create();

	public function defaults();
}