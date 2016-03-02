<?php
/**
 * domestication child functions
 *
 */


/**
 * Enqueues the parent stylesheet. Do not remove this function.
 *
 */
add_action( 'wp_enqueue_scripts', 'domestication_child_enqueue' );
function domestication_child_enqueue() {
    
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/* ADD YOUR CUSTOM FUNCTIONS BELOW */