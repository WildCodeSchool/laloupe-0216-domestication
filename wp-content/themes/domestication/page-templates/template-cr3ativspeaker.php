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
            
            while ($wp_query->have_posts()) : 
                $wp_query->the_post();
    
                $lastname = get_post_meta($post->ID, 'speakerlastname', $single = true);
                $firstname = get_post_meta($post->ID, 'speakerfirstname', $single = true);   
                $speakeradditionnal = get_post_meta($post->ID, 'speakeradditionnal', $single = true);   
            
                // speakerul : contrairement à ce que le nom indique, il peut y en avoir plusieurs séparés par un ";"
                $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true);   
     
                $speakerurl_array = array();
                if ($speakerurl != ('')){
                   $speakerurl_array = explode(";", $speakerurl);
                }
            
            ?>
                        
            <!-- Start of conference wrapper -->
            <div class="cr3ativconference_speaker_wrapper"> 

                 <!-- Start of speaker name -->
                <div class="cr3ativconference_speaker_name">
                    <?php print(strtoupper($lastname)." $firstname"); ?>

                </div><!-- End of speaker name -->

                <!-- Start of speaker additional info -->
                <div class="cr3ativconference_speaker_company">
                    <?php if ($speakeradditionnal != ('')){ ?>
                    <?php echo stripslashes($speakeradditionnal); ?>
                    <?php } ?>

                </div><!-- End of speaker firm -->

                <!-- Start of speaker Web sites -->
                <div class="cr3ativconference_speaker_company">
                <?php 
                    foreach ($speakerurl_array as $url) {
                        $url = stripslashes($url);
                        print("<a href='$url'>$url</a><br />");
                    }
                ?>

                </div><!-- End of speaker firm -->

            </div><!-- end of conference wrapper -->

            <?php endwhile; ?> 

            <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>

        </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

    </div><!-- End of content wrapper -->

<?php get_footer(); ?>

