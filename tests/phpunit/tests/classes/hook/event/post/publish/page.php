<?php

/**
 * Test case for the Post Publish hook event.
 *
 * @package WordPoints\PHPUnit\Tests
 * @since 2.1.0
 */

/**
 * Tests the Post Publish hook event.
 *
 * @since 2.1.0
 *
 * @covers WordPoints_Hook_Event_Post_Publish
 */
class WordPoints_Hook_Event_Post_Publish_Page_Test extends WordPoints_Hook_Event_Post_Publish_Test {

	/**
	 * @since 2.1.0
	 */
	protected $dynamic_slug = 'page';

	/**
	 * @since 2.3.0
	 */
	protected $expected_targets = array(
		array( 'post\\', 'author', 'user' ),
		array( 'post\\', 'parent', 'post\\', 'author', 'user' ),
	);

	/**
	 * @since 2.3.0
	 */
	protected function create_post( array $args = array() ) {

		$args['post_parent'] = parent::create_post();

		return parent::create_post( $args );
	}
}

// EOF
