<?php
/**
 * Theme info page
 *
 * @package domestication
 */

//Add the theme page
add_action('admin_menu', 'domestication_add_theme_info');
function domestication_add_theme_info(){
	$theme_info = add_theme_page( __('domestication Info','domestication'), __('domestication Info','domestication'), 'manage_options', 'domestication-info.php', 'domestication_info_page' );
    add_action( 'load-' . $theme_info, 'domestication_info_hook_styles' );
}

//Callback
function domestication_info_page() {
?>
	<div class="info-container">
		<h2 class="info-title"><?php _e('domestication Info','domestication'); ?></h2>
		<div class="info-block"><div class="dashicons dashicons-desktop info-icon"></div><p class="info-text"><a href="http://demo.athemes.com/domestication" target="_blank"><?php _e('Theme demo','domestication'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div><p class="info-text"><a href="http://athemes.com/documentation/domestication" target="_blank"><?php _e('Documentation','domestication'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-sos info-icon"></div><p class="info-text"><a href="http://athemes.com/forums" target="_blank"><?php _e('Support','domestication'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-smiley info-icon"></div><p class="info-text"><a href="http://athemes.com/theme/domestication-pro" target="_blank"><?php _e('Pro version','domestication'); ?></a></p></div>	
	</div>
<?php
}

//Styles
function domestication_info_hook_styles(){
   	add_action( 'admin_enqueue_scripts', 'domestication_info_page_styles' );
}
function domestication_info_page_styles() {
	wp_enqueue_style( 'domestication-info-style', get_template_directory_uri() . '/css/info-page.css', array(), true );
}