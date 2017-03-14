<?php
/*
 * This file is part of the wp-nonce-wrapper package.
 *
 * (c) 2017 Brandon Olivares
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once '../src/Devbanana/WPNonceWrapper/AbstractWPNonce.php';
require_once '../src/Devbanana/WPNonceWrapper/WPNonce.php';
require_once 'functions.php';

use PHPUnit\Framework\TestCase;
use Devbanana\WPNonceWrapper\WPNonce;

class WPNonceTest extends TestCase
{

		public function testGenerateReturnsInstance() {
				$nonce = WPNonce::generate( 'test' );
		$this->assertInstanceOf( 'Devbanana\\WPNonceWrapper\\WPNonce', $nonce );
		}

		public function testGenerateHasNonce() {
				$nonce = WPNonce::generate( 'test' );
		$this->assertEquals( 'this-is-a-nonce', $nonce->getNonce() );
		}

		public function testGenerateHasAction() {
				$nonce = WPNonce::generate( 'test' );
		$this->assertEquals( 'test', $nonce->getAction() );
		}

		public function testGenerateHasName() {
				$nonce = WPNonce::generate( 'test' );
		$this->assertEquals( '_wpnonce', $nonce->getName() );
		}

		public function testVerifyCalledWithNonce() {
				$nonce = WPNonce::generate( 'test' );

		$_REQUEST = array(
				'_wpnonce' => 'this-is-a-nonce',
		);
		$this->assertTrue( $nonce->verify() );
		}

		public function testVerifyCalledWithoutNonce() {
				$nonce = WPNonce::generate( 'test' );

		$_REQUEST = array();
		$this->assertFalse( $nonce->verify() );
		}

		public function testVerifyAdmin() {
				$nonce = WPNonce::generate( 'test' );
				$this->assertTrue( $nonce->verifyAdmin() );
		}

		public function testVerifyAjax() {
				$nonce = WPNonce::generate( 'test' );
				$this->assertTrue( $nonce->verifyAjax() );
		}

}
