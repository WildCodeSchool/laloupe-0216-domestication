<?php
/**
 * The Header template file
 */
$educate_options = get_option('educate_theme_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
                <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
                <![endif]-->
        <?php if (!empty($educate_options['favicon'])) { ?>
            <link rel="shortcut icon" href="<?php echo esc_url($educate_options['favicon']); ?>">
        <?php } ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="main-header">
            <div class="scroll-header">
                <div class="educate-container container">
                    <div class="row">
                        <div class="col-md-3 logo-small col-sm-12">
                            <?php if (!empty($educate_options['logo'])) { 
                              list($educate_width,$educate_height)= getimagesize($educate_options['logo']);
?>
                                <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="<?php _e('logo', 'educate') ?>" src="<?php echo esc_url($educate_options['logo']); ?>" width="<?php echo $educate_width;?>" height="<?php echo $educate_height;?>" ></a>
                            <?php } else { ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                    <h2 class="site-title">
                                        <?php _e(bloginfo('name'),'educate'); ?>
                                    </h2>
                                    <span class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="col-md-9 col-sm-12 center-content">
                            <?php
                            if (!empty($educate_options['fburl']) || !empty($educate_options['twitter']) || !empty($educate_options['youtube']) || !empty($educate_options['rss'])) {
                                $educate_header_class = ' col-md-10 col-sm-9';
                            } else {
                                $educate_header_class = ' col-md-12 col-sm-12';
                            }
                            ?>
                            <div class="scroll-menu-bar<?php echo $educate_header_class; ?>">
                                <?php
                                if (has_nav_menu('primary')) {
                                    ?>
                                    <div class="navbar-header res-nav-header toggle-respon">
                                        <button type="button" class="navbar-toggle menu_toggle" data-toggle="collapse" data-target=".collapse"> <span class="sr-only"><?php _e('Toggle navigation','educate') ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                    </div>
                                    <?php
                                    $educate_defaults = array(
                                        'theme_location' => 'primary',
                                        'container' => 'nav',
                                        'container_class' => 'collapse navbar-collapse main-menu-ul no-padding',
                                        'container_id' => 'navbar-collapse',
                                        'menu_class' => '',
                                        'menu_id' => '',
                                        'submenu_class' => '',
                                        'echo' => true,
                                        'before' => '',
                                        'after' => '',
                                        'link_before' => '',
                                        'link_after' => '',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth' => 0,
                                    );

                                    wp_nav_menu($educate_defaults);
                                }
                                ?>
                            </div>
<?php if (!empty($educate_options['fburl']) || !empty($educate_options['twitter']) || !empty($educate_options['youtube']) || !empty($educate_options['rss'])) { ?>
                                <div class="col-md-2 col-sm-3 social-icon no-padding">
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
                        </div>
                    </div>
                </div>
            </div>
            <?php if (get_header_image()) { ?>
            <div class="custom-header-img">
                <a href="<?php echo esc_url(home_url('/')); ?>" >
                    <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php _e('customheader', 'educate') ?>">
                </a>
            </div>
        <?php } ?>

        </header>
