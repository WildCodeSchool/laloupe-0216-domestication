<?php
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////      Speaker post type      /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action('init', 'create_cr3ativspeaker');

function create_cr3ativspeaker() {
 $options = get_option('cr3_conferencesettings_options');
 $authorbox3 = (isset($options['authorbox_template3'])) ? $options['authorbox_template3'] : '';
 $authorbox3 = strip_tags($authorbox3); //sanitise output	
	
	$labels = array(
		'name' 			=> __('Intervenants', 'post type general name', 'cr3at_conf'),
		'singular_name' => __('Intervenant', 'post type singular name', 'cr3at_conf'),
		'add_new' 		=> __('Ajout d\'un intervenant', 'speaker', 'cr3at_conf'),
		'add_new_item' 	=> __('Ajout d\'un intervenant', 'cr3at_conf'),
		'edit_item' 	=> __('Editer', 'cr3at_conf'),
		'new_item' 		=> __('Nouvel intervenant', 'cr3at_conf'),
		'view_item' 	=> __('Voir', 'cr3at_conf'),
		'search_items' 	=> __('Rechercher', 'cr3at_conf'),
		'not_found' 			=>  __('Aucun intervenant n\'a été trouvé.', 'cr3at_conf'),
		'not_found_in_trash' 	=> __('Aucun intervenant n\'a été trouvé dans la corbeille', 'cr3at_conf'),
		'parent_item_colon' 	=> __('Intervenant', 'cr3at_conf'),
	);
	
    	$cr3ativspeaker_args = array(
        	'labels' => $labels,
        	'public' => true,
            'menu_icon' => 'dashicons-admin-users',
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $authorbox3), 
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
            'show_in_menu' => 'edit.php?post_type=cr3ativconference',
			'supports' => array('title','editor','thumbnail')
        );
    	register_post_type('cr3ativspeaker',$cr3ativspeaker_args);
	}

$cr3ativspeaker_fields = array(
	array(
		'label'	=> __('Titre', 'cr3at_conf'),
		'desc'	=> __('Entrer le titre professionnel.', 'cr3at_conf'),
		'id'	=> 'speakertitle',
		'type'	=> 'text'
	),
    array(
		'label'	=> __('Site web', 'cr3at_conf'),
		'desc'	=> __('URL page web société ou professionnelle', 'cr3at_conf'),
		'id'	=> 'speakerurl',
		'type'	=> 'text'
	),
    array(
		'label'	=> __('Organisme, société', 'cr3at_conf'),
		'desc'	=> __('Nom de l\'organisation, la société ou l\'établissement de l\'intervenant', 'cr3at_conf'),
		'id'	=> 'speakerurltext',
		'type'	=> 'text'
	)
/*
,
	array( // Repeatable & Sortable Text inputs
		'label'	=> __('Social Follow', 'cr3at_conf'), // <label>
		'desc'	=> __('Add as many social follows as you would like.', 'cr3at_conf'), // description
		'id'	=> 'speakerrepeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'url' => 'sanitize_text_field'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			array( // Image ID field
				'label'	=> __('Image', 'cr3at_conf'), // <label>
				'id'	=> 'speakerrepeatable_socailimage', // field id and name
				'type'	=> 'image' // type of field
			),
			'url' => array(
				'label' => __('URL', 'cr3at_conf'),
				'id' => 'speakerrepeatable_socailurl',
				'type' => 'url'
			)

		)
	)
*/
);

$cr3ativspeaker_box = new cr3ativconference_add_meta_box( 'cr3ativconference_box', __('Speaker Data', 'cr3at_conf'), $cr3ativspeaker_fields, 'cr3ativspeaker', true );

add_filter( 'manage_edit-cr3ativspeaker_columns', 'my_edit_cr3ativspeaker_columns' ) ;

function my_edit_cr3ativspeaker_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
        /*'speakerimage' => __( 'Head Shot' , 'cr3at_conf'),*/
		'title' => __( 'Nom et prénom', 'cr3at_conf' ),
        'speakercompanyname' => __( 'Organisme/Société' , 'cr3at_conf'),
        'speakercompanytitle' => __( 'Titre' , 'cr3at_conf')//,
        /*'date' => __( 'Date Added' , 'cr3at_conf')*/
	);

	return $columns;
}

add_action( 'manage_cr3ativspeaker_posts_custom_column', 'my_manage_cr3ativspeaker_columns', 10, 2 );

function my_manage_cr3ativspeaker_columns( $column, $post_id ) {
	global $post;
            $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true); 
	        $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true); 
	        $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true); 
	switch( $column ) {

		case 'speakerimage' :

			 the_post_thumbnail('thumbnail');
			break;
        
		case 'speakercompanyname' :

			 echo '<a href="'. $speakerurl .'">'. $speakerurltext .'</a><br/>'; 
			break;
        
		case 'speakercompanytitle' :

             printf( $speakertitle ); 
			break;


		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

