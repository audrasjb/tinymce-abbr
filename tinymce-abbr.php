<?php

/**
 * @link              https://jeanbaptisteaudras.com/tinymce-abbr/
 * @since             1.0
 * @package           Abbreviation button for TinyMCE
 *
 * @wordpress-plugin
 * Plugin Name:       Abbreviation button for TinyMCE
 * Plugin URI:        https://jeanbaptisteaudras.com/tinymce-abbr/
 * Description:       Provides abbreviations button for WordPress TinyMCE visual editor.
 * Version:           1.3.7
 * Author:            Jb Audras, CTO @ Whodunit
 * Author URI:        https://jeanbaptisteaudras.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       abbreviation-button-for-tinymce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class TinyMCE_ABBR {
	/**
	* Plugin constructor.
	*/
	function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array(  $this, 'setup_tinymce_abbr' ) );
		}
	}
	/**
	* Check if the current user can edit Posts or Pages, and is using the Visual Editor
	* If so, add some filters
	*/
	function setup_tinymce_abbr() {
		// Check if the logged in WordPress User can edit Posts or Pages
		// If not, don't register
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        	return;
		}

		// Check if the logged in WordPress User has the Visual Editor enabled
		// If not, don't register
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		// Setup filters
		add_action( 'plugins_loaded', 'load_languages_tinymce_abbr' );
		add_action( 'before_wp_tiny_mce', array( &$this, 'translate_tinymce_abbr' ) );
		add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_abbr' ) );
		add_filter( 'mce_buttons_2', array( &$this, 'add_tinymce_abbr_toolbar_button' ) );		
	}	

	/**
	* Adds the plugin to the TinyMCE / Visual Editor instance
	*	
	* @param array $plugin_array Array of registered TinyMCE Plugins
	* @return array Modified array of registered TinyMCE Plugins
	*/
	function add_tinymce_abbr( $plugin_array ) {
		$plugin_array['tinymce_abbr_class'] = plugin_dir_url( __FILE__ ) . 'admin/js/tinymce-abbr-class.js';
		return $plugin_array;
	}

	/**
	* Plugin's internationalization 
	*	
	* First load translation files
	* Then add translation strings to a javascript variable
	*/
	function load_languages_tinymce_abbr() {
	    load_plugin_textdomain( 'abbreviation-button-for-tinymce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
	// Adding i18n tinymce strings
	function translate_tinymce_abbr() {
		$translations = json_encode(
			array( 
				'abbr_add_button' 		=> __('Abbreviation', 'abbreviation-button-for-tinymce'),
				'abbr_delete_button' 	=> __('Delete abbreviation', 'abbreviation-button-for-tinymce'),
				'abbr_title_label' 		=> __('Title', 'abbreviation-button-for-tinymce'),
				'abbr_title_help' 		=> __('The meaning of your abbreviation', 'abbreviation-button-for-tinymce'),
				'abbr_lang_label'		=> __('Language (optional)', 'abbreviation-button-for-tinymce'),
				'abbr_lang_help' 		=> __('Example: fr, en, de, etc. Use it only if the abbreviation’s language is different from page main language', 'abbreviation-button-for-tinymce'),
				'abbr_alert' 			=> __('Please select some text first', 'abbreviation-button-for-tinymce')
			)
		);
		echo '<script>var abbrTranslations = ' . $translations . ';</script>';
	}

	/**
	* Adds a button to the TinyMCE / Visual Editor which the user can click
	* to insert the abbr node tag.
	*
	* @param array $buttons Array of registered TinyMCE Buttons
	* @return array Modified array of registered TinyMCE Buttons
	*/
	function add_tinymce_abbr_toolbar_button( $buttons ) {
		array_push( $buttons, 'tinymce_abbr_class' );
		return $buttons;
	}
}
$TinyMCE_ABBR = new TinyMCE_ABBR;