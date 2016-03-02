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
		'name' 			=> __('Participants', 'post type general name', 'cr3at_conf'),
		'singular_name' => __('Participant', 'post type singular name', 'cr3at_conf'),
		'add_new' 		=> __('Ajout d\'un participant', 'speaker', 'cr3at_conf'),
		'add_new_item' 	=> __('Ajout d\'un participant', 'cr3at_conf'),
		'edit_item' 	=> __('Editer', 'cr3at_conf'),
		'new_item' 		=> __('Nouveau participant', 'cr3at_conf'),
		'view_item' 	=> __('Voir', 'cr3at_conf'),
		'search_items' 	=> __('Rechercher', 'cr3at_conf'),
		'not_found' 			=>  __('Aucun participant n\'a été trouvé.', 'cr3at_conf'),
		'not_found_in_trash' 	=> __('Aucun participant n\'a été trouvé dans la corbeille', 'cr3at_conf'),
		'parent_item_colon' 	=> __('Participant', 'cr3at_conf'),
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
			'supports' => array('')//'title', 'thumbnail')
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
    array(
		'label'	=> __('Organisme, société', 'cr3at_conf'),
		'desc'	=> __('Nom de l\'organisation, la société ou l\'établissement du participant', 'cr3at_conf'),
		'id'	=> 'speakerfirm',
		'type'	=> 'text'
	),
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

$cr3ativspeaker_box = new cr3ativconference_add_meta_box( 'cr3ativconference_box', __('Participant', 'cr3at_conf'), $cr3ativspeaker_fields, 'cr3ativspeaker', true );

add_filter( 'manage_edit-cr3ativspeaker_columns', 'my_edit_cr3ativspeaker_columns' ) ;

function my_edit_cr3ativspeaker_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		/*'title' => __( 'Nom et prénom', 'cr3at_conf' ),*/
        /*'speakerimage' => __( 'Head Shot' , 'cr3at_conf'),*/
		'speakername' => __( 'Identité', 'cr3at_conf' ),
        'speakercompanyname' => __( 'Organisme/Société' , 'cr3at_conf'),
        'speakercompanytitle' => __( 'Titre' , 'cr3at_conf'),
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
	$speakerfirm = get_post_meta($post->ID, 'speakerfirm', $single = true); 
    $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true);
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
        
		case 'speakercompanyname' :

			printf( $speakerfirm ); 
			break;
        
		case 'speakercompanytitle' :

             printf( __($speakertitle) ); 
			break;

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
