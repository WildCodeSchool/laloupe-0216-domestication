<?php

/*
 * thumbnail list
 */

function educate_thumbnail_image($content) {
    if (has_post_thumbnail())
        return the_post_thumbnail('thumbnail');
}

/*
 * Register OpenSans Google font for educate
 */

function educate_font_url() {
    $educate_font_url = '';
    if ('off' !== _x('on', 'OpenSans font: on or off', 'educate')) {
        $educate_font_url = add_query_arg('family', urlencode('OpenSans:300,400,700,900,300italic,400italic,700italic'), "//fonts.googleapis.com/css");
    }
    return $educate_font_url;
}

/*
 * educate Main Sidebar
 */

function educate_widgets_init() {

    register_sidebar(array(
        'name' => __('Main Sidebar', 'educate'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'educate'),
        'before_widget' => '<div class="sidebar-widget %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 1', 'educate'),
        'id' => 'footer-1',
        'description' => __('Footer First that appears on the bottom.', 'educate'),
        'before_widget' => '<div class="footer-widget %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'educate'),
        'id' => 'footer-2',
        'description' => __('Footer Second that appears on the bottom.', 'educate'),
        'before_widget' => '<div class="footer-widget %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer 3', 'educate'),
        'id' => 'footer-3',
        'description' => __('Footer Third that appears on the bottom.', 'educate'),
        'before_widget' => '<div class="footer-widget %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer 4', 'educate'),
        'id' => 'footer-4',
        'description' => __('Footer Forth that appears on the bottom.', 'educate'),
        'before_widget' => '<div class="footer-widget %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'educate_widgets_init');

/*
 * educate Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 */

function educate_entry_meta() {

    $educate_category_list = get_the_category_list(', ', ' ');
    $educate_tag_list = get_the_tag_list(' ', ', ');
    $educate_author = sprintf('<a href="%1$s" title="%2$s" >%3$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'educate'), get_the_author())), get_the_author());

    $educate_utility_text = '<ul>';
    if ($educate_category_list) {
        $educate_utility_text .= '<li>%1$s</li>';
    }
    if ($educate_tag_list) {
        $educate_utility_text .= '<li>%2$s</li>';
    }
    $educate_utility_text .= '<li>%3$s</li><li>' . educate_comment_number_custom() . '</li></ul>';
    printf(
            $educate_utility_text, $educate_category_list, $educate_tag_list, $educate_author
    );
}

function educate_comment_number_custom() {
    $educate_num_comments = get_comments_number(); // get_comments_number returns only a numeric value
    $educate_comments = __('No Comments', 'educate');
    if (comments_open()) {
        if ($educate_num_comments == 0) {
            $educate_comments = __('No Comments', 'educate');
        } elseif ($educate_num_comments > 1) {
            $educate_comments = $educate_num_comments . __(' Comments', 'educate');
        } else {
            $educate_comments = __('1 Comment', 'educate');
        }
    }
    return $educate_comments;
}

function educate_entry_meta_date() {
    $educate_date = sprintf('<a href="#" title="%1$s"> <b class="color-text">%2$s</b> <span>%3$s</span></a>', esc_attr(get_the_date('c')), esc_html(get_the_date('d')), esc_html(get_the_date('M' . ' ' . 'Y'))
    );
    printf($educate_date);
}

/*
 * Comments placeholder function
 *
 * */
add_filter('comment_form_default_fields', 'educate_comment_placeholders');

function educate_comment_placeholders($fields) {
    $fields['author'] = str_replace(
            '<input', '<input placeholder="'
            /* Replace 'theme_text_domain' with your theme’s text domain.
             * I use _x() here to make your translators life easier. :)
             * See http://codex.wordpress.org/Function_Reference/_x
             */
            . _x(
                    'Name *', 'comment form placeholder', 'educate'
            )
            . '" required', $fields['author']
    );
    $fields['email'] = str_replace(
            '<input', '<input placeholder="'
            . _x(
                    'Email Id *', 'comment form placeholder', 'educate'
            )
            . '" required', $fields['email']
    );
    $fields['url'] = str_replace(
            '<input', '<input placeholder="'
            . _x(
                    'Website URl', 'comment form placeholder', 'educate'
            )
            . '" required', $fields['url']
    );

    return $fields;
}

add_filter('comment_form_defaults', 'educate_textarea_insert');

function educate_textarea_insert($fields) {
    $fields['comment_field'] = str_replace(
            '<textarea', '<textarea  placeholder="'
            . _x(
                    'Comment', 'comment form placeholder', 'educate'
            )
            . '" ', $fields['comment_field']
    );
    return $fields;
}

?>
