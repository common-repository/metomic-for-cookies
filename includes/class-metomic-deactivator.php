<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://metomic.io
 * @since      1.0.0
 *
 * @package    Metomic
 * @subpackage Metomic/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Metomic
 * @subpackage Metomic/includes
 * @author     Anosh Malik <anosh@metomic.io>
 */
class Metomic_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option('mtm_project_id');
	}

}
