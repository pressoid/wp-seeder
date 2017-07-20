<?php

namespace WPSeeder\Contracts;

interface SeederInterface
{
    /**
     * Runs seeding with registered factories and generators.
     *
     * @return void
     */
    public function run();
}
