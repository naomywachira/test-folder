<?php
/**
 * helper
 *
 * @package    goal-sizeguides
 * @author     GoalThemes <goaltheme@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  23/12/2020 GoalThemes
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class GoalSizeguides_Helper {
	public static function display() {
		echo GoalSizeguides_Template_Loader::get_template_part('content');
	}
}