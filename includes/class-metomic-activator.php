<?php

/**
 * Fired during plugin activation
 *
 * @link       http://metomic.io
 * @since      1.0.0
 *
 * @package    Metomic
 * @subpackage Metomic/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Metomic
 * @subpackage Metomic/includes
 * @author     Anosh Malik <anosh@metomic.io>
 */
class Metomic_Activator {
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $basename    The basename of this plugin.
	 */
	private $basename;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $basename    The basename of this plugin.
	 */
	public function __construct( $basename ) {

		$this->basename = $basename;

	}

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('mtm_project_id', '');
	}

	public function redirect_metomic_settings($plugin)
	{
		if( $plugin == $this->basename ) {
			exit( wp_redirect( admin_url( 'options-general.php?page=metomic-admin' ) ) );
		}
	}

}
