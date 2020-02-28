<?php

namespace WP_Rocket\Tests\Unit\inc\classes\preload\Full_Process;

use Brain\Monkey\Functions;
use WPMedia\PHPUnit\Unit\TestCase;
use WP_Rocket\Preload\Full_Process;
use WP_Rocket\Tests\Integration\FilesystemTestCase;

/**
 * @covers \WP_Rocket\Preload\Full_Process::complete
 * @group  Preload
 */
class Test_Complete extends FilesystemTestCase {
	private $transients = [];

	public function setUp() {
		parent::setUp();

		$this->transients = [];

		Functions\when( 'get_transient' )->alias( function( $transient ) {
			return isset( $this->transients[ $transient ] ) ? $this->transients[ $transient ] : false;
		} );
		Functions\when( 'set_transient' )->alias( function( $transient, $value ) {
			return $this->transients[ $transient ] = $value;
		} );
		Functions\when( 'delete_transient' )->alias( function( $transient ) {
			$this->transients[ $transient ] = null;
		} );

		Functions\when( 'get_option' )->alias( function( $option ) {
			switch ( $option ) {
				case 'date_format':
					return '!! Y-m-d';
				case 'time_format':
					return 'H:i:s !!';
				default:
					return false;
			}
		} );
		Functions\when( 'date_i18n' )->alias( function( $format ) {
			switch ( $format ) {
				case '!! Y-m-d':
					return '!! 1985-10-26';
				case 'H:i:s !!':
					return '01:22:00 !!';
				default:
					return false;
			}
		} );
		Functions\when( 'wp_next_scheduled' )->justReturn( false );
	}

	public function tearDown() {
		parent::tearDown();
		$this->transients = [];
	}

	public function testShouldAddPreloadedURLsCount() {
		$process = new Full_Process();

		set_transient( 'rocket_homepage_preload_running', 4 );
		set_transient( 'rocket_sitemap_preload_running', 3 );

		$process->complete();

		$this->assertFalse( get_transient( 'rocket_homepage_preload_running' ) );
		$this->assertFalse( get_transient( 'rocket_sitemap_preload_running' ) );
		$this->assertSame( 7, get_transient( 'rocket_preload_complete' ) );
		$this->assertSame( '!! 1985-10-26 @ 01:22:00 !!', get_transient( 'rocket_preload_complete_time' ) );

		delete_transient( 'rocket_preload_complete' );
		set_transient( 'rocket_homepage_preload_running', 5 );

		$process->complete();

		$this->assertFalse( get_transient( 'rocket_homepage_preload_running' ) );
		$this->assertFalse( get_transient( 'rocket_sitemap_preload_running' ) );
		$this->assertSame( 5, get_transient( 'rocket_preload_complete' ) );

		delete_transient( 'rocket_preload_complete' );
		set_transient( 'rocket_sitemap_preload_running', 2 );

		$process->complete();

		$this->assertFalse( get_transient( 'rocket_homepage_preload_running' ) );
		$this->assertFalse( get_transient( 'rocket_sitemap_preload_running' ) );
		$this->assertSame( 2, get_transient( 'rocket_preload_complete' ) );
	}
}
