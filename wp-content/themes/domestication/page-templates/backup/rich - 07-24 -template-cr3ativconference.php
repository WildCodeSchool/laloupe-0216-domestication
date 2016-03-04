<?php  
/* 
Template Name: Cr3ativ-Conference
*/  

?>

<?php get_header(); ?>

<h1><?php _e("[:fr]Programme[:en]Schedule[:]"); ?></h1>

<!-- Start of content wrapper -->
<div id="cr3ativconference_contentwrapper">

	<!-- Start of content wrapper -->
	<div class="cr3ativconference_content_wrapper">

<?php
	add_filter('posts_orderby','cr3ativoderby2');
	$wp_query = new WP_Query(array(
		'post_type' => 'cr3ativconference',
		'posts_per_page' => 99999999,
		'order' => 'ASC',
		'meta_key' => 'cr3ativconf_date',

		'meta_query' => array(
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
	while (have_posts()) : the_post();

		$cr3ativconfmeetingdate = get_post_meta($post->ID, 'cr3ativconf_date', $single = true); 
		$confstarttime = get_post_meta($post->ID, 'cr3ativconf_starttime', $single = true);
		$confendtime = get_post_meta($post->ID, 'cr3ativconf_endtime', $single = true); 
		$conflocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
		$cr3ativ_highlight = get_post_meta($post->ID, 'cr3ativ_highlight', $single = true);
		$dateformat = get_option('date_format'); 
		$sessiondate = date($dateformat, $cr3ativconfmeetingdate); 
?>
	<div id="plugin_session">	
	<div class='panel panel-default'>
		<div class='panel-heading panel-heading-1 mnhn'>
			<div class='col-xs-3'>
				<?php echo date($dateformat, $cr3ativconfmeetingdate); ?>
			</div>
			<div class='col-xs-9'>
				<?php if ($conflocation != ('')){ ?>
				<?php echo stripslashes($conflocation); ?> 
				<?php } ?>
			</div>
			<div class='clearfix'></div>
		</div>

		<div class='panel-footer mnhn-white'>
			<div class='col-xs-3'>
	      <?php if ($confstarttime != ('')){  echo ($confstarttime); }
	        if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>
	    	</div>
			<div class='col-xs-9'>
				<h2>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'squarecode' ); ?>&nbsp; <?php the_title_attribute(); ?>" class="program-title-link"><?php the_title(); ?></a> 
				</h2>
				<?php the_excerpt (); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class='panel-heading panel-heading-2 mnhn'> 
			<div class='col-xs-12'>
				<a class="conference-more program-title-link" href="<?php the_permalink (); ?>" ><span class='glyphicon glyphicon-plus'></span>Plus&nbsp;d'infos...</a>
			</div>
			<div class='clearfix'></div>
		</div>
	</div>
	</div>

	<?php endwhile; ?>

	</div><!-- End of content wrapper -->

	<!-- Clear Fix --><div class="cr3ativconference_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>
