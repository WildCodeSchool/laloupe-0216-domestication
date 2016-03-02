<?php
/**
 * Plugin Name: Cr3ativ Conference Plugin
 * Plugin URI: http://cr3ativ.com/conference
 * Description: Custom written plugin for your conference needs on your WordPress site.
 * Author: Jonathan Atkinson
 * Author URI: http://cr3ativ.com/
 * Version: 1.4.1
 */

/* Place custom code below this line. */

/* Variables */
$ja_cr3ativ_conference_main_file = dirname(__FILE__).'/cr3ativ-conference.php';
$ja_cr3ativ_conference_directory = plugin_dir_url($ja_cr3ativ_conference_main_file);
$ja_cr3ativ_conference_path = dirname(__FILE__);

/* Add css file */
function creativ_conference_add_scripts() {
	global $ja_cr3ativ_conference_directory, $ja_cr3ativ_conference_path;
		wp_enqueue_style('creativ_conference', $ja_cr3ativ_conference_directory.'css/cr3ativconference.css');
}
		
add_action('wp_enqueue_scripts', 'creativ_conference_add_scripts');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       WP Default Functionality       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////            Theme Options Metabox            /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'includes/meta_box.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_plugin_textdomain('cr3at_conf', false, basename( dirname( __FILE__ ) ) . '/languages' );

include_once( dirname(__FILE__) . "/admin-setup.php" );
include_once( dirname(__FILE__) . "/admin-menu.php" );
include_once( dirname(__FILE__) . "/func-sessions.php" );
include_once( dirname(__FILE__) . "/func-speakers.php" );
include_once( dirname(__FILE__) . "/func-categories.php" );

function cr3ativoderby($orderby) {
    return 'mt1.meta_value, mt2.meta_value, mt3.meta_value ASC';
}
function cr3ativoderby2($orderby) {
    return 'mt1.meta_value, mt2.meta_value ASC';
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////                   Widget                        /////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( dirname(__FILE__).'/includes/session-widget.php' );
include_once( dirname(__FILE__).'/includes/speaker-widget.php' );


/*-------------------------------------------------------
Enlève les rubriques inutilisées des menus
--------------------------------------------------------*/
function wcs_remove_unused_menus()
{
	if (current_user_can('editor')) {
		  remove_menu_page( 'index.php' );                  //Dashboard
		  remove_menu_page( 'edit.php' );                   //Posts
		  remove_menu_page( 'upload.php' );                 //Media
		  remove_menu_page( 'edit-comments.php' );          //Comments
		  remove_menu_page( 'edit.php?post_type=page' );    //Pages
		  remove_menu_page( 'themes.php' );                 //Appearance
		  remove_menu_page( 'plugins.php' );                //Plugins
		  remove_menu_page( 'users.php' );                  //Users
		  remove_menu_page( 'tools.php' );                  //Tools
		  remove_menu_page( 'options-general.php' );        //Settings
	}
}
add_action( 'admin_menu', 	'wcs_remove_unused_menus' );


?>