<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('_S_VERSION', '1.0.0');
define('PATH', get_template_directory());
define('PATH_URL', esc_url( get_template_directory_uri()));
define('ASSETS', esc_url( get_template_directory_uri()) . '/assets/src');
define('THEME', 'amplio-theme');

require PATH . '/inc/setup.php';
require PATH . '/inc/cleanup.php';
require PATH . '/inc/enqueues.php';
require PATH . '/inc/acf.php';
require PATH . '/inc/helper.php';
require PATH . '/inc/seo.php';
