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
 * Abstract class for WPNonce functionality.
 *
 * @author Brandon Olivares
 */
abstract class AbstractWPNonce {

		/**
		 * The generated nonce.
		 *
		 * @var string
		 */
		protected $nonce;

		/**
		 * The given action for the nonce.
		 *
		 * @var string
		 */
		protected $action;

		/**
		 * The name for this nonce.
		 *
		 * Defaults to _wpnonce.
		 *
		 * @var string
		 */
		protected $name;

		/**
		 * The output of this nonce.
		 *
		 * If this is for a URL or field, then the output is the appropriate URL or field.
		 *
		 * If neither, then the output is the nonce.
		 *
		 * @var string
		 */
		protected $output;

		/**
		 * Constructor for AbstractWPNonce.
		 *
		 * Sets default values.
		 */
		protected function __construct() {
				$this->name = '_wpnonce';
		}

		/**
		 * Verify the nonce for this action.
		 *
		 * Make sure that this nonce is valid.
		 *
		 * @return bool
		 */
		public function verify() {
				if ( isset( $_REQUEST[ $this->getName() ] ) ) {
						return wp_verify_nonce( $this->getNonce(), $this->getAction() );
				}
				else {
						return false;
				}
		}

		/**
		 * Verify the nonce on an admin screen.
		 *
		 * Wraps check_admin_referer().
		 *
		 * @return bool Whether the nonce is given and is valid.
		 */
		public function verifyAdmin() {
				return check_admin_referer( $this->getAction(), $this->getName() );
		}

		/**
		 * Verify the nonce in an ajax request.
		 *
		 * Wraps check_ajax_referer().
		 *
		 * @return bool Whether the nonce is given and is valid.
		 */
		public function verifyAjax( $die = true ) {
				return check_ajax_referer( $this->getAction(), $this->getName(), $die );
		}

		/**
		 * Import current nonce for verification.
		 *
		 * You'd use this method on the page where you want to verify the nonce.
		 *
		 * Example:
		 *
		 * ```php
		 * $nonce = Devbanana\WPNonceWrapper\WPNonce::import('some_action');
		 * if ( $nonce->verify() ) {
		 * 		// Perform the action
		 * }
		 * else {
		 * 		// Not valid
		 * }
		 * ```
		 *
		 * @param string $action The action for this nonce.
		 * @param string $name   (optional) The name of this nonce. Defaults to _wpnonce.
		 */
		public static function import( $action, $name = '_wpnonce' ) {
				$instance = new static();
				if ( isset( $_REQUEST[ $name ] ) ) {
						$instance->setNonce( $_REQUEST[ $name ] );
				}
				$instance->setAction( $action );
				$instance->setName( $name );
				return $instance;
		}

		/**
		 * Get the generated nonce.
		 *
		 * @return string
		 */
		public function getNonce() {
				return $this->nonce;
		}

		/**
		 * Set the nonce.
		 *
		 * @param string $nonce The nonce to set.
		 */
		public function setNonce( $nonce ) {
				$this->nonce = $nonce;
		}

		/**
		 * Get the action for this nonce.
		 *
		 * @return string The action.
		 */
		public function getAction() {
				return $this->action;
		}

		/**
		 * Set the action.
		 *
		 * @param string $action The action to set.
		 */
		public function setAction( $action ) {
				$this->action = $action;
		}

		/**
		 * Get the name of this nonce.
		 *
		 * @return string The name of the nonce.
		 */
		public function getName() {
				return $this->name;
		}

		/**
		 * Set the name.
		 *
		 * @param string $name The name to set.
		 */
		public function setName( $name ) {
				$this->name = $name;
		}

		/**
		 * Get the output for this nonce.
		 *
		 * @return string The appropriate output.
		 */
		public function getOutput() {
				return $this->output;
		}

		/**
		 * Set the output.
		 *
		 * @param string $output The output to set.
		 */
		public function setOutput( $output ) {
				$this->output = $output;
		}

		/**
		 * Convert to string.
		 *
		 * Just print out the output.
		 *
		 * @return string The output of the nonce.
		 */
		public function __toString() {
				return $this->output;
		}

}
