<?php
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Custom taxonomies     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'cr3ativconfcategory', 0 );
function cr3ativconfcategory()	{
 $options = get_option('cr3_conferencesettings_options');
 $authorbox2 = (isset($options['authorbox_template2'])) ? $options['authorbox_template2'] : '';
 $authorbox2 = strip_tags($authorbox2); //sanitise output
	register_taxonomy( 
		'cr3ativconfcategory', 
		'cr3ativconference', 
			array( 
				'hierarchical' => true, 
				'label' => __('Categories', 'cr3at_conf'),
				'query_var' => true, 
				'rewrite' => array('slug' => $authorbox2), 
			) 
	);
 
}


// get taxonomies terms links
function custom_taxonomies_terms_links(){
  // get post by post id
    global $post;
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'cr3ativconfcategory' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "" . $taxonomy->label . "&nbsp;:&nbsp;";
      foreach ( $terms as $term ) {
        $out[] =
          '  <a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a>&nbsp;";
      }
      $out[] = "";
    }
  }

  return implode('', $out );
}


