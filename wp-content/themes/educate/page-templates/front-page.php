<?php
/*
 * Template Name: Home Page
 */
get_header();
?>
<?php global $educate_options; ?>

<section>
    <div id="educatecarousel" class="carousel slide educate-slider" data-interval="3000" data-ride="carousel">
        <!-- Carousel indicators -->

        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            $educate_slider_count = 0;
            for ($educate_loop = 0; $educate_loop < 5; $educate_loop++):
                ?>
                <?php
                if (!empty($educate_options['slider-img-' . $educate_loop])) {
                    $educate_slider_count++;
                    if ($educate_slider_count == 1)
                        $educate_class = ' active';
                    else
                        $educate_class = '';
                    $educate_image = getimagesize($educate_options['slider-img-' . $educate_loop]);
                    ?>
                    <div class="item<?php echo $educate_class; ?>">
                        <span class="mask-overlay"></span><img src="<?php echo esc_url($educate_options['slider-img-' . $educate_loop]); ?>"  width="<?php echo $educate_image[0]; ?>" height="<?php echo $educate_image[1]; ?>" alt="<?php echo $educate_loop; ?>">
                        <?php if ((!empty($educate_options['slider-title-' . $educate_loop])) || (!empty($educate_options['slidercontent-' . $educate_loop]))): ?>
                            <div class="carousel-caption">
                                <h3>
                                    <?php if ((!empty($educate_options['slider-title-' . $educate_loop]))) echo esc_attr($educate_options['slider-title-' . $educate_loop]); ?>
                                </h3>
                                <p>
                                    <?php if ((!empty($educate_options['slidercontent-' . $educate_loop]))) echo esc_attr($educate_options['slidercontent-' . $educate_loop]); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            <?php endfor; ?>
        </div>
        <!-- Carousel nav -->
        <?php if ($educate_slider_count > 1) { ?>
            <a class="carousel-control left" href="#educatecarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left carousel-control-left"></span> </a> <a class="carousel-control right" href="#educatecarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right carousel-control-right"></span> </a>
        <?php } ?>
    </div>
    <?php if (!empty($educate_options['about-title']) || !empty($educate_options['about-sub-title']) || !empty($educate_options['about-detail'])) { ?>
        <!--about-us start-->
        <div class="educate-container container">
            <div class="about-us">
                <div class="title-box">
                    <?php
                    if (!empty($educate_options['about-title'])) {
                        echo '<h2 class="content-heading"> <span> ' . esc_attr($educate_options['about-title']) . ' </span> </h2>';
                    }
                    if (!empty($educate_options['about-sub-title'])) {
                        echo '<p class="sub-content">' . esc_attr($educate_options['about-sub-title']) . '</p>';
                    }
                    if (!empty($educate_options['about-detail'])) {
                        echo '<p class="aboutus-detail">' . esc_attr($educate_options['about-detail']) . '</p>';
                    };
                    ?>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="educate-container container">
        <div class="about-us-content" id="about-slider">
            <?php
            for ($educate_j = 1; $educate_j <= 5; $educate_j++):
                if (!empty($educate_options['about-icon-' . $educate_j]) && !empty($educate_options['abouttitle-' . $educate_j]) && !empty($educate_options['aboutdesc-' . $educate_j])):
                    echo '<div class="owl-item">'
                    . '<div class="about-us-box item">'
                    . '<div class="col-md-9 col-xs-8 about-info">'
                    . '<h2>' . esc_attr($educate_options['abouttitle-' . $educate_j]) . '</h2>'
                    . '<p>' . esc_attr($educate_options['aboutdesc-' . $educate_j]) . '</p>'
                    . '</div>'
                    . '<div class="col-md-3 col-xs-4 about-info-icon">'
                    . '<span class="fa ' . esc_attr($educate_options['about-icon-' . $educate_j]) . '"></span>'
                    . '</div></div></div>';
                endif;
            endfor;
            ?>
        </div>
    </div>
    <!--about-us end-->

    <?php
    if (!empty($educate_options['blog-title']) || !empty($educate_options['blog-sub-title'])) {
        ?>
        <!--blog start-->
        <div class="educate-container container">
            <div class="home-page-blog">
                <?php
                if (!empty($educate_options['blog-title']) || !empty($educate_options['blog-sub-title'])) {
                    echo '<div class="title-box">';

                    if (!empty($educate_options['blog-title'])) {
                        echo '<h2 class="content-heading"> <span> ' . esc_attr($educate_options['blog-title']) . ' </span> </h2>';
                    }
                    if (!empty($educate_options['blog-sub-title'])) {
                        echo'<p class="sub-content">' . esc_attr($educate_options['blog-sub-title']) . '</p>';
                    }
                    echo '</div>';
                }
                ?>
                <div class="blog-slider-details" id="blog-slider">
                    <?php
                    if (!empty($educate_options['blog-category'])) :

                        if (get_option('posts_per_page'))
                            $educate_per_page = get_option('posts_per_page');
                        else
                            $educate_per_page = 5;

                        $educate_args = array(
                            'posts_per_page' => $educate_per_page,
                            'cat' => $educate_options['blog-category'],
                            'meta_query' => array(array('key' => '_thumbnail_id',
                                    'compare' => 'EXISTS')
                                )
                            );

                        $educate_loop = new WP_Query($educate_args);
                        if ($educate_loop->have_posts()) : while ($educate_loop->have_posts()) : $educate_loop->the_post();
                                $educate_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'educate-blog-image');
                                ?>
                                <?php if ($educate_image[0] != "") { ?>
                                    <div class="view-box item">
                                        <div class="view-effect"> <a href="<?php echo esc_url(get_permalink()); ?>"><img alt="<?php esc_attr(the_title()); ?>" src="<?php echo esc_url($educate_image[0]); ?>" width="<?php echo $educate_image[1]; ?>" height="<?php echo $educate_image[2]; ?>" class="img-responsive"></a>
                                            <div class="view-hover-effect"> <a href="<?php echo esc_url(get_permalink()); ?>" class="hover-icon"> <i class="fa fa-arrows"></i> </a> </div>
                                        </div>
                                        <div class="blog-discription row">
                                            <div class="col-md-3 col-sm-3 blog-date">
                                                <?php educate_entry_meta_date(); ?>
                                            </div>
                                            <div class="col-md-9 col-sm-9 blog-meta"> <a href="<?php echo esc_url(get_permalink()); ?>" class="blog-title">
                                                    <?php the_title(); ?>
                                                </a>
                                                <?php educate_entry_meta(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }

                            endwhile;
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!--blog end-->

    <?php }
    ?>
    <?php
    if (!empty($educate_options['mission-title']) || !empty($educate_options['mission-sub-title']) || !empty($educate_options['mission-detail'])) {
        ?>
        <!--our-mission start-->
        <div class="our-mission-bg"> <span class="site-color-mask"></span>
            <div class="mountain-container container">
                <div class="our-mission-wrap">
                    <div class="title-box">
                        <?php
                        if (!empty($educate_options['mission-title'])) {
                            ?>
                            <h2 class="content-heading"> <span> <?php echo esc_attr($educate_options['mission-title']); ?></span> </h2>
                            <?php
                        }

                        if (!empty($educate_options['mission-sub-title'])) {
                            ?>
                            <p class="sub-content"><?php echo esc_attr($educate_options['mission-sub-title']); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (!empty($educate_options['mission-detail'])) {
                        ?>
                        <div class="slide-box"><p><?php echo esc_attr($educate_options['mission-detail']); ?></p>
                        </div>
                        <?php
                    }
                    if (!empty($educate_options['mission-link-name']) || !empty($educate_options['mission-link'])) {
                        ?>
                        <div class="join-us-btn"> <a href="<?php echo esc_url($educate_options['mission-link']); ?>" class="site-btn"><?php echo esc_attr($educate_options['mission-link-name']); ?></a> </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <!--our-mission end-->
    <?php }
    ?>

</section>
<?php get_footer(); ?>
