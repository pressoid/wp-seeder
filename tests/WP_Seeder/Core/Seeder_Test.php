<?php

use Brain\Monkey\Actions;
use Brain\Monkey\Filters;
use WP_Seeder\Core\Seeder;

final class Seeder_Test extends Test_Case {
	public function test_running_a_seeder() {
		$factory = $this->get_factory();
		$seeder  = $this->get_seeder( $factory );

		$domains = $seeder->get_domains();

		Actions\expectDone( 'wp_seeder_before_run' )->once();
		Actions\expectDone( 'wp_seeder_after_run' )->once();
		Actions\expectDone( 'wp_seeder_generate_seeds' )->once()->with( $factory );
		Filters\expectApplied( 'wp_seeder_define_factory_domains' )->once()->with( $domains );

		foreach ( $domains as $domain ) {
			Actions\expectDone( "wp_seeder_define_factory_{$domain}" )->once()->with( $factory );
		}

		$seeder->run();
	}

	public function test_extending_seeder_domains() {
		$factory = $this->get_factory();
		$seeder  = $this->get_seeder( $factory );

		Filters\expectApplied( 'wp_seeder_define_factory_domains' )->once()->andReturn( array( 'books' ) );
		Actions\expectDone( 'wp_seeder_define_factory_books' )->once()->with( $factory );

		$seeder->run();
	}

	public function get_factory() {
		return Mockery::mock( 'WP_Seeder\Core\Factory' );
	}

	public function get_seeder( $factory ) {
		return new Seeder( $factory );
	}
}
