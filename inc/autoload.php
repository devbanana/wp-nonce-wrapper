<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the wp-nonce-wrapper package.
 *
 * (c) 2017 Brandon Olivares
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Autoloads our classes.
 *
 * @param string $class The class to autoload.
 */
function wp_nonce_wrapper_autoload( $class ) {
		$path = dirname( dirname( __FILE__ ) ) . '/src/' .
		str_replace( '\\', '/', $class ) . '.php';
		require $path;
}

spl_autoload_register( 'wp_nonce_wrapper_autoload' );
