<?php
$cr3ativconference_fields = array(
	array(
            'label' => __('Date', 'cr3at_conf'),
            'desc' => __('Choose the date.', 'cr3at_conf'),
            'id' => 'cr3ativconfmeetingdate',
            'type' => 'date',
            'std' => ''
        ),
	array(
        'label'    => __('Start Time', 'cr3at_conf'),
        'desc'    => __('Select the start time. 24-hour clock, 01:00-00:30', 'cr3at_conf'),
        'id'      => 'cr3ativ_confstarttime',
        'type' => 'text',
        'std' => ""
    ),
    /*
	array(
        'label'    => __('Display Start Time', 'cr3at_conf'),
        'desc'    => __('This is only if you do not wish to display your times in the 24-hour clock format.  The plugin will still use the above time in the 24-hour clock format to sort, but what is placed here will display instead of the above.  If you leave this blank, the above time will display.', 'cr3at_conf'),
        'id'      => 'cr3ativ_confdisplaystarttime',
        'type' => 'text',
        'std' => ""
    ),
    */
	array(
        'label'    => __('End Time', 'cr3at_conf'),
        'desc'    => __('Select the end time. 24-hour clock, 01:00-00:30', 'cr3at_conf'),
        'id'      => 'cr3ativ_confendtime',
        'type' => 'text',
        'std' => ""
    ),
    /*
	array(
        'label'    => __('Display End Time', 'cr3at_conf'),
        'desc'    => __('This is only if you do not wish to display your times in the 24-hour clock format.  The plugin will still use the above time in the 24-hour clock format to sort, but what is placed here will display instead of the above.  If you leave this blank, the above time will display.', 'cr3at_conf'),
        'id'      => 'cr3ativ_confdisplayendtime',
        'type' => 'text',
        'std' => ""
    ),
    */
    /*
	array(
            'label' => __('Location', 'cr3at_conf'),
            'desc' => __('Enter location.', 'cr3at_conf'),
            'id' => 'cr3ativ_conflocation',
            'type' => 'text',
            'std' => ""
        ),
	*/        
	array(
            'label' => __('Speaker', 'cr3at_conf'),
            'desc' => __('Select the speakers.', 'cr3at_conf'),
            'id' => 'cr3ativ_confspeaker',
            'type' => 'post_chosen_speaker',
            'std' => ""
    )
    /*,

	array(
            'label' => __('Highlight Style', 'cr3at_conf'),
            'desc' => __('Select this checkbox if you would like to have a highlight this session.', 'cr3at_conf'),
            'id' => 'cr3ativ_highlight',
            'type' => 'checkbox',
            'std' => ""
    )
    */
);
 
$cr3ativconference_box = new cr3ativconference_add_meta_box( 'cr3ativconference_box', __('Session Information', 'cr3at_conf'), $cr3ativconference_fields, 'cr3ativconference', true );


add_filter( 'manage_edit-cr3ativconference_columns', 'my_edit_cr3ativconference_columns' ) ;

function my_edit_cr3ativconference_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Session Name', 'cr3at_conf' ),
		'sessiondate' => __( 'Date', 'cr3at_conf' ),
		'sessionstarttime' => __( 'Start Time', 'cr3at_conf' ),
        'sessionendtime' => __( 'End Time', 'cr3at_conf' ),
		//'sessionlocation' => __( 'Location' , 'cr3at_conf'),
        'speaker' => __( 'Speakers' , 'cr3at_conf'),
        'session_category' => __( 'Session Category' , 'cr3at_conf')
	);

	return $columns;
}

add_action( 'manage_cr3ativconference_posts_custom_column', 'my_manage_cr3ativconference_columns', 10, 2 );

function my_manage_cr3ativconference_columns( $column, $post_id ) {
	global $post;
            $sessiondatestart = get_post_meta($post->ID, 'cr3ativ_confstarttime', $single = true); 
	        $sessiondateend = get_post_meta($post->ID, 'cr3ativ_confendtime', $single = true); 
	        $sessionlocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
	        $sessionmeetingdate = get_post_meta($post->ID, 'cr3ativconfmeetingdate', $single = true);
            $cr3ativ_confspeakers = get_post_meta($post->ID, 'cr3ativ_confspeaker', $single = true);
	switch( $column ) {

		case 'sessiondate' :
        if ( !empty( $sessionmeetingdate ) ) {
			$dateformat = get_option('date_format');
            echo date($dateformat, $sessionmeetingdate);
        }
			break;
        
		case 'sessionstarttime' :

             printf( $sessiondatestart ); 
			break;

		case 'sessionendtime' :

             printf( $sessiondateend );
			break;

		/*
		case 'sessionlocation' :

			 printf( $sessionlocation );
			break;
        */

		case 'speaker' :

			 if ( $cr3ativ_confspeakers ) { 
				
	        	foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) :
	        	
	        		$speaker = get_post($cr3ativ_confspeaker);

	        		echo '<a href="'. admin_url() .'edit.php?post_type=cr3ativspeaker">'. $speaker->post_title .'</a><br/>'; 
				
				endforeach; 
				
			}
			break;
        
		case 'session_category' :

			$terms = get_the_terms( $post_id, 'cr3ativconfcategory' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				
				foreach ( $terms as $term ) {
					$out[] = $term->name;
					/*
					$out[] = sprintf( 
						'<a href="%s">%s</a>',
						
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'cr3ativconfcategory' => $term->slug ), 'edit.php' ) ),
						_($term->name)
						//esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'cr3ativconfcategory', 'display' ) )
					);
					*/
				}
				

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

add_filter( 'manage_edit-cr3ativconference_sortable_columns', 'my_cr3ativconference_sortable_columns' );

function my_cr3ativconference_sortable_columns( $columns ) {

	$columns['sessiondate'] = 'sessiondate';

	return $columns;
}

/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'my_edit_cr3ativconference_load' );

function my_edit_cr3ativconference_load() {
	add_filter( 'request', 'my_sort_cr3ativconference' );
}

/* Sorts the movies. */
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
