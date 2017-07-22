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
     * Defines seed definition for factory.
     *
     * @param  string  $name
     * @param  \Closure $closure
     * @return self
     */
    public function define($name, Closure $closure)
    {
        $this->definitions[$name] = new Definition($this->domain(), $closure);

        return $this;
    }

    /**
     * Generates specifed number of seeds based on definitions and model.
     *
     * @param  string $name
     * @param  integer $number
     * @return void
     */
    public function create($name, $number)
    {
        $definition = $this->definition($name);

        for ($i=0; $i < $number; $i++) {
            $properties = $definition->resolve($this->faker);

            $this->seed($definition->domain)->properties($properties)->generate();
        }
    }

    /**
     * Gets definition for sepcifed model and definition name.
     *
     * @param  string $name
     * @return \Closure
     */
    public function definition($name)
    {
        return $this->definitions[$name];
    }

    /**
     * Gets name of currently active domain.
     *
     * @return string
     */
    public function domain()
    {
        $name = explode('/', current_filter());

        return end($name);
    }

    /**
     * Initializes seed model.
     *
     * @param  string $model
     * @return \WPSeeder\Contracts\SeedInterface
     */
    public function seed($model)
    {
        $seed = static::SEEDS_NAMESPACE . "\\" . ucfirst($model);

        return new $seed($this->faker);
    }
}
