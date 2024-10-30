<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://metomic.io
 * @since      1.0.0
 *
 * @package    Metomic
 * @subpackage Metomic/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Metomic
 * @subpackage Metomic/admin
 * @author     Anosh Malik <anosh@metomic.io>
 */
class Metomic_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $metomic    The ID of this plugin.
	 */
	private $metomic;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $metomic       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $metomic, $version ) {

		$this->metomic = $metomic;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Metomic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Metomic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->metomic, plugin_dir_url( __FILE__ ) . 'css/metomic-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Metomic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Metomic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->metomic, plugin_dir_url( __FILE__ ) . 'js/metomic-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_plugin_page()
	{
		add_options_page(
			'Configure Metomic for Wordpress',
			'Metomic Settings',
			'manage_options',
			'metomic-admin',
			array( $this, 'create_admin_page' )
		);
	}

	public function page_init()
	{
		add_settings_section(
			'setting_section_id', // ID
			// 'Metomic Settings', // Title
			null,
			array( $this, 'print_section_info' ), // Callback
			'metomic-admin' // Page
		);

		add_settings_field(
            'mtm_project_id', // ID
            'Consent Manager project ID:', // Title 
            array( $this, 'project_id_callback' ), // Callback
            'metomic-admin', // Page
            'setting_section_id' // Section           
		);
		
		if (isset($_REQUEST['mtm_project_id'])) {
			update_option('mtm_project_id', $_REQUEST['mtm_project_id']);
		}
	}

	public function project_id_callback()
    {
        printf(
            '<input type="text" id="mtm_project_id" name="mtm_project_id" value="%s" />',
            get_option('mtm_project_id', null) ? esc_attr( get_option('mtm_project_id', null) ) : ''
        );
    }

	public function create_admin_page()
	{
		include(plugin_dir_path( __FILE__ ) . 'partials/metomic-admin-display.php');
	}

	public function print_section_info()
	{
		print("");
	}

}
