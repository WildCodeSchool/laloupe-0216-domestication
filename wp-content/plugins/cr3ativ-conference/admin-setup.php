<?php
/* display page content */
function cr3_conferencesettings_admin_page_screen() {
	 global $submenu;
	// access page settings 
	 $page_data = array();
	 foreach($submenu['options-general.php'] as $i => $menu_item) {
	 if($submenu['options-general.php'][$i][2] == 'cr3_conferencesettings')
	 $page_data = $submenu['options-general.php'][$i];
	 }

// output 
?>
<div class="wrap">
    <style>
#cr3_conferencesettings_options .form-table th, #cr3_conferencesettings_options .form-wrap label {
display: none;
}
#cr3_conferencesettings_options label {
    cursor: pointer;
    display: block;
    float: left;
    width: 25%;
}
</style>
       

<?php screen_icon();?>
<h2><?php _e('Cr3ativ Conference Settings', 'cr3at_conf');?></h2>
<form id="cr3_conferencesettings_options" action="options.php" method="post">
<?php
settings_fields('cr3_conferencesettings_options');
do_settings_sections('cr3_conferencesettings'); 
submit_button('Save options', 'primary', 'cr3_conferencesettings_options_submit');
?>
 </form>
</div>
<?php
}

add_action('admin_init', 'cr3_conferencesettings_flush' );

function cr3_conferencesettings_flush(){

	if ( isset( $_POST['cr3_conferencesettings_options'] ) ) {


		flush_rewrite_rules();
	
	}

} 
function cr3_conferencesettings_settings_init(){

	register_setting(
	 'cr3_conferencesettings_options',
	 'cr3_conferencesettings_options',
	 'cr3_conferencesettings_options_validate'
	 );

	add_settings_section(
	 'cr3_conferencesettings_authorbox',
	 '', 
	 'cr3_conferencesettings_authorbox_desc',
	 'cr3_conferencesettings'
	 );

	add_settings_field(
	 'cr3_conferencesettings_authorbox_template',
	 '', 
	 'cr3_conferencesettings_authorbox_field',
	 'cr3_conferencesettings',
	 'cr3_conferencesettings_authorbox'
	 );
	    
	add_settings_field(
	 'cr3_conferencesettings_authorbox_template2',
	 '', 
	 'cr3_conferencesettings_authorbox_field2',
	 'cr3_conferencesettings',
	 'cr3_conferencesettings_authorbox2'
	 );
	    
	add_settings_field(
	 'cr3_conferencesettings_authorbox_template3',
	 '', 
	 'cr3_conferencesettings_authorbox_field3',
	 'cr3_conferencesettings',
	 'cr3_conferencesettings_authorbox3'
	 );
    
}

add_action('admin_init', 'cr3_conferencesettings_settings_init');

/* validate input */
function cr3_conferencesettings_options_validate($input){
	global $allowedposttags, $allowedrichhtml;
	if(isset($input['authorbox_template']))
	 $input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
	 $input['authorbox_template2'] = wp_kses_post($input['authorbox_template2']);
	 $input['authorbox_template3'] = wp_kses_post($input['authorbox_template3']);
	return $input;
}

/* description text */
function cr3_conferencesettings_authorbox_desc(){
	_e('Please set the slug name(s) below for your single pages and session category pages.  Default urls will be used if nothing is set.', 'cr3at_conf');
}

/* filed output */
function cr3_conferencesettings_authorbox_field() {
	$options = get_option('cr3_conferencesettings_options');
	$authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
	$authorbox = strip_tags($authorbox); //sanitise output
	$authorbox2 = (isset($options['authorbox_template2'])) ? $options['authorbox_template2'] : '';
	$authorbox2 = strip_tags($authorbox2); //sanitise output
	$authorbox3 = (isset($options['authorbox_template3'])) ? $options['authorbox_template3'] : '';
	$authorbox3 = strip_tags($authorbox3); //sanitise output
?>
<p>
    <label><?php _e('Session Single Page Slug Name', 'cr3at_conf');?></label>
 <input type="text" id="authorbox_template" name="cr3_conferencesettings_options[authorbox_template]" value="<?php echo $authorbox; ?>" /></p>

<p>
    <label><?php _e('Session Category Page Slug Name', 'cr3at_conf');?></label>
 <input type="text" id="authorbox_template2" name="cr3_conferencesettings_options[authorbox_template2]" value="<?php echo $authorbox2; ?>" /></p>

<p>
    <label><?php _e('Speaker Single Page Slug Name', 'cr3at_conf');?></label>
 <input type="text" id="authorbox_template3" name="cr3_conferencesettings_options[authorbox_template3]" value="<?php echo $authorbox3; ?>" /></p>
<?php
}
function cr3_conferencesettings_admin_menu_setup(){
	add_submenu_page(
	 'edit.php?post_type=cr3ativconference',
	 __('Cr3ativ Conference Options', 'cr3at_conf'),
	 __('Conference Options', 'cr3at_conf'),
	 'manage_options',
	 'cr3_conferencesettings',
	 'cr3_conferencesettings_admin_page_screen'
	 );
}
add_action('admin_menu', 'cr3_conferencesettings_admin_menu_setup'); //menu setup
