<?php

/**
 * Testcase for the [wordpoints_points] shortcode.
 *
 * @package WordPoints\Tests\Points
 * @since 1.4.0
 */

/**
 * Test the [wordpoints_points] shortcode.
 *
 * Since 1.0.0 this was a part of the WordPoints_Points_Shortcodes_Test, which was
 * split into a separate testcase for each shortcode.
 *
 * @since 1.4.0
 *
 * @group points
 * @group shortcodes
 */
class WordPoints_Points_Shortcode_Test extends WordPoints_Points_UnitTestCase {

	/**
	 * Test that the [wordpoints_points] shortcode exists.
	 *
	 * @since 1.4.0
	 */
	public function test_shortcode_exists() {

		$this->assertTrue( shortcode_exists( 'wordpoints_points' ) );
	}

	/**
	 * Test the result when the user has no points.
	 *
	 * @since 1.4.0
	 */
	public function test_ouput_when_user_has_no_points() {

		$user_id = $this->factory->user->create();

		$old_current_user = wp_get_current_user();
		wp_set_current_user( $user_id );

		$this->assertEquals(
			'$0pts.'
			, wordpointstests_do_shortcode_func(
				'wordpoints_points'
				, array( 'points_type' => 'points' )
			)
		);

		wp_set_current_user( $old_current_user->ID );
	}

	/**
	 * Test the result when the user has points.
	 *
	 * @since 1.4.0
	 */
	public function test_output_when_user_has_points() {

		$user_id = $this->factory->user->create();

		$old_current_user = wp_get_current_user();
		wp_set_current_user( $user_id );

		wordpoints_alter_points( $user_id, 10, 'points', 'test' );

		$this->assertEquals( 10, wordpoints_get_points( $user_id, 'points' ) );

		$this->assertEquals(
			'$10pts.'
			, wordpointstests_do_shortcode_func(
				'wordpoints_points'
				, array( 'points_type' => 'points' )
			)
		);

		wp_set_current_user( $old_current_user->ID );
	}

	/**
	 * Test the user_id attribute.
	 *
	 * @since 1.4.0
	 */
	public function test_user_id_attribute() {

		$user_id = $this->factory->user->create();

		wordpoints_alter_points( $user_id, 10, 'points', 'test' );
		$this->assertEquals( 10, wordpoints_get_points( $user_id, 'points' ) );

		$this->assertEquals(
			'$10pts.'
			, wordpointstests_do_shortcode_func(
				'wordpoints_points'
				, array( 'points_type' => 'points', 'user_id' => $user_id )
			)
		);
	}

	/**
	 * Test that nothing is displayed to a normal user on failure.
	 *
	 * @since 1.4.0
	 */
	public function test_nothing_displayed_to_normal_user_on_failure() {

		$user_id = $this->factory->user->create();

		$old_current_user = wp_get_current_user();
		wp_set_current_user( $user_id );

		// There should be no error with an invalid points type.
		$this->assertEquals( null, wordpointstests_do_shortcode_func( 'wordpoints_points' ) );

		wp_set_current_user( $old_current_user->ID );
	}

	/**
	 * Test that an error is displayed to an admin user on failure.
	 *
	 * @since 1.4.0
	 */
	public function test_error_displayed_to_admin_user_on_failure() {

		// Create a user and assign them admin-like capabilities.
		$user = $this->factory->user->create_and_get();
		$user->add_cap( 'manage_options' );

		$old_current_user = wp_get_current_user();
		wp_set_current_user( $user->ID );

		// Check for an error when no points type is provided.
		$this->assertTag(
			array(
				'tag' => 'p',
				'attributes' => array(
					'class' => 'wordpoints-shortcode-error',
				),
			)
			, wordpointstests_do_shortcode_func( 'wordpoints_points' )
		);

		wp_set_current_user( $old_current_user->ID );
	}
}

// EOF
