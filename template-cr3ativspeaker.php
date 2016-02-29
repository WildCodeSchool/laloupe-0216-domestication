<?php  
/* 
Template Name: Cr3ativSpeaker
*/  
?>

<?php get_header(); ?>

    <!-- Start of content wrapper -->
    <div id="cr3ativconference_contentwrapper">

        <!-- Start of content wrapper -->
        <div class="cr3ativconference_content_wrapper">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

            <?php 
            if ( has_post_thumbnail() ) {  ?>

            <?php the_post_thumbnail(''); ?>

            <?php } ?>

            <?php the_content('        '); ?> 

            <?php endwhile; ?> 

            <?php else: ?> 
            <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3at_conf' ); ?></p> 

            <?php endif; ?>

            <div class="cr3ativconference_clearbig"></div>

            <?php 
            $temp = $wp_query; 
            $wp_query = null; 
            $wp_query = new WP_Query(); 
            $wp_query->query('post_type=cr3ativspeaker&posts_per_page=999999'); 
            ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

            
                <?php
                $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true); 
                $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true);   
                ?>
                        
            <!-- Start of conference wrapper -->
            <div class="cr3ativconference_speaker_wrapper"> 

                <!-- Start of speaker image -->
                <div class="cr3ativconference_speaker_image">
                    <a href="<?php the_permalink (); ?>"><?php the_post_thumbnail(''); ?></a>

                </div><!-- End of speaker image -->

                <!-- Start of speaker name -->
                <div class="cr3ativconference_speaker_name">
                    <a href="<?php the_permalink (); ?>"><?php the_title (); ?></a>

                </div><!-- End of speaker name -->

                <!-- Start of speaker title -->
                <div class="cr3ativconference_speaker_title">
                    <?php if ($speakertitle != ('')){ ?>
                    <?php echo stripslashes($speakertitle); ?>
                    <?php } ?>

                </div><!-- End of speaker title -->

                <!-- Start of speaker title -->
                <div class="cr3ativconference_speaker_company">
                    <?php if ($speakerurltext != ('')){ ?>
                    <?php echo stripslashes($speakerurltext); ?>
                    <?php } ?>

                </div><!-- End of speaker title -->

            </div><!-- end of conference wrapper -->

            <?php endwhile; ?> 

            <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>

        </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

    </div><!-- End of content wrapper -->

<?php get_footer(); ?>