<?php
/*
 * This file is part of the wp-nonce-wrapper package.
 *
 * (c) 2017 Brandon Olivares
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once dirname(__FILE__) . '/../src/Devbanana/WPNonceWrapper/AbstractWPNonce.php';
require_once dirname(__FILE__) . '/../src/Devbanana/WPNonceWrapper/WPNonceURL.php';
require_once 'functions.php';

use PHPUnit\Framework\TestCase;
use Devbanana\WPNonceWrapper\WPNonceURL;

class WPNonceURLTest extends TestCase
{

		public function testGenerateReturnsInstance() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test' );
		$this->assertInstanceOf( 'Devbanana\\WPNonceWrapper\\WPNonceURL', $nonce );
		}

		public function testGenerateHasNonce() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test' );
		$this->assertEquals( 'this-is-a-nonce', $nonce->getNonce() );
		}

		public function testGenerateHasAction() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test' );
		$this->assertEquals( 'test', $nonce->getAction() );
		}

		public function testGenerateHasName() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test' );
		$this->assertEquals( '_wpnonce', $nonce->getName() );
		}

		public function testGenerateHasNameWhenSpecified() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test', 'my-nonce' );
		$this->assertEquals( 'my-nonce', $nonce->getName() );
		}

		public function testGenerateHasOutput() {
				$nonce = WPNonceURL::generate( 'http://www.example.com', 'test' );
		$this->assertEquals( 'http://www.example.com?_wpnonce=this-is-a-nonce', $nonce->getOutput() );
		}

		public function testVerifyCalledWithNonce() {
				$nonce = WPNonceURL::generate( 'test' );

		$_REQUEST = array(
				'_wpnonce' => 'this-is-a-nonce',
		);
		$this->assertTrue( $nonce->verify() );
		}

		public function testVerifyCalledWithoutNonce() {
				$nonce = WPNonceURL::generate( 'test' );

		$_REQUEST = array();
		$this->assertFalse( $nonce->verify() );
		}

		public function testVerifyAdmin() {
				$nonce = WPNonceURL::generate( 'test' );
				$this->assertTrue( $nonce->verifyAdmin() );
		}

		public function testVerifyAjax() {
				$nonce = WPNonceURL::generate( 'test' );
				$this->assertTrue( $nonce->verifyAjax() );
		}

}
