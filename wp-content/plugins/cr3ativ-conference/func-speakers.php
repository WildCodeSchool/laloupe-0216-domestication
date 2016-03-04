<?php
/*--------------------------------------------------------------------

	post type : "Personnes"

--------------------------------------------------------------------*/

//====================================================================
// Masque le titre dans le formulaire de saisie d'une personne.
// Cette fonction est appelée à l'initialisation de la page
//
// Remarque : 
// tenter de supprimer le "title" dans le paramètre "supports"
// du tableau de création du custom type (fonction create_cr3ativspeaker)
// crée un bug sur l'outil de publication du formulaire.
// C'est pourquoi il a été choisi de simplement masquer le titre en css
//====================================================================
add_action('admin_head', 'wcs_adapt_css_admin');
function wcs_adapt_css_admin() {
	global $typenow; 
	if ($typenow=="cr3ativspeaker") {
		print('<style>#post-body-content, .search-box { display:none; }</style>');
	}
}



//====================================================================
// Créé :
// - le "custom type" personne, 
// - le sous-menu "Personne" dans "Colloque"
// - les libellés de la liste des "Personnes". 
//====================================================================
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


//====================================================================
// Créé le formulaire de saisie "Personne".
//====================================================================
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
		'label'	=> __('Infos complémentaires', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - Entrer des informations supplémentaire. Exemple : établissement, publications, ville, pays...', 'cr3at_conf'),
		'id'	=> 'speakeradditionnal',
		'type'	=> 'textarea'
	),
   array(
		'label'	=> __('Site(s) web', 'cr3at_conf'),
		'desc'	=> __('(facultatif) - URL site(s) web(s) participant ou organisme. Si plusieurs sites, les séparer avec un ";".', 'cr3at_conf'),
		'id'	=> 'speakerurl',
		'type'	=> 'text'
	)
);

$cr3ativspeaker_box = new cr3ativconference_add_meta_box( 
	'cr3ativconference_box', 
	__('Personne', 'cr3at_conf'), 
	$cr3ativspeaker_fields, 
	'cr3ativspeaker', 
	true 
	);


//====================================================================
// Définit les colonnes de la liste des "Personnes"
//====================================================================
add_filter( 'manage_edit-cr3ativspeaker_columns', 'my_edit_cr3ativspeaker_columns' ) ;

function my_edit_cr3ativspeaker_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'speakername' => __( 'Identité', 'cr3at_conf' ),
        'speakerurl' => __( 'Site Web' , 'cr3at_conf'),
        'speakerisconf' => __( 'Intervenant ?' , 'cr3at_conf')        
        //'date' => __( 'Date Added' , 'cr3at_conf')
	);

	return $columns;
}


//====================================================================
// Affiche les données de chaque "Personnes" par colonnes
// dans la liste des "Personnes"
//====================================================================
add_action( 'manage_cr3ativspeaker_posts_custom_column', 'my_manage_cr3ativspeaker_columns', 10, 2 );

function my_manage_cr3ativspeaker_columns( $column, $post_id ) {
	global $post;
	$speakerisconf = get_post_meta($post->ID, 'speakerisconf', $single = true);
    $speakerlastname = get_post_meta($post->ID, 'speakerlastname', $single = true);
    $speakerfirstname = get_post_meta($post->ID, 'speakerfirstname', $single = true);
	$speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true); 
	
	switch( $column ) {

		case 'speakername' :

			printf("<a class='row-title' href='post.php?post=".$post->ID."&amp;action=edit' title='Modifier «&nbsp;$speakerlastname&nbsp;»'>".strtoupper($speakerlastname)." $speakerfirstname</a>");
			break;
        
		case 'speakerisconf' :

			if ($speakerisconf == "1") {
				printf( "oui" );  
			}
			break;

		case 'speakerurl' :

            printf( "<a href='$speakerurl'>$speakerurl</a><br/>" ); 
			break;


		// Just break out of the switch statement for everything else.
		default :
			break;
	}
}


//====================================================================
// Applique un tri sur la liste de "Personnes" au chargment de celle-ci
//====================================================================
add_action( 'load-edit.php', 'cr3ativspeaker_on_load_list' );

function cr3ativspeaker_on_load_list() {
	add_filter( 'request', 'cr3ativspeaker_sort' );
}

function cr3ativspeaker_sort( $vars ) {

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

//====================================================================
//
// TO DO
//
// script JS permettant d'exiger la saisie de certain champs
// dans le formulaire de saisie d'une "Personne".
//====================================================================
function add_js_validation(){    
  wp_enqueue_script(
  	'my_validate', 
  	plugin_dir_url(__FILE__).'includes/js/wcs_required_fields.js'
  	);
}
add_action('admin_enqueue_scripts', 'add_js_validation');   

