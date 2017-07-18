<?php

namespace WPSeeder;

use WPSeeder\Contracts\SeederInterface;

class Command
{
	/**
	 * Seeder instance.
	 *
	 * @var \WPSeeder\Contracts\SeederInterface
	 */
	protected $seeder;

	/**
	 * Construct command.
	 *
	 * @param \WPSeeder\Contracts\SeederInterface $seeder
	 */
	public function __construct(SeederInterface $seeder)
	{
		$this->seeder = $seeder;
	}

	/**
     * Seeds a database with fake content using configured seeding schema.
     *
     * ## OPTIONS
     *
     * [--config=<path>]
     * : Path to configuration file which has to be used as seeding schema.
     *
     * ## EXAMPLES
     *
     *     wp seed --config="path/to/seeds.php"
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
    	if (isset($options['config'])) {
    		$this->seeder->run($options['config']);

       		return \WP_CLI::success('Seeded!');
    	}

    	return \WP_CLI::error('You have to provide path to the seeds configuration with [--config=<path>] option.');
    }
}