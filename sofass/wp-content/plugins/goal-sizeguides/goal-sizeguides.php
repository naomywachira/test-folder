<?php
/**
 * Plugin Name: Goal Sizeguides
 * Plugin URI: http://goalthemes.com/plugins/goal-sizeguides/
 * Description: Create Sizeguidess.
 * Version: 1.0.0
 * Author: GoalThemes
 * Author URI: http://goalthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.6
 *
 * Text Domain: goal-sizeguides
 * Domain Path: /languages/
 *
 * @package goal-sizeguides
 * @category Plugins
 * @author GoalThemes
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("GoalSizeguides") ){
	
	final class GoalSizeguides{

		/**
		 * @var GoalSizeguides The one true GoalSizeguides
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * GoalSizeguides Settings Object
		 *
		 * @var object
		 * @since 1.0.0
		 */
		public $goalsizeguides_settings;

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * Main GoalSizeguides Instance
		 *
		 * Insures that only one instance of GoalSizeguides exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0.0
		 * @static
		 * @staticvar array $instance
		 * @uses      GoalSizeguides::setup_constants() Setup the constants needed
		 * @uses      GoalSizeguides::includes() Include the required files
		 * @uses      GoalSizeguides::load_textdomain() load the language files
		 * @see       GoalSizeguides()
		 * @return    GoalSizeguides
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof GoalSizeguides ) ) {
				self::$instance = new GoalSizeguides;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			// Plugin version
			if ( ! defined( 'GOALSIZEGUIDES_VERSION' ) ) {
				define( 'GOALSIZEGUIDES_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'GOALSIZEGUIDES_PLUGIN_DIR' ) ) {
				define( 'GOALSIZEGUIDES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'GOALSIZEGUIDES_PLUGIN_URL' ) ) {
				define( 'GOALSIZEGUIDES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'GOALSIZEGUIDES_PLUGIN_FILE' ) ) {
				define( 'GOALSIZEGUIDES_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once GOALSIZEGUIDES_PLUGIN_DIR . 'inc/class-settings.php';
			require_once GOALSIZEGUIDES_PLUGIN_DIR . 'inc/class-helper.php';
			
			require_once GOALSIZEGUIDES_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once GOALSIZEGUIDES_PLUGIN_DIR . 'inc/class-scripts.php';
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for GoalSizeguides's languages directory
			$lang_dir = dirname( plugin_basename( GOALSIZEGUIDES_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'goalsizeguides_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'goal-sizeguides' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'goal-sizeguides', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/goal-sizeguides/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/goalsizeguides folder
				load_textdomain( 'goal-sizeguides', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/goalsizeguides/languages/ folder
				load_textdomain( 'goal-sizeguides', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'goal-sizeguides', false, $lang_dir );
			}
		}

	}
}

function goal_sizeguides() {
	return GoalSizeguides::getInstance();
}

goal_sizeguides();
