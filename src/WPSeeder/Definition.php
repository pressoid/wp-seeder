<?php

namespace WPSeeder;

use Closure;
use Faker\Generator;

class Definition
{
    /**
     * Construct definition.
     *
     * @param string  $domain
     * @param \Closure $builder
     */
    function __construct($domain, Closure $builder)
    {
        $this->domain = $domain;
        $this->builder = $builder;
    }

    /**
     * Resolve domain builder.
     *
     * @param  \Faker\Generator $faker
     * @return mixed
     */
    public function resolve(Generator $faker)
    {
        return call_user_func_array($this->builder, [$faker]);
    }
}
