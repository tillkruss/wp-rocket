<?php
namespace WP_Rocket\Tests\Unit\inc\classes\preload\Abstract_Preload;

use Brain\Monkey\Functions;
use WPMedia\PHPUnit\Unit\TestCase;
use WP_Rocket\Preload\Abstract_Preload;

class Preload_Test extends Abstract_Preload {
	const PRELOAD_ID = 'test';

	function __construct() {}
}

/**
 * @covers \WP_Rocket\Preload\Process::get_number_of_preloaded_items
 * @group Preload
 */
class Test_GetNumberOfPreloadedItems extends TestCase {
	private $transient_name = 'rocket_test_preload_running';

	public function testShouldReturnCountIntegerWhenTransientExists() {
		Functions\when( 'get_transient' )->alias( function( $transient_name ) {
			return $transient_name === $this->transient_name ? '23' : false;
		} );

		$this->assertSame( 23, ( new Preload_Test() )->get_number_of_preloaded_items() );
	}

	public function testShouldReturnFalseWhenTransientDoesNotExist() {
		Functions\when( 'get_transient' )->justReturn( false );

		$this->assertFalse( ( new Preload_Test() )->get_number_of_preloaded_items() );
	}
}
