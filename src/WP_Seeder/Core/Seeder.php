<?php

namespace WP_Seeder\Core;

use Faker\Generator;
use WP_Seeder\Core\Contracts\Seeder_Interface;

class Seeder implements Seeder_Interface {

	/**
	 * Seeds factory instance.
	 *
	 * @var \WP_Seeder\Core\Factory
	 */
	protected $factory;

	/**
	 * Domains available for seeding.
	 *
	 * @var array
	 */
	protected $domains = array( 'post', 'user' );

	/**
	 * Construct seeder.
	 *
	 * @param \WP_Seeder\Core\Factory $factory
	 */
	public function __construct( Factory $factory ) {
		$this->factory = $factory;
	}

	/**
	 * Runs seeding with registered factories and generators.
	 *
	 * @return void
	 */
	public function run() {
		do_action( 'wp_seeder_before_run' );

		$this->define_factories();

		$this->generate_seeds();

		do_action( 'wp_seeder_after_run' );
	}

	/**
	 * Gets seeding domains.
	 *
	 * @return array
	 */
	protected function domains() {
		return apply_filters( 'wp_seeder_define_factory_domains', $this->domains );
	}

	/**
	 * Defines registered factories.
	 *
	 * @return void
	 */
	protected function define_factories() {
		foreach ( $this->domains() as $domain ) {
			do_action( "wp_seeder_define_factory_{$domain}", $this->factory );
		}
	}

	/**
	 * Runs defined generators.
	 *
	 * @return void
	 */
	protected function generate_seeds() {
		do_action( 'wp_seeder_generate_seeds', $this->factory );
	}

	/**
	 * Gets value of domains.
	 *
	 * @return array
	 */
	public function get_domains() {
		return $this->domains;
	}
}
