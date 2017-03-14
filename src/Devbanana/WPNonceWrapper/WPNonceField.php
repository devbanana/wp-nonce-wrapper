<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the wp-nonce-wrapper package.
 *
 * (c) 2017 Brandon Olivares
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Devbanana\WPNonceWrapper;

/**
 * Wordpress nonce attached to field.
		 *
		 * Wrapper of wp_nonce_field().
 *
 * @author Brandon Olivares
 */
class WPNonceField extends AbstractWPNonce {

		/**
		 * Generate nonce.
		 *
		 * Wrapper for wp_nonce_field().
		 *
		 * @param string $action  (optional) The action for this nonce. Defaults to -1.
		 * @param string $name    (optional) The name of the nonce used in the URL. Defaults to _wpnonce.
		 * @param bool   $referer (optional) Whether to add a referer field as well.
		 * @param bool  $echo     Whether to print out the form fields.
		 *
		 * @return Devbanana\WPNonceWrapper\WPNonceField
		 */
		public static function generate( $action = -1, $name = '_wpnonce', $referer = true, $echo = true ) {
				$instance = new static();
				$instance->setOutput( wp_nonce_field( $action, $name, $referer, $echo ) );

				// Get the nonce from the field
				$matched = preg_match( '/value="([^"]+)"/', $instance->getOutput(), $matches );
				if ( $matched ) {
						$instance->setNonce( $matches[1] );
				}

				$instance->setAction( $action );
				$instance->setName( $name );
				return $instance;
		}

}
