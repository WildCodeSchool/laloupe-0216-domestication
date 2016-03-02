<?php

function create_cr3ativconference() {
	$options = get_option('cr3_conferencesettings_options');
	$authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
	$authorbox = strip_tags($authorbox); //sanitise output	
	
	$labels = array(
		'name'               => __( 'Communications', 'post type general name', 'cr3at_conf' ),
		'singular_name'      => __( 'Communication', 'post type singular name', 'cr3at_conf' ),
		'menu_name'          => __( 'Colloque', 'admin menu', 'cr3at_conf' ),
		'add_new'            => __( 'Ajouter une communication', 'session', 'cr3at_conf' ),
		'add_new_item'       => __( 'Ajouter une communication', 'cr3at_conf' ),
		'new_item'           => __( 'Nouvelle communication', 'cr3at_conf' ),
		'edit_item'          => __( 'Editer une communication', 'cr3at_conf' ),
		'view_item'          => __( 'Voir une communication', 'cr3at_conf' ),
		'all_items'          => __( 'Toutes les communications', 'cr3at_conf' ),
		'search_items'       => __( 'Rechercher', 'cr3at_conf' ),
		'not_found'          => __( 'Pas de communication trouvée.', 'cr3at_conf' ),
		'not_found_in_trash' => __( 'Pas de communication trouvée dans la corbeille.', 'cr3at_conf' )
	);
	$cr3ativconference_args = array(
    	'labels' 				=> $labels,
    	'public' 				=> true,
        'menu_icon' 			=> 'dashicons-nametag',
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
        'rewrite' 				=> array('slug' => $authorbox), 
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'supports' 				=> array('title','editor','thumbnail')
    );
        
	register_post_type('cr3ativconference',$cr3ativconference_args);
}

add_action('init', 'create_cr3ativconference');
