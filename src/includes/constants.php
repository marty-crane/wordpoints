<?php

/**
 * WordPoints constants.
 *
 * @package WordPoints
 * @since 1.2.0
 */

/**
 * The plugin version.
 *
 * Conforms to {@link http://semver.org/ Semantic Versioning}.
 *
 * @since 1.0.0
 *
 * @const WORDPOINTS_VERSION
 */
define( 'WORDPOINTS_VERSION', '2.1.0-alpha-1' );

/**
 * The full path to the plugin's main directory.
 *
 * @since 1.0.0
 *
 * @const WORDPOINTS_DIR
 */
define( 'WORDPOINTS_DIR', dirname( dirname( __FILE__ ) ) . '/' );

/**
 * The full URL to the plugin's main directory.
 *
 * @since 1.7.0
 *
 * @const WORDPOINTS_URL
 */
define( 'WORDPOINTS_URL', plugins_url( '', WORDPOINTS_DIR . 'wordpoints.php' ) );

// EOF
