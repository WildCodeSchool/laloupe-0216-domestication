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

            <div class="cr3ativconference_clearbig"></div>

            <?php 
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
            ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

            
            <?php
            $lastname = get_post_meta($post->ID, 'speakerlastname', $single = true);
            $firstname = get_post_meta($post->ID, 'speakerfirstname', $single = true);   
            $firm = get_post_meta($post->ID, 'speakerfirm', $single = true);   
            $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true);   
            ?>
                        
            <!-- Start of conference wrapper -->
            <div class="cr3ativconference_speaker_wrapper"> 

                 <!-- Start of speaker name -->
                <div class="cr3ativconference_speaker_name">
                    <?php print(strtoupper($lastname)." $firstname"); ?>

                </div><!-- End of speaker name -->

                <!-- Start of speaker title -->
                <div class="cr3ativconference_speaker_title">
                    <?php if ($speakertitle != ('')){ ?>
                    <?php print(stripslashes($speakertitle)); ?>
                    <?php } ?>

                </div><!-- End of speaker title -->

                <!-- Start of speaker firm -->
                <div class="cr3ativconference_speaker_company">
                    <?php if ($firm != ('')){ ?>
                    <?php echo stripslashes($firm); ?>
                    <?php } ?>

                </div><!-- End of speaker firm -->

            </div><!-- end of conference wrapper -->

            <?php endwhile; ?> 

            <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>

        </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

    </div><!-- End of content wrapper -->

<?php get_footer(); ?>

