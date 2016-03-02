<?php global $educate_options; ?>
<!--==============================Footer=================================-->
<footer>
	<?php if(!empty($educate_options['remove-footer-logo']))
	{
		$educate_padding="footer-bg1";
	}
	else{
		$educate_padding=" ";
		}
		
		?>
    <div class="footer-bg <?php echo $educate_padding;?>">
		   <?php if(empty($educate_options['remove-footer-logo'])){
			   ?>
			  
			  
        <div class="educate-container container">
         
            <div class="footer-logo">
                <?php if (!empty($educate_options['footer-logo'])) { 
list($educate_width,$educate_height)=getimagesize($educate_options['footer-logo']);?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" src="<?php echo esc_url($educate_options['footer-logo']); ?>" width="<?php echo $educate_width;?>" height="<?php echo $educate_height;?>"></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                        <h2><?php bloginfo('name'); ?></h2>
                    </a>
                <?php } ?>
            </div>
         
        </div>   <?php }?>
        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) { ?>
            <div class="footer-widget-wrap footer-sidebar">
                <div class="educate-container container">
                    <div class="row">
                        <?php
                        if (is_active_sidebar('footer-1')) {
                            echo '<aside class="col-md-3 col-sm-6">';
                            dynamic_sidebar('footer-1');
                            echo '</aside>';
                        }
                        if (is_active_sidebar('footer-2')) {
                            echo '<aside class="col-md-3 col-sm-6">';
                            dynamic_sidebar('footer-2');
                            echo '</aside>';
                        }
                        if (is_active_sidebar('footer-3')) {
                            echo '<aside class="col-md-3 col-sm-6">';
                            dynamic_sidebar('footer-3');
                            echo '</aside>';
                        }
                        if (is_active_sidebar('footer-4')) {
                            echo '<aside class="col-md-3 col-sm-6">';
                            dynamic_sidebar('footer-4');
                            echo '</aside>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="educate-container container">
			<?php if(empty($educate_options['remove-footer-socialicon'])){?>
				
            <?php if (!empty($educate_options['fburl']) || !empty($educate_options['twitter']) || !empty($educate_options['youtube']) || !empty($educate_options['rss'])) { ?>
                <div class="footer-social-icon">
                    <ul>
                        <?php if (!empty($educate_options['fburl'])) { ?>
                            <li> <a href="<?php echo esc_url($educate_options['fburl']); ?>"> <span class="fa fa-facebook"></span> </a> </li>
                        <?php } ?>
                        <?php if (!empty($educate_options['twitter'])) { ?>
                            <li> <a href="<?php echo esc_url($educate_options['twitter']); ?>"> <span class="fa fa-twitter"></span> </a> </li>
                        <?php } ?>
                        <?php if (!empty($educate_options['youtube'])) { ?>
                            <li> <a href="<?php echo esc_url($educate_options['youtube']); ?>"> <span class="fa fa-youtube"></span> </a> </li>
                        <?php } ?>
                        <?php if (!empty($educate_options['rss'])) { ?>
                            <li> <a href="<?php echo esc_url($educate_options['rss']); ?>"> <span class="fa fa-rss"></span> </a> </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
           <?php }?>
            <div class="copyright">
                <p><?php echo esc_html($educate_options['footertext']); ?></p>
                <p><?php printf(__('Powered by %1$s and %2$s.', 'educate'), '<a href="https://wordpress.org/" target="_blank">WordPress</a>', '<a href="http://fruitthemes.com/wordpress-themes/educate" target="_blank">educate</a>'); ?></p>
            </div>
        </div>
 </div>
</footer>
<?php wp_footer(); ?>
</body></html>
