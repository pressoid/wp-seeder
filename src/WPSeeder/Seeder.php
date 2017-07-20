<?php

namespace WPSeeder;

use Faker\Generator;
use WPSeeder\Contracts\SeederInterface;

class Seeder implements SeederInterface
{
    /**
     * Seeds factory instance.
     *
     * @var \WPSeeder\Factory
     */
    protected $factory;

    /**
     * Domains available for seeding.
     *
     * @var array
     */
    protected $domains = ['user', 'post'];

    /**
     * Construct seeder.
     *
     * @param \WPSeeder\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Runs seeding with registered factories and generators.
     *
     * @return void
     */
    public function run()
    {
        $this->defineFactories();

        $this->generateSeeds();
    }

    /**
     * Gets seeding domains.
     *
     * @return array
     */
    protected function domains()
    {
        return apply_filters('wp_seeder/define/factory/domains', $this->domains);
    }

    /**
     * Defines registered factories.
     *
     * @return void
     */
    protected function defineFactories()
    {
        foreach ($this->domains() as $domain) {
            do_action("wp_seeder/define/factory/{$domain}", $this->factory->domain($domain));
        }
    }

    /**
     * Runs defined generators.
     *
     * @return void
     */
    protected function generateSeeds()
    {
        do_action("wp_seeder/generate/seeds", $this->factory);
    }
}
