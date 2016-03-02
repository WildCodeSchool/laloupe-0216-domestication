<?php get_header(); ?>

    <!-- Start of content wrapper -->
    <div id="cr3ativconference_contentwrapper">

        <!-- Start of content wrapper -->
        <div class="cr3ativconference_content_wrapper"> 

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php
        $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true); 
        $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true);  
        $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true); 
        ?>

            <!-- Start of speaker info -->
            <div class="cr3ativconference_speaker_info">

                <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>

                <h2 class="speaker_title"><?php the_title (); ?></h2>

                <!-- Start of speaker singletitle -->
                <div class="cr3ativconference_speaker_company_title">

                    <?php if ($speakerurl != ('')){ ?>
                    <a href="<?php echo ($speakerurl); ?>" target="_blank"><?php echo stripslashes($speakerurltext); ?></a>
                    <?php } ?>

                </div><!-- End of speaker singletitle -->

                <!-- Start of speaker singletitle -->
                <div class="cr3ativconference_speaker_singletitle">

                    <?php if ($speakertitle != ('')){ ?>
                    <?php echo stripslashes($speakertitle); ?>
                    <?php } ?>

                </div><!-- End of speaker singletitle -->

                <!-- Start of social icons -->
                <div class="cr3ativconference_social_icons">

                    <?php $repeatable_fields = get_post_meta($post->ID, 'speakerrepeatable', true);
                    if ($repeatable_fields != ('')){ 
                    foreach ($repeatable_fields as $v) { ?>

                    <a href="<?php echo $v['speakerrepeatable_socailurl']; ?>"><?php echo wp_get_attachment_image($v['speakerrepeatable_socailimage'], ''); ?></a>
                    <?php } } ?>

                </div><!-- End of social icons -->

            </div><!-- End of speaker info -->

        <!-- Start of speaker bio -->
        <div class="cr3ativconference_speaker_bio">
            <?php the_content('        '); ?> 

        <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

        <?php endwhile; ?> 

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3at_conf' ); ?></p> 

        <?php endif; ?>

        </div><!-- End of speaker bio -->
            
        <div class="cr3ativconference_clearbig"></div>

        <?php $this_post = $post->ID; ?>
        <h2 class="session"><?php _e( 'Sessions', 'cr3at_conf' ); ?></h2>

        <?php
        add_filter('posts_orderby','cr3ativoderby');
        $wp_query = new WP_Query(array(
        'post_type' => 'cr3ativconference',
        'posts_per_page' => 99999999,
        'meta_key' => 'cr3ativconfmeetingdate',
        
        'meta_query' => array(
            array(
        'key' => 'cr3ativconfmeetingdate',
        ),
            array(
        'key' => 'cr3ativ_confstarttime',
        ),
        array(
        'key' => 'cr3ativ_confspeaker',
        'value' => $this_post ,
        'compare' => 'LIKE',
        ),

        ),
        )); 
        remove_filter('posts_orderby','cr3ativoderby');
          
        $sessiondate = '';
        while (have_posts()) : the_post();

        ?>

        <?php $cr3ativconfmeetingdate = get_post_meta($post->ID, 'cr3ativconfmeetingdate', $single = true); 
        $confstarttime = get_post_meta($post->ID, 'cr3ativ_confstarttime', $single = true);
        $confendtime = get_post_meta($post->ID, 'cr3ativ_confendtime', $single = true); 
        $confdisplaystarttime = get_post_meta($post->ID, 'cr3ativ_confdisplaystarttime', $single = true);
        $confdisplayendtime = get_post_meta($post->ID, 'cr3ativ_confdisplayendtime', $single = true);
        $conflocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
        $cr3ativ_highlight = get_post_meta($post->ID, 'cr3ativ_highlight', $single = true); ?>
            
        <?php if ($cr3ativ_highlight != ('')){ ?>
        
        <!-- Start of highlight -->
        <div class="highlight">

        <?php $dateformat = get_option('date_format'); ?>
            
            <?php if ($sessiondate != (date_i18n($dateformat, $cr3ativconfmeetingdate))){ ?>
                
            <h5 class="date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h5>
            
            <h6 class="session"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3at_conf' ); ?>&nbsp;<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
            
            <?php } else { ?>
            
            <h6 class="session"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3at_conf' ); ?>&nbsp;<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
            
            <?php } ?>
            
            <?php $sessiondate = date_i18n($dateformat, $cr3ativconfmeetingdate); ?>
            
            <!-- Start of single conference location -->
            <div class="single-conference-location">
                <?php if ($conflocation != ('')){ ?>
                <?php echo stripslashes($conflocation); ?> 
                <?php } ?>
                
            </div><!-- End of single conference location -->
            
            <!-- Start of single conference time -->
            <div class="single-conference-time">
                <?php if ($confdisplaystarttime != ('')) { ?>

                <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                <?php } else { ?> 

                <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                <?php } ?>
            </div><!-- End of single conference time -->
            
        </div><!-- End of highlight -->
        
        <?php } else { ?>
            
        <?php $dateformat = get_option('date_format'); ?>
            
            <?php if ($sessiondate != (date_i18n($dateformat, $cr3ativconfmeetingdate))){ ?>
                
            <h5 class="date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h5>
            
            <h6 class="session"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3at_conf' ); ?>&nbsp;<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
            
            <?php } else { ?>
            
            <h6 class="session"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3at_conf' ); ?>&nbsp;<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
            
            <?php } ?>
            
            <?php $sessiondate = date_i18n($dateformat, $cr3ativconfmeetingdate); ?>
            
            <!-- Start of single conference location -->
            <div class="single-conference-location">
                <?php if ($conflocation != ('')){ ?>
                <?php echo stripslashes($conflocation); ?> 
                <?php } ?>
                
            </div><!-- End of single conference location -->
            
            <!-- Start of single conference time -->
            <div class="single-conference-time">
                <?php if ($confdisplaystarttime != ('')) { ?>

                <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                <?php } else { ?> 

                <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                <?php } ?>
            </div><!-- End of single conference time -->
            
        <?php } ?>
            
        <?php endwhile; ?>

        <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

        </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

    </div><!-- End of content wrapper -->

<?php get_footer(); ?>