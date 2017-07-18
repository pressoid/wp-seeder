<?php

namespace WPSeeder;

use Faker\Generator;
use WPSeeder\Contracts\SeederInterface;

class Seeder implements SeederInterface
{
	protected $domains = ['user', 'post'];

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function run()
    {
    	$this->defineFactories();
    	$this->generateSeeds();
    }

    public function domains()
    {
    	return apply_filters('wpseeder/define/factory/domains', $this->domains);
    }

    protected function defineFactories()
    {
    	foreach ($this->domains() as $domain) {
    		do_action("wpseeder/define/factory/{$domain}", $this->factory->domain($domain));
    	}
    }

    protected function generateSeeds()
    {
    	do_action("wpseeder/generate/seeds", $this->factory);
    }
}