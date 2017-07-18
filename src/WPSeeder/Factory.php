<?php

namespace WPSeeder;

use Closure;
use Faker\Generator;
use WPSeeder\Seeds\Post;

class Factory
{
	public $domain;
	public $definitions;

	public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @param mixed $domain
     *
     * @return self
     */
    public function domain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    public function define($name, Closure $definition)
    {
    	$this->definitions[$this->domain][$name] = $definition;

    	return $this;
    }

    public function create($name, $number)
    {
    	$definition = $this->definition($name);

    	for ($i=0; $i < $number; $i++) {
    		$this->{$this->domain}($definition($this->faker));
    	}
    }

    public function definition($name)
    {
    	return $this->definitions[$this->domain][$name];
    }

    public function post(array $properties)
    {
    	$post = new Post($this->faker);

    	return $post->properties($properties)->create();
    }

    public function user(array $properties)
    {
    	$user = new User($this->faker);

    	return $user->properties($properties)->create();
    }
}