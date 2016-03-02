<?php
/**
 * Plugin Name: Sydney Portfolio
 * Plugin URI: http://athemes.com
 * Description: This plugin adds a shortcode that you can use to display your portfolio in a filterable masonry layout
 * Version: 1.0
 * Author: aThemes
 * License: GPLv2 or later
 */

/*  Copyright 2015  athemes.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

/* Load the scripts */
function sydney_masonry_scripts() {
    wp_enqueue_script( 'sydney-isotope', plugin_dir_url( __FILE__ ) . '/lib/js/isotope.min.js', array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', 'sydney_masonry_scripts' );

/* Image size */
function sydney_masonry_images() {
    add_image_size('sydney-mas-thumb', 480);
}
add_action( 'after_setup_theme', 'sydney_masonry_images' );

/* Shortcode function */
function sydney_masonry_shortcode( $atts , $content = null ) {

    extract( shortcode_atts(
        array(
            'posts'         => '8',
            'post_type'     => 'projects',
            'include'       => '',
            'filter'        => 'yes',
            'show_all_text' => 'Show all'
        ), $atts )
    );

    $output = ''; //Start output
    if ($include && $filter == 'yes') {
        $included_terms = explode( ',', $include );
        $included_ids = array();

        foreach( $included_terms as $term ) {
            $term_id = get_term_by( 'slug', $term, 'category')->term_id;
            $included_ids[] = $term_id;
        }

        $id_string = implode( ',', $included_ids );
        $terms = get_terms( 'category', array( 'include' => $id_string ) );

        //Build the filter
        $output .= '<ul class="project-filter" id="filters">';
            $output .= '<li><a href="#" data-filter="*">' . $show_all_text .'</a></li>';
            $count = count($terms);
            if ( $count > 0 ){
                foreach ( $terms as $term ) {
                    $output .= "<li><a href='#' data-filter='.".$term->slug."'>" . $term->name . "</a></li>\n";
                }
            } 
        $output .= '</ul>';
    }
    //Build the layout
    $output .= '<div class="roll-project fullwidth">';
    $output .= '<div class="project-wrap" id="isotope-container" data-portfolio-effect="fadeInUp">';
    $the_query = new WP_Query( array ( 'post_type' => $post_type, 'posts_per_page' => $posts, 'category_name' => $include ) );
    while ( $the_query->have_posts() ):
        $the_query->the_post();
        global $post;
        $id = $post->ID;
        $termsArray = get_the_terms( $id, 'category' );
        $termsString = "";
         
        if ( $termsArray) {
            foreach ( $termsArray as $term ) {
                $termsString .= $term->slug.' ';
            }
        }
        if ( has_post_thumbnail() ) {
            $project_url = get_post_meta( get_the_ID(), 'wpcf-project-link', true );
            if ( $project_url ) :
                $output .= '<div class="project-item item isotope-item ' . $termsString . '"><a class="project-pop" href="' . esc_url($project_url) . '"><div class="project-pop-inner"></div></a><a href="' . esc_url($project_url) . '">' . get_the_post_thumbnail($post->ID,'sydney-mas-thumb') . '</a></div>';
            else :
                $output .= '<div class="project-item item isotope-item ' . $termsString . '"><a class="project-pop" href="' . get_the_permalink() . '"><div class="project-pop-inner"></div></a><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail($post->ID,'sydney-mas-thumb') . '</a></div>';
            endif;
        }
    endwhile;
    wp_reset_postdata();
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}
add_shortcode( 'sydney-masonry', 'sydney_masonry_shortcode' );

add_filter( 'widget_text', 'do_shortcode');