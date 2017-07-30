<?php

use Brain\Monkey\Actions;
use Brain\Monkey\Filters;
use WPSeeder\Seeder;

class SeederTest extends TestCase
{
    /**
     * @test
     */
    public function test_running_a_seeder()
    {
        $factory = $this->getFactory();
        $seeder = $this->getSeeder($factory);

        $domains = $seeder->getDomains();

        Actions\expectDone('wp_seeder/before/run')->once();
        Actions\expectDone('wp_seeder/after/run')->once();
        Actions\expectDone('wp_seeder/generate/seeds')->once()->with($factory);
        Filters\expectApplied('wp_seeder/define/factory/domains')->once()->with($domains);

        foreach ($domains as $domain) {
            Actions\expectDone("wp_seeder/define/factory/{$domain}")->once()->with($factory);
        }

        $seeder->run();
    }

    public function getFactory()
    {
        return Mockery::mock('WPSeeder\Factory');
    }

    public function getSeeder($factory)
    {
        return new Seeder($factory);
    }
}
