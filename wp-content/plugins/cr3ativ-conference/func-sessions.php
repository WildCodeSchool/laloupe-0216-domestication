<?php
/*--------------------------------------------------------------------

	post type : "Communications"

--------------------------------------------------------------------*/

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
		'supports' 				=> array('title','editor')
    );
        
	register_post_type('cr3ativconference',$cr3ativconference_args);
}

add_action('init', 'create_cr3ativconference');


//====================================================================
// Créé le formulaire de saisie "Communications".
//====================================================================
$cr3ativconference_fields = array(
	array(
        'label' => __('Date', 'cr3at_conf'),
        'desc' 	=> __('Choisir la date de la communication (format : Jour/Mois/Année).', 'cr3at_conf'),
        'id' 	=> 'cr3ativconf_date',
        'type' 	=> 'date',
        'std' 	=> ''
        ),
	array(
        'label' => __('Heure de début', 'cr3at_conf'),
        'desc'  => __('Définir l\'heure du début de la communication, au format (exemple: 14:30', 'cr3at_conf'),
        'id'    => 'cr3ativconf_starttime',
        'type' 	=> 'text',
        'std' 	=> ""
    ),
	array(
        'label' => __('Heure de fin', 'cr3at_conf'),
        'desc'  => __('', 'cr3at_conf'),
        'id'    => 'cr3ativconf_endtime',
        'type' 	=> 'text',
        'std' 	=> ""
    ),
    array(
        'label' => __('Intervenants', 'cr3at_conf'),
        'desc' 	=> __('Sélectionnez les intervenants. Pour en sélectionner plusieurs, maintenir la touche CTRL', 'cr3at_conf'),
        'id' 	=> 'cr3ativconf_speakers',
        'type' 	=> 'post_chosen_speaker',
        'std' 	=> ""
    ),
	array(
        'label' => __('Co-auteurs', 'cr3at_conf'),
        'desc' 	=> __('Sélectionnez les auteurs, les co-auteurs. Pour en sélectionner plusieurs, maintenir la touche CTRL', 'cr3at_conf'),
        'id' 	=> 'cr3ativconf_coauthors',
        'type' 	=> 'post_chosen_coauthor',
        'std' 	=> ""
    )
);
 
$cr3ativconference_box = new cr3ativconference_add_meta_box( 
	'cr3ativconference_box', 
	__('Fiche communication / Pause ou autre', 'cr3at_conf'), 
	$cr3ativconference_fields, 
	'cr3ativconference', 
	true 
	);


//====================================================================
// Définit les colonnes de la liste des "Communications"
//====================================================================
add_filter( 'manage_edit-cr3ativconference_columns', 'my_edit_cr3ativconference_columns' ) ;

function my_edit_cr3ativconference_columns( $columns ) {

	$columns = array(
		'cb' 				=> '<input type="checkbox" />',
		'title' 			=> __( 'Titre', 'cr3at_conf' ),
		'session_date' 		=> __( 'Date', 'cr3at_conf' ),
		'session_hours' 	=> __( 'Heures', 'cr3at_conf' ),
        'speakers' 			=> __( 'Personnes' , 'cr3at_conf')/*,
        'session_category' => __( 'Classé dans' , 'cr3at_conf')*/
	);

	return $columns;
}

//====================================================================
// Affiche les données de chaque "Communications" par colonnes
// dans la liste des "Communications"
//====================================================================
add_action( 'manage_cr3ativconference_posts_custom_column', 'my_manage_cr3ativconference_columns', 10, 2 );

function my_manage_cr3ativconference_columns( $column, $post_id ) {

	global $post;

    $meetingdate = get_post_meta($post->ID, 'cr3ativconf_date', $single = true);
    $datestart = get_post_meta($post->ID, 'cr3ativconf_starttime', $single = true); 
    $dateend = get_post_meta($post->ID, 'cr3ativconf_endtime', $single = true); 
    $speakers = get_post_meta($post->ID, 'cr3ativconf_speakers', $single = true);
    $coauthors = get_post_meta($post->ID, 'cr3ativconf_coauthors', $single = true);
   	$hours = $datestart.' - '.$dateend;

	switch( $column ) {

		case 'session_date' :
	        if ( !empty( $meetingdate ) ) {
				$dateformat = get_option('date_format');
	            echo date('d/m/Y', $meetingdate);
	        }
			break;
        
		case 'session_hours' :

             printf( $hours ); 
			break;

		case 'speakers' :

			 if ( is_array($speakers) ) { 
	        	foreach ( $speakers as $speaker ) {    	
	        		$speaker = get_post($speaker);
	        		echo "<b>".$speaker->speakerlastname .' '. $speaker->speakerfirstname .'</b><br/>'; 
				}
			}
			 if ( is_array($coauthors) ) { 
	        	foreach ( $coauthors as $coauthor ) {    	
	        		$coauthor = get_post($coauthor);
	        		echo $coauthor->speakerlastname .' '. $coauthor->speakerfirstname .'<br/>'; 
				}
			}
			break;
        
		case 'session_category' :

			$terms = get_the_terms( $post_id, 'cr3ativconfcategory' );

			if ( !empty( $terms ) ) {

				$out = array();

				foreach ( $terms as $term ) {
					$out[] = __($term->name);
				}

				echo join( ', ', $out );
			}

			break;

		// Just break out of the switch statement for everything else.
		default :
			break;
	}
}


//====================================================================
// Applique un tri sur la liste de "Communications" au chargment de celle-ci
//====================================================================
add_filter( 'manage_edit-cr3ativconference_sortable_columns', 'my_cr3ativconference_sortable_columns' );

function my_cr3ativconference_sortable_columns( $columns ) {

	$columns['session_date'] = 'session_date';

	return $columns;
}

add_action( 'load-edit.php', 'my_edit_cr3ativconference_load' );

function my_edit_cr3ativconference_load() {
	add_filter( 'request', 'my_sort_cr3ativconference' );
}

//====================================================================
// Applique un tri sur la liste de "Communications" au chargment de celle-ci
//====================================================================
function my_sort_cr3ativconference( $vars ) {

	if ( isset( $vars['post_type'] ) && 'cr3ativconference' == $vars['post_type'] ) {
		if ( isset( $vars['orderby'] ) && 'sessiondate' == $vars['orderby'] ) {
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'cr3ativconfmeetingdate',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}

	return $vars;
}
