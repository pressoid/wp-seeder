<?php

namespace WP_Seeder\Core\Seeds\Traits;

trait Current_Date {

	/**
	 * Gets current datetime.
	 *
	 * @return string
	 */
	public function now() {
		return gmdate( 'Y-m-d H:i:s', time() );
	}
}
