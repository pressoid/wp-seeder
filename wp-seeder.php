<?php

/**
 * Plugin Name: WP Seeder
 * Plugin URI:  https://example.com/plugin-name
 * Description: Seeds your WordPress database with test data.
 * Version:     1.0.0
 * Author:      Jędrzej Chałubek
 * Author URI:  http://jedrzejchalubek.com
 * Text Domain: wp-seeder
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require $composer;
}

require_once __DIR__ . '/bootstrap/seeder.php';
