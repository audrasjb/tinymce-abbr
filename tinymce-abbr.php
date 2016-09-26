<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://jeanbaptisteaudras.com/tinymce-abbr/
 * @since             1.0.0
 * @package           Abbreviation button for TinyMCE
 *
 * @wordpress-plugin
 * Plugin Name:       Abbreviation button for TinyMCE
 * Plugin URI:        http://jeanbaptisteaudras.com/tinymce-abbr/
 * Description:       Provides abbreviations button for WordPress TinyMCE visual editor.
 * Version:           1.0.0
 * Author:            Jean-Baptiste Audras, project manager @ Whodunit
 * Author URI:        http://jeanbaptisteaudras.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tinymce-abbr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class TinyMCE_ABBR {
	
	/**
	* Constructor. Called when the plugin is initialised.
	*/
	function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array(  $this, 'setup_tinymce_abbr' ) );
		}
	}
	
	/**
	* Check if the current user can edit Posts or Pages, and is using the Visual Editor
	* If so, add some filters so we can register our plugin
	*/
	function setup_tinymce_abbr() {

	// Check if the logged in WordPress User can edit Posts or Pages
	// If not, don't register our TinyMCE plugin
	
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
	}

	// Check if the logged in WordPress User has the Visual Editor enabled
	// If not, don't register our TinyMCE plugin
	if ( get_user_option( 'rich_editing' ) !== 'true' ) {
		return;
	}

	// Setup some filters
	add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_abbr' ) );
	add_filter( 'mce_buttons', array( &$this, 'add_tinymce_abbr_toolbar_button' ) );		
	}	

	/**
	* Adds a TinyMCE plugin compatible JS file to the TinyMCE / Visual Editor instance
	*
	* @param array $plugin_array Array of registered TinyMCE Plugins
	* @return array Modified array of registered TinyMCE Plugins
	*/
	function add_tinymce_abbr( $plugin_array ) {
		$plugin_array['tinymce_abbr_class'] = plugin_dir_url( __FILE__ ) . 'admin/js/tinymce-abbr-class.js';
		$plugin_array['tinymce_abbr_delete_class'] = plugin_dir_url( __FILE__ ) . 'admin/js/tinymce-abbr-delete-class.js';
		return $plugin_array;
	}
	
	/**
	* Adds a button to the TinyMCE / Visual Editor which the user can click
	* to insert a link with a custom CSS class.
	*
	* @param array $buttons Array of registered TinyMCE Buttons
	* @return array Modified array of registered TinyMCE Buttons
	*/
	function add_tinymce_abbr_toolbar_button( $buttons ) {
		array_push( $buttons, 'tinymce_abbr_class' );
		array_push( $buttons, 'tinymce_abbr_delete_class' );
		return $buttons;
	}
	
    	

}
$TinyMCE_ABBR = new TinyMCE_ABBR;