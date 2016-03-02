<?php  
/* 
Template Name: Cr3ativ-Conference
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

        <?php
add_filter('posts_orderby','cr3ativoderby2');
$wp_query = new WP_Query(array(
        'post_type' => 'cr3ativconference',
        'posts_per_page' => 99999999,
        'order' => 'ASC',
        'meta_key' => 'cr3ativconfmeetingdate',
        
        'meta_query' => array(
            array(
        'key' => 'cr3ativconfmeetingdate',
        ),
            array(
        'key' => 'cr3ativ_confstarttime',
        ),
        ),
        )); 
remove_filter('posts_orderby','cr3ativoderby2');
          
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
                
            <h1 class="conference_date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h1>
            <?php 
            if ( has_post_thumbnail() ) {  ?>
            
            <!-- Start of session featured image -->
            <div class="session_featured_image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_post_thumbnail(''); ?></a>
            </div><!-- End of session featured image -->
            
            <?php } ?>
            <h2 class="meeting_date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3at_conf' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <?php } else { ?>
            <?php 
            if ( has_post_thumbnail() ) {  ?>
            
            <!-- Start of session featured image -->
            <div class="session_featured_image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_post_thumbnail(''); ?></a>
            </div><!-- End of session featured image -->    
            <?php } ?>
            
            <h2 class="meeting_date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <?php } ?>
            
            <?php $sessiondate = date_i18n($dateformat, $cr3ativconfmeetingdate); ?>
            
            <!-- Start of conference time -->
            <div class="conference-time">
                <?php if ($confdisplaystarttime != ('')) { ?>

                <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                <?php } else { ?> 

                <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                <?php } ?>
            </div><!-- End of conference time -->
            
            <!-- Start of conference location -->
            <div class="conference-location">
                <?php if ($conflocation != ('')){ ?>
                <?php echo stripslashes($conflocation); ?> 
                <?php } ?>
            </div><!-- End of conference location -->
            
            <!-- Start of speaker list -->
            <div class="speaker_list">
            <?php
	         $cr3ativ_confspeakers = get_post_meta($post->ID, 'cr3ativ_confspeaker', $single = true); 
	        ?>    
            <?php
	        if ( $cr3ativ_confspeakers ) { 
				
	        	foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) :
	        	
	        		$speaker = get_post($cr3ativ_confspeaker);
                    $speakerlink = get_permalink( $speaker->ID );
                    echo'<div class="speaker_list_wrapper">';
	        		echo get_the_post_thumbnail($speaker->ID).'<a href="'. $speakerlink .'">'. $speaker->post_title .'</a></div>'; 
				
				endforeach; 
				
			} ?>
            </div><!-- End of speaker list -->
        
            <!-- Start of session content -->
            <div class="session_content">
                <?php the_excerpt (); ?>
                
               <p> <a class="conference-more" href="<?php the_permalink (); ?>"><?php _e( 'Click for more information on', 'cr3at_conf' ); ?> '<?php the_title (); ?>'</a></p>
            </div><!-- End of session content -->
                        
        </div><!-- End of highlight -->
        
        <?php } else { ?>
        
        <?php $dateformat = get_option('date_format'); ?>
            
            <?php if ($sessiondate != (date($dateformat, $cr3ativconfmeetingdate))){ ?>
                
            <h1 class="conference_date"><?php echo date($dateformat, $cr3ativconfmeetingdate); ?></h1>
            <?php 
            if ( has_post_thumbnail() ) {  ?>
            
            <!-- Start of session featured image -->
            <div class="session_featured_image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_post_thumbnail(''); ?></a>
            </div><!-- End of session featured image -->
            
            <?php } ?>
            <h2 class="meeting_date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <?php } else { ?>
            <?php 
            if ( has_post_thumbnail() ) {  ?>
            
            <!-- Start of session featured image -->
            <div class="session_featured_image">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_post_thumbnail(''); ?></a>
            </div><!-- End of session featured image -->    
            <?php } ?>
            
            <h2 class="meeting_date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <?php } ?>
            
            <?php $sessiondate = date($dateformat, $cr3ativconfmeetingdate); ?>
            
            <!-- Start of conference time -->
            <div class="conference-time">
                <?php if ($confdisplaystarttime != ('')) { ?>

                <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                <?php } else { ?> 

                <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                <?php } ?>
            </div><!-- End of conference time -->
            
            <!-- Start of conference location -->
            <div class="conference-location">
                <?php if ($conflocation != ('')){ ?>
                <?php echo stripslashes($conflocation); ?> 
                <?php } ?>
            </div><!-- End of conference location -->
            
            <!-- Start of speaker list -->
            <div class="speaker_list">
            <?php
	         $cr3ativ_confspeakers = get_post_meta($post->ID, 'cr3ativ_confspeaker', $single = true); 
	        ?>    
            <?php
	        if ( $cr3ativ_confspeakers ) { 
				
	        	foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) :
	        	
	        		$speaker = get_post($cr3ativ_confspeaker);
                    $speakerlink = get_permalink( $speaker->ID );
                    echo'<div class="speaker_list_wrapper">';
	        		echo get_the_post_thumbnail($speaker->ID).'<a href="'. $speakerlink .'">'. $speaker->post_title .'</a></div>'; 
				
				endforeach; 
				
			} ?>
            </div><!-- End of speaker list -->
        
            <!-- Start of session content -->
            <div class="session_content">
                <?php the_excerpt (); ?>
                
               <p> <a class="conference-more" href="<?php the_permalink (); ?>"><?php _e( 'Click for more information on', 'cr3at_conf' ); ?> '<?php the_title (); ?>'</a></p>
            </div><!-- End of session content -->
            
        <?php } ?>
        
        <?php endwhile; ?>

    </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>