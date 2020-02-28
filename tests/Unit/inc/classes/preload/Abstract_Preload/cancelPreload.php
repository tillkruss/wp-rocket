<?php
namespace WP_Rocket\Tests\Unit\inc\classes\preload\Abstract_Preload;

use Brain\Monkey\Functions;
use WPMedia\PHPUnit\Unit\TestCase;
use WP_Rocket\Preload\Abstract_Preload;
use WP_Rocket\Preload\Full_Process;

class Preload_Test extends Abstract_Preload {
	const PRELOAD_ID = 'test';
}

/**
 * @covers \WP_Rocket\Preload\Process::cancel_preload
 * @group Preload
 */
class Test_CancelPreload extends TestCase {
	private $transient_name = 'rocket_test_preload_running';
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
	}

	public function tearDown() {
		parent::tearDown();
		$this->transients = [];
	}

	public function testShouldCancelPreload() {
		set_transient( 'rocket_test_preload_running', 23 );

		$process = $this->createMock( Full_Process::class );
		$process
			->expects( $this->once() )
			->method( 'cancel_process' );

		( new Preload_Test( $process ) )->cancel_preload();

		$this->assertFalse( get_transient( 'rocket_test_preload_running' ) );
	}
}
