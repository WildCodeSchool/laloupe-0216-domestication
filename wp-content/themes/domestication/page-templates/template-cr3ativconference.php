<?php  
/* 
Template Name: Cr3ativ-Conference

Page retravaillée pour WCS.

*/  
?>

<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativconference_contentwrapper">
    <div class="conf-wrapper OLD_cr3ativconference_content_wrapper">

        <h1><?php _e("[:fr]Programme[:en]Schedule[:]");?></h1>
<?php
        // Récupère toutes les "communications"

        add_filter('posts_orderby','cr3ativoderby2');
        $wp_query = new WP_Query(array(
                        'post_type'         => 'cr3ativconference',
                        'posts_per_page'    => -1,
                        'order'             => 'ASC',
                        'meta_key'          => 'cr3ativconf_date',
                        'meta_query'        => array(
                                                    array(
                                                    'key' => 'cr3ativconf_date',
                                                    ),
                                                    array(
                                                    'key' => 'cr3ativconf_starttime',
                                                    ),
                                                ),
                            )); 
        remove_filter('posts_orderby','cr3ativoderby2');
          
        $sessiondate = '';
        $is_same_date = true;
        $is_same_session = true;
        $day_name = '';
        $is_break = false;
        $has_desc = true;


        while (have_posts()) : the_post();
            $post_id = $post->ID;

            $meetingdate    = get_post_meta($post->ID, 'cr3ativconf_date', $single = true); 
            $starttime      = get_post_meta($post->ID, 'cr3ativconf_starttime', $single = true);
            $endtime        = get_post_meta($post->ID, 'cr3ativconf_endtime', $single = true); 

            $is_same_date = ($sessiondate == $meetingdate);

            // pour chaque communication, récupère les catégories (sessions, journées, pauses)
            $terms = wp_get_post_terms($post->ID, 'cr3ativconfcategory', array('fields'=>'all'));
            foreach($terms as $term) {

                // s'il s'agit d'une journée, d'une pause ou d'une communication sans description
                // (ex "introduction"), on enregistre l'état
                if (!$term->parent) {

                    $has_desc = ($term->slug != "no-desc");
                    $is_break = ($term->slug == "break");
                    if ($has_desc && !$is_break) {
                        $day_name = $term->name;
                        $day_desc = $term->description;
                    }
                }
                // sinon, il s'agit d'une véritable "communication"
                else {
                    $is_same_session = ($session_name == $term->name);
                    $session_name = $term->name;
                    $session_desc = $term->description;
                }
            }

        ?>

        <div class="portfolio-info" >
        
        <?php if (!$is_same_date){ ?>
            
            <!-- Start of conference day and description -->
            <h3 class="conf-section conf-centered"><?php echo $day_name; ?></h3>
            <h6 class="conf-location conf-centered"><?php _e( $day_desc ); ?></h6>
            <!-- End of conference day and description -->

            
        <?php } ?>

        <?php if (!$is_same_session){ ?>
            
            <div class="conf-session">
            <h5 class="conf-section conf-centered OLD_conference_date"><?php echo $session_name; ?></h5>
            <!-- Start of conference description -->
            <h6 class="conf-location conf-centered OLD_conference-location">
                <?php _e( $session_desc ); ?> 
            </h6><!-- End of conference description -->
            </div>
            
            <?php } ?>

            <h6 class="OLD_meeting_date">

            <!-- Start of conference time -->
            <span class="conf-time">
            <?php 
                if ($starttime != ('')) {  
                    print($starttime); 
                }
            
                if ($endtime != ('')) { 
                    print(" - $endtime"); 
                }
            ?>
            </span><!-- End of conference time -->
            <span class="conf-title">
        <?php
            if ($has_desc && !$is_break) {
        ?>                
            <a href="#" title="<?php _e( '[:fr]Afficher [:en]Display [:i]', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        <?php
            }
            else {
                the_title();
            }
        ?>                
            </span>
            </h6>

            <?php $sessiondate = $meetingdate; ?>

            <!-- Start of speaker list -->
            <div>
            <?php
 /* 
            print("postid = $post_id"); 
            $temp = $wp_query; 
            $wp_query = null; 
            $wp_query = new WP_Query(); 
            $args = array(
                'post_type'=>'cr3ativspeaker',
                'meta_query'=>array(
                    'relation' => 'AND',
                    array(
                        'key'=>'speakerisconf',
                        'value'=>'1',
                        'compare'=>'='
                        )
                    ),
                'meta_key'=>'speakerlastname',
                'orderby'=>'meta_value',
                'order'=>'ASC',
                'posts_per_page'=>-1
            );
            $wp_query->query($args); 
            while ($wp_query->have_posts()) {
                $wp_query->the_post();

                if ($post_id == $post->ID) {
                    $lastname = get_post_meta($post->ID, 'speakerlastname', $single = true);
                    $firstname = get_post_meta($post->ID, 'speakerfirstname', $single = true);   
                    $infos = get_post_meta($post->ID, 'speakeradditionnal', $single = true);   
                    
                    // speakerul : contrairement à ce que le nom indique, il peut y en avoir plusieurs séparés par un ";"
                    $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true);   
         
                    $speakerurl_array = array();
                    if ($speakerurl != ('')){
                       $speakerurl_array = explode(";", $speakerurl);
                    }
                    print('<div>');
                    print("<strong>".strtoupper($lastname)." $firstname</strong>");
                    print("<br /><em>$infos</em>");
                    print("</div>");
                }
            }
            $wp_query = null; 
            $wp_query = $temp;  
*/                      


            $cr3ativ_confspeakers = get_post_meta($post->ID, 'cr3ativconf_persons', $single = true); 
	        if ( is_array($cr3ativ_confspeakers) ) { 
				
	        	foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) {

	        		$speaker    = get_post( $cr3ativ_confspeaker );
                    $isconf   = get_post_meta( $speaker->ID, 'speakerisconf', $single = true ); 
                    if ($isconf=='1') {
                        $lastname   = get_post_meta( $speaker->ID, 'speakerlastname', $single = true ); 
                        $firstname  = get_post_meta( $speaker->ID, 'speakerfirstname', $single = true ); 
                        $infos   = get_post_meta( $speaker->ID, 'speakeradditionnal', $single = true ); 

                        print('<div>');
                        print("<strong>".strtoupper($lastname)." $firstname</strong>");
                        print("<br /><em>$infos</em>");
                        print("</div>");
                    }
				}
                foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) {

                    $speaker    = get_post( $cr3ativ_confspeaker );
                    $isconf   = get_post_meta( $speaker->ID, 'speakerisconf', $single = true ); 
                    if ($isconf!='1') {
                        $lastname   = get_post_meta( $speaker->ID, 'speakerlastname', $single = true ); 
                        $firstname  = get_post_meta( $speaker->ID, 'speakerfirstname', $single = true ); 
                        $infos   = get_post_meta( $speaker->ID, 'speakeradditionnal', $single = true ); 

                        print('<div>');
                        print("<strong>".strtoupper($lastname)." $firstname</strong>");
                        print("<br /><em>$infos</em>");
                        print("</div>");
                    }
                }
				
			} 
            
            ?>
            </div><!-- End of speaker list -->


            <!-- Start of session content -->
            <div>
                <p>
                    <?php the_content(); ?>
                    
                   <p> 
                   <?php
                   /*
                   <a class="conference-more" href="<?php the_permalink (); ?>"><?php _e( '[:fr]En savoir plus...[:en]See more...[:]', 'cr3at_conf' ); ?></a>
                   */
                   ?>
                   </p>
                </p><!-- End of session content -->
            </div>
        </div>
        <?php endwhile; ?>

    </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>