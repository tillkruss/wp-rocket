<?php

namespace WP_Rocket\Tests\Unit\inc\Engine\Cache\WPCache;

use Brain\Monkey\Filters;
use Brain\Monkey\Functions;
use Mockery;
use WP_Rocket\Engine\Cache\WPCache;
use WP_Rocket\Tests\Unit\FilesystemTestCase;

/**
 * @covers \WP_Rocket\Engine\Cache\WPCache::find_wp_config_path
 * @uses   ::rocket_get_constant
 *
 * @group  WPCache
 */
class Test_FindWpConfigPath extends FileSystemTestCase {
    protected $path_to_test_data = '/inc/Engine/Cache/WPCache/findWpconfigPath.php';

	/**
	 * @var string|null
	 */
	private $config_file_name = null;

	public function setUp()
	{
		parent::setUp();

		$this->abspath = $this->filesystem->getUrl( $this->config['vfs_dir'] );
    }

    /**
	 * @dataProvider providerTestData
	 */
	public function testShouldReturnValidConfigFileName( $config, $expected ) {
		$this->config_file_name = isset( $config['config_file_name'] ) ? $config['config_file_name'] : null;

        $filter = Filters\expectApplied('rocket_wp_config_name')->once();

		if ( ! is_null( $this->config_file_name ) ) {
			$filter->andReturn( $this->config_file_name );
        }

        $wp_cache = new WPCache( $this->filesystem );

        $actual = $wp_cache->find_wpconfig_path();

		if ( false !== $actual ) {
			$actual = $this->filesystem->getUrl( $actual );
        }

		$this->assertEquals( $expected, $actual );
	}

	public function changeWpconfigFileName( $config_original_file_name ) {
		return $this->config_file_name;
	}
}