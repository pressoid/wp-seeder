<?php

namespace WPSeeder;

use Closure;
use Faker\Generator;

class Factory
{
    /**
     * Seeds namespace.
     *
     * @var string
     */
    const SEEDS_NAMESPACE = 'WPSeeder\Seeds';

    /**
     * Domain name in which factory hast to operate.
     *
     * @var string
     */
	public $domain;

    /**
     * Collection of seeds definitions for factory.
     *
     * @var array
     */
	public $definitions = [];


    /**
     * Construct factory.
     *
     * @param \Faker\Generator $faker
     */
	public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Sets domain for factory.
     *
     * @param string $domain
     * @return self
     */
    public function domain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Defines seed definition for factory.
     *
     * @param  string  $name
     * @param  \Closure $definition
     * @return self
     */
    public function define($name, Closure $definition)
    {
    	$this->definitions[$this->domain][$name] = $definition;

    	return $this;
    }

    /**
     * Generates specifed number of seeds based on definitions and domain.
     *
     * @param  string $name
     * @param  integer $number
     * @return void
     */
    public function create($name, $number)
    {
    	$definition = $this->definition($name);

    	for ($i=0; $i < $number; $i++) {
            $properties = $definition($this->domain, $this->faker);

    		$this->seed()->properties($properties)->generate();
    	}
    }

    /**
     * Gets definition for sepcifed domain and definition name.
     *
     * @param  string $domain
     * @param  string $name
     * @return \Closure
     */
    public function definition($domain, $name)
    {
    	return $this->definitions[$domain][$name];
    }

    /**
     * Initializes seed model.
     *
     * @return \WPSeeder\Contracts\SeedInterface
     */
    public function seed()
    {
        $seed = static::SEEDS_NAMESPACE . "\\" . ucfirst($this->domain);

        return new $seed($this->faker);
    }
}