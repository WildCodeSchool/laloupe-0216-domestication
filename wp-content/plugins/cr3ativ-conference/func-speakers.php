<?php
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////      Speaker post type      /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

//==================================================
// Masque le titre dans l'éditeur
//==================================================
add_action('admin_head', 'wcs_adapt_css_admin');
function wcs_adapt_css_admin() {
	global $typenow; 
	if ($typenow=="cr3ativspeaker") {
		print('<style>#post-body-content { display:none; }</style>');
	}
}

add_action('init', 'create_cr3ativspeaker');

function create_cr3ativspeaker() {

 $options = get_option('cr3_conferencesettings_options');
 $authorbox3 = (isset($options['authorbox_template3'])) ? $options['authorbox_template3'] : '';
 $authorbox3 = strip_tags($authorbox3); //sanitise output	
	
		$labels = array(
			'name' 			=> __('Personnes', 'post type general name', 'cr3at_conf'),
			'singular_name' => __('Personne', 'post type singular name', 'cr3at_conf'),
			'add_new' 		=> __('Ajout d\'une personne', 'speaker', 'cr3at_conf'),
			'add_new_item' 	=> __('Ajout d\'une personne', 'cr3at_conf'),
			'edit_item' 	=> __('Editer', 'cr3at_conf'),
			'new_item' 		=> __('Nouvelle personne', 'cr3at_conf'),
			'view_item' 	=> __('Voir', 'cr3at_conf'),
			'search_items' 	=> __('Rechercher', 'cr3at_conf'),
			'not_found' 			=>  __('Personne n\'a été trouvée.', 'cr3at_conf'),
			'not_found_in_trash' 	=> __('Personne n\'a été trouvée dans la corbeille', 'cr3at_conf'),
			'parent_item_colon' 	=> __('Personne', 'cr3at_conf'),
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
			'supports' => array('title')
        );
    	register_post_type('cr3ativspeaker',$cr3ativspeaker_args);
	}

$cr3ativspeaker_fields = array(
	array(
		'label'	=> __('Intervenant-e ?', 'cr3at_conf'),
		'desc'	=> __('Cocher si cette personne interviendra dans le colloque', 'cr3at_conf'),
		'id'	=> 'speakerisconf',
		'type'	=> 'checkbox'
	),
	array(
		'label'	=> __('Nom', 'cr3at_conf'),
		'desc'	=> __('', 'cr3at_conf'),
		'id'	=> 'speakerlastname',
		'type'	=> 'text'
	),
	array(
		'label'	=> __('Prenom', 'cr3at_conf'),
		'desc'	=> __('', 'cr3at_conf'),
		'id'	=> 'speakerfirstname',
		'type'	=> 'text'
	),
	/*
    array(
		'label'	=> __('Organisme, établissement', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - Nom de l\'organisation ou l\'établissement du participant', 'cr3at_conf'),
		'id'	=> 'speakerfirm',
		'type'	=> 'text'
	),
	array(
		'label'	=> __('Ville, Pays', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - Entrer la ville et/ou le pays de l\'organisme.', 'cr3at_conf'),
		'id'	=> 'speakercitycountry',
		'type'	=> 'text'
	),
	array(
		'label'	=> __('Adresse postale complémentaire', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - Entrer l\'adresse de l\'établissement.', 'cr3at_conf'),
		'id'	=> 'speakeraddress',
		'type'	=> 'text'
	),
   */
	array(
		'label'	=> __('Infos complémentaires', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - Entrer des informations supplémentaire. Exemple : établissement, publications, ville, pays...', 'cr3at_conf'),
		'id'	=> 'speakeradditionnal',
		'type'	=> 'textarea'
	),
   array(
		'label'	=> __('Site web', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - URL site web participant ou organisme', 'cr3at_conf'),
		'id'	=> 'speakerurl',
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

$cr3ativspeaker_box = new cr3ativconference_add_meta_box( 'cr3ativconference_box', __('Personne', 'cr3at_conf'), $cr3ativspeaker_fields, 'cr3ativspeaker', true );

add_filter( 'manage_edit-cr3ativspeaker_columns', 'my_edit_cr3ativspeaker_columns' ) ;

function my_edit_cr3ativspeaker_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		/*'title' => __( 'Nom et prénom', 'cr3at_conf' ),*/
        /*'speakerimage' => __( 'Head Shot' , 'cr3at_conf'),*/
		'speakername' => __( 'Identité', 'cr3at_conf' ),
        /*'speakercompanyname' => __( 'Organisme/Société' , 'cr3at_conf'),
        'speakercitycountry' => __( 'Ville/Pays' , 'cr3at_conf'),*/
        'speakerurl' => __( 'Site Web' , 'cr3at_conf'),
        'speakerisconf' => __( 'Intervenant ?' , 'cr3at_conf')        /*'date' => __( 'Date Added' , 'cr3at_conf')*/
	);

	return $columns;
}

add_action( 'manage_cr3ativspeaker_posts_custom_column', 'my_manage_cr3ativspeaker_columns', 10, 2 );

function my_manage_cr3ativspeaker_columns( $column, $post_id ) {
	global $post;
	$speakerisconf = get_post_meta($post->ID, 'speakerisconf', $single = true);
    $speakerlastname = get_post_meta($post->ID, 'speakerlastname', $single = true);
    $speakerfirstname = get_post_meta($post->ID, 'speakerfirstname', $single = true);
/*
	$speakerfirm = get_post_meta($post->ID, 'speakerfirm', $single = true); 
    $speakercitycountry = get_post_meta($post->ID, 'speakercitycountry', $single = true);
*/    
	$speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true); 
	
	switch( $column ) {

/*
		case 'speakerimage' :

			the_post_thumbnail('thumbnail');
			break;
 */
		case 'speakername' :

			/*printf( $speakerlastname );  */
			printf("<a class='row-title' href='post.php?post=".$post->ID."&amp;action=edit' title='Modifier «&nbsp;$speakerlastname&nbsp;»'>".strtoupper($speakerlastname)." $speakerfirstname</a>"
);
			break;
        
		case 'speakerisconf' :

			if ($speakerisconf == "1") {
				printf( "oui" );  
			}
			break;
/*        
		case 'speakercompanyname' :

			printf( $speakerfirm ); 
			break;
        
		case 'speakercitycountry' :

             printf( __($speakercitycountry) ); 
			break;
*/
		case 'speakerurl' :

            printf( "<a href='$speakerurl'>$speakerurl</a><br/>" ); 
			break;


		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}


add_action( 'load-edit.php', 'my_edit_cr3ativspeaker_load' );

function my_edit_cr3ativspeaker_load() {
	add_filter( 'request', 'my_sort_cr3ativspeaker' );
}

// Sorts the speakers.
function my_sort_cr3ativspeaker( $vars ) {

	if ( isset( $vars['post_type'] ) && 'cr3ativspeaker' == $vars['post_type'] ) {

			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'speakerlastname',
					'orderby' => 'meta_value',
					'order' => 'ASC'
				)
			);
	}
	return $vars;
}

function add_js_validation(){    
  wp_enqueue_script(
  	'my_validate', 
  	plugin_dir_url(__FILE__).'includes/js/wcs_required_fields.js'
  	);
}
add_action('admin_enqueue_scripts', 'add_js_validation');   

