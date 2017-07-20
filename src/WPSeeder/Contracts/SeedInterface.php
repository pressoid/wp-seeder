<?php

namespace WPSeeder\Contracts;

interface SeedInterface
{
    /**
     * Gets default values of seed properties.
     *
     * @return array
     */
    public function defaults();

    /**
     * Sets values of seed properies.
     *
     * @param  array  $properties
     * @return self
     */
    public function properties(array $properties);

    /**
     * Generates seed entry.
     *
     * @return void
     */
    public function generate();
}
