<?php

return [
	'vfs_dir'   => 'wp-content/cache/critical-css/',

	// Virtual filesystem structure.
	'structure' => [
		'wp-content' => [
			'cache' => [
				'critical-css' => [
					'1' => [
						'.'              => '',
						'..'             => '',
						'posts'          => [
							'.'                 => '',
							'..'                => '',
							'post-1.css'        => '.post-1 { color: red; }',
							'post-1-mobile.css' => '.post-1 { color: blue; }',
							'post-10.css'       => '.post-10 { color: red; }',
							'page-20.css'       => '.page-20 { color: red; }',
						],
						'home.css'                => '.home { color: red; }',
						'home-mobile.css'         => '.home { color: blue; }',
						'front_page.css'          => '.front_page { color: red; }',
						'front_page-mobile.css'   => '.front_page { color: blue; }',
						'category.css'            => '.category { color: red; }',
						'category-mobile.css'     => '.category { color: blue; }',
						'post_tag.css'            => '.post_tag { color: red; }',
						'post_tag-mobile.css'     => '.post_tag { color: blue; }',
						'page.css'                => '.page { color: red; }',
						'wptests_tax1.css'        => '.wptests_tax1 { color: red; }',
						'wptests_tax1-mobile.css' => '.wptests_tax1 { color: blue; }',
					],
					'2' => [
						'.'              => '',
						'..'             => '',
						'posts'          => [
							'.'           => '',
							'..'          => '',
							'post-1.css'  => '.post-1 { color: red; }',
							'post-3.css'  => '.post-3 { color: red; }',
							'page-20.css' => '.page-20 { color: red; }',
						],
						'home.css'       => '.home { color: red; }',
						'front_page.css' => '.front_page { color: red; }',
						'category.css'   => '.category { color: red; }',
						'post_tag.css'   => '.post_tag { color: red; }',
						'page.css'       => '.page { color: red; }',
					],
				],
			],
		],
	],
	'test_data' => [
		'testShouldReturnDefaultCSS'                            => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'front_page', // default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => false,
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/front_page.css',
		],
		'testShouldReturnDefaultCSSMobile'                      => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'front_page', // default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => false,
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/front_page-mobile.css',
		],
		'testShouldReturnHomeCSS'                               => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'home', // is_home
				'show_on_front' => 'page', // front default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_option',
						'return' => 'page',
						'param'  => 'show_on_front',
					],
				],
				'excluded_type' => [ 'is_front_page', 'is_category', 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/home.css',
		],
		'testShouldReturnHomeCSSMobile'                         => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'home', // is_home
				'show_on_front' => 'page', // front default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_option',
						'return' => 'page',
						'param'  => 'show_on_front',
					],
				],
				'excluded_type' => [ 'is_front_page', 'is_category', 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/home-mobile.css',
		],
		'testShouldReturnFrontPageCSS'                          => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'home', // front default
				'show_on_front' => 'front', // front default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_category', 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/front_page.css',
		],
		'testShouldReturnFrontPageCSSMobile'                    => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'home', // front default
				'show_on_front' => 'front', // front default
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_category', 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/front_page-mobile.css',
		],
		'testShouldReturnCategoryPageCSS'                       => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_category', // category
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/category.css',
		],
		'testShouldReturnCategoryPageCSSMobile'                 => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_category', // category
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_tag', 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/category-mobile.css',
		],
		'testShouldReturnTagCSS'                                => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_tag',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/post_tag.css',
		],
		'testShouldReturnTagCSSMobile'                          => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_tag',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => true,
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_tax', 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/post_tag-mobile.css',
		],
		'testShouldReturnTaxCSS'                                => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_tax',
				'taxonomy'      => 'wptests_tax1',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_queried_object',
						'return' => (object) [ 'taxonomy' => 'wptests_tax1' ],
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/wptests_tax1.css',
		],
		'testShouldReturnTaxCSSMobile'                          => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_tax',
				'taxonomy'      => 'wptests_tax1',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_queried_object',
						'return' => (object) [ 'taxonomy' => 'wptests_tax1' ],
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_singular' ],
			],
			'expected_file' => 'wp-content/cache/critical-css/1/wptests_tax1-mobile.css',
		],
		'testShouldReturnEmptyWhenTaxDoesNotExist' => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_tax',
				'taxonomy'      => 'wptests_tax2',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_queried_object',
						'return' => (object) [ 'taxonomy' => 'wptests_tax2' ],
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_singular' ],
			],
			'expected_file'     => '',
		],
		'testShouldReturnEmptyWhenTaxDoesNotExistMobile' => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_tax',
				'taxonomy'      => 'wptests_tax2',
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_queried_object',
						'return' => (object) [ 'taxonomy' => 'wptests_tax2' ],
						'param'  => '',
					],
				],
				'excluded_type' => [ 'is_singular' ],
			],
			'expected_file'     => '',
		],
		'testShouldReturnSingularCSS'                           => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_page',
				'post_id'       => 2,
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_post_type',
						'return' => 'page',
						'param'  => '',
					],
					[
						'type'   => 'get_the_ID',
						'return' => '2',
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file'     => 'wp-content/cache/critical-css/1/page.css',
		],
		'testShouldReturnSingularCSSNoMobile'                   => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_page',
				'post_id'       => 2,
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_post_type',
						'return' => 'page',
						'param'  => '',
					],
					[
						'type'   => 'get_the_ID',
						'return' => '2',
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file'     => 'wp-content/cache/critical-css/1/page.css',
		],
		'testShouldReturnSingularCustomPostsCSS'                => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 0,
					'async_css_mobile'        => 0,
				],
				'wp_is_mobile'  => false,
				'type'          => 'is_post',
				'post_id'       => 1,
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_post_type',
						'return' => 'post',
						'param'  => '',
					],
					[
						'type'   => 'get_the_ID',
						'return' => '1',
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file'     => 'wp-content/cache/critical-css/1/posts/post-1.css',
		],
		'testShouldReturnSingularCustomPostsCSSMobile'          => [
			'config'        => [
				'blog_id'       => 1,
				'settings'      => [
					'do_caching_mobile_files' => 1,
					'async_css_mobile'        => 1,
				],
				'wp_is_mobile'  => true,
				'type'          => 'is_post',
				'post_id'       => 1,
				'expected_type' => [
					[
						'type'   => 'is_home',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_front_page',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_category',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tag',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_tax',
						'return' => false,
						'param'  => '',
					],
					[
						'type'   => 'is_singular',
						'return' => true,
						'param'  => '',
					],
					[
						'type'   => 'get_post_type',
						'return' => 'post',
						'param'  => '',
					],
					[
						'type'   => 'get_the_ID',
						'return' => '1',
						'param'  => '',
					],
				],
				'excluded_type' => [],
			],
			'expected_file'     => 'wp-content/cache/critical-css/1/posts/post-1-mobile.css',
		],
	],
];
