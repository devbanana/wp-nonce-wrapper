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
 * General Wordpress nonce, not attached to URL or field.
		 *
		 * Wrapper of wp_create_nonce().
 *
 * @author Brandon Olivares
 */
class WPNonce extends AbstractWPNonce {

		/**
		 * Generate nonce.
		 *
		 * Wrapper for wp_create_nonce().
		 *
		 * @return Devbanana\WPNonceWrapper\WPNonce
		 */
		public static function generate( $action ) {
				$instance = new static();
				$instance->setNonce( wp_create_nonce( $action ) );
				$instance->setAction( $action );
				$instance->setOutput( $instance->getNonce() );
		}

}
