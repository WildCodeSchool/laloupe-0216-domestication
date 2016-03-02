<?php
/*
 * Educate Breadcrumbs
*/
function educate_custom_breadcrumbs() {

  $educate_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $educate_delimiter = '/'; // educate_delimiter between crumbs
  $educate_home = __('Home','educate'); // text for the 'Home' link
  $educate_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $educate_before = ' '; // tag before the current crumb
  $educate_after = ' '; // tag after the current crumb

  global $post;
  $educate_homelink = home_url('/');

  if (is_home() || is_front_page()) {

    if ($educate_showonhome == 1) echo '<li><a href="' . $educate_homelink . '">' . $educate_home . '</a></li>';

  }  else {

    echo '<li><a href="' . $educate_homelink . '">' . $educate_home . '</a> ' . $educate_delimiter . '';

   if ( is_category() ) {
      $educate_thisCat = get_category(get_query_var('cat'), false);
      if ($educate_thisCat->parent != 0) echo get_category_parents($educate_thisCat->parent, TRUE, ' ' . $educate_delimiter . ' ');
		echo $educate_before; _e('category','educate'); echo ' "'.single_cat_title('', false) . '"' . $educate_after;
    }
    elseif ( is_search() ) {
      echo $educate_before; _e('Search Results For','educate'); echo ' "'. get_search_query() . '"' . $educate_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $educate_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $educate_delimiter . ' ';
      echo $educate_before . get_the_time('d') . $educate_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $educate_delimiter . ' ';
      echo $educate_before . get_the_time('F') . $educate_after;

    } elseif ( is_year() ) {
      echo $educate_before . get_the_time('Y') . $educate_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $educate_post_type = get_post_type_object(get_post_type());
        $educate_slug = $educate_post_type->rewrite;
        echo '<a href="' . $educate_homelink . '/' . $educate_slug['slug'] . '/">' . $educate_post_type->labels->singular_name . '</a>';
        if ($educate_showcurrent == 1) echo ' ' . $educate_delimiter . ' ' . $educate_before . get_the_title() . $educate_after;
      } else {
        $educate_cat = get_the_category(); $educate_cat = $educate_cat[0];
        $educate_cats = get_category_parents($educate_cat, TRUE, ' ' . $educate_delimiter . ' ');
        if ($educate_showcurrent == 0) $educate_cats = preg_replace("#^(.+)\s$educate_delimiter\s$#", "$1", $educate_cats);
        echo $educate_cats;
        if ($educate_showcurrent == 1) echo $educate_before . get_the_title() . $educate_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $educate_post_type = get_post_type_object(get_post_type());
      echo $educate_before . $educate_post_type->labels->singular_name . $educate_after;

    } elseif ( is_attachment() ) {
      $educate_parent = get_post($post->post_parent);
      $educate_cat = get_the_category($educate_parent->ID); $educate_cat = $educate_cat[0];
      echo get_category_parents($educate_cat, TRUE, ' ' . $educate_delimiter . ' ');
      echo '<a href="' . get_permalink($educate_parent) . '">' . $educate_parent->post_title . '</a>';
      if ($educate_showcurrent == 1) echo ' ' . $educate_delimiter . ' ' . $educate_before . get_the_title() . $educate_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($educate_showcurrent == 1) echo $educate_before . get_the_title() . $educate_after;

    } elseif ( is_page() && $post->post_parent ) {
      $educate_parent_id  = $post->post_parent;
      $educate_breadcrumbs = array();
      while ($educate_parent_id) {
        $educate_page = get_page($educate_parent_id);
        $educate_breadcrumbs[] = '<a href="' . get_permalink($educate_page->ID) . '">' . get_the_title($educate_page->ID) . '</a>';
        $educate_parent_id  = $educate_page->post_parent;
      }
      $educate_breadcrumbs = array_reverse($educate_breadcrumbs);
      for ($educate_i = 0; $educate_i < count($educate_breadcrumbs); $educate_i++) {
        echo $educate_breadcrumbs[$educate_i];
        if ($educate_i != count($educate_breadcrumbs)-1) echo ' ' . $educate_delimiter . ' ';
      }
      if ($educate_showcurrent == 1) echo ' ' . $educate_delimiter . ' ' . $educate_before . get_the_title() . $educate_after;

    } elseif ( is_tag() ) {
      echo $educate_before; _e('Posts tagged','educate'); echo ' "'.  single_tag_title('', false) . '"' . $educate_after;

    } elseif ( is_author() ) {
       global $author;
      $educate_userdata = get_userdata($author);
      echo $educate_before; _e('Articles posted by ','educate'); echo $educate_userdata->display_name . $educate_after;

    } elseif ( is_404() ) {
      echo $educate_before; _e('Error 404','educate'); echo $educate_after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','educate') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</li>';

  }
}
