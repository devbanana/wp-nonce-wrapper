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
 * Wordpress nonce attached to URL.
		 *
		 * Wrapper of wp_nonce_url().
 *
 * @author Brandon Olivares
 */
class WPNonceURL extends AbstractWPNonce {

		/**
		 * Generate nonce.
		 *
		 * Wrapper for wp_nonce_url().
		 *
		 * @param string $url    The URL to which to add the nonce.
		 * @param string $action (optional) The action for this nonce. Defaults to -1.
		 * @param string $name   (optional) The name of the nonce used in the URL. Defaults to _wpnonce.
		 *
		 * @return Devbanana\WPNonceWrapper\WPNonceURL
		 */
		public static function generate( $url, $action = -1, $name = '_wpnonce' ) {
				$instance = new static();
				$instance->setOutput( wp_nonce_url( $url, $action, $name ) );

				// Get the nonce from the URL
				$matches = preg_match( '/' . preg_quote($name) . '=(.+)$/', $instance->getOutput(), $matches );
				if ( $matches ) {
						$instance->setNonce( $matches[1] );
				}

				$instance->setAction( $action );
				$instance->setOutput( $instance->getNonce() );
				return $instance;
		}

}
