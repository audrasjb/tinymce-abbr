<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://jeanbaptisteaudras.com
 * @since             1.0.0
 * @package           Abbreviations
 *
 * @wordpress-plugin
 * Plugin Name:       Abbreviations
 * Plugin URI:        http://jeanbaptisteaudras.com/
 * Description:       Provides abbreviations control on WordPress TinyMCE editor.
 * Version:           1.0.0
 * Author:            Jean-Baptiste Audras
 * Author URI:        http://jeanbaptisteaudras.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       abbr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-abbr-activator.php
 */
function activate_abbr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-abbr-activator.php';
	abbr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-abbr-deactivator.php
 */
function deactivate_abbr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-abbr-deactivator.php';
	abbr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_abbr' );
register_deactivation_hook( __FILE__, 'deactivate_abbr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-abbr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_abbr() {

	$plugin = new abbr();
	$plugin->run();

}
run_abbr();
