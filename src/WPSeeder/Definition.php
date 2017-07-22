<?php

namespace WPSeeder;

use Closure;
use Faker\Generator;

class Definition
{

    function __construct($domain, Closure $builder)
    {
        $this->domain = $domain;
        $this->builder = $builder;
    }

    public function resolve(Generator $faker)
    {
        return call_user_func_array($this->builder, [$faker]);
    }
}
