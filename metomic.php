<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://metomic.io
 * @since             1.0.0
 * @package           Metomic
 *
 * @wordpress-plugin
 * Plugin Name:       Metomic for Cookies
 * Plugin URI:        http://landing.metomic.io/
 * Description:       With Metomic, businesses can be both transparent and successful. We provide businesses with the power to understand their data networks and therefore enable their customers to give informed consent. By using Metomic to build trust with their customers, businesses can use transparency as a key differentiator to enhance their products and services.
 * Version:           1.3.2
 * Author:            Metomic
 * Author URI:        http://metomic.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       metomic
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'METOMIC_VERSION', '1.3.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-metomic-activator.php
 */
function activate_metomic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-metomic-activator.php';
	Metomic_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-metomic-deactivator.php
 */
function deactivate_metomic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-metomic-deactivator.php';
	Metomic_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_metomic' );
register_deactivation_hook( __FILE__, 'deactivate_metomic' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-metomic.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_metomic() {

	$plugin = new Metomic(plugin_basename(__FILE__));
	$plugin->run();

}
run_metomic();
