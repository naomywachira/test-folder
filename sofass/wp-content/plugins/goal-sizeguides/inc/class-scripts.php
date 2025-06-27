<?php
/**
 * Scripts
 *
 * @package    goal-sizeguides
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class GoalSizeguides_Scripts {
	/**
	 * Initialize scripts
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_backend' ) );
	}

	/**
	 * Loads front files
	 *
	 * @access public
	 * @return void
	 */
	public static function enqueue_backend() {
		wp_enqueue_style( 'goal-sizeguides-style', GOALSIZEGUIDES_PLUGIN_URL . 'assets/style.css', array(), '1.0.0' );
		wp_enqueue_script( 'goal-sizeguides-script', GOALSIZEGUIDES_PLUGIN_URL . 'assets/script.js', array( 'jquery', 'wp-pointer' ), '1.0.0', true );
	}

}

GoalSizeguides_Scripts::init();
