<?php

function educate_options_init() {
    register_setting('educate_option', 'educate_theme_options', 'educate_option_validate');
}

add_action('admin_init', 'educate_options_init');

function educate_option_validate($input) {
    $input['logo'] = educate_image_validation(esc_url_raw($input['logo']));
    $input['favicon'] = educate_image_validation(esc_url_raw($input['favicon']));
    $input['blogtitle'] = sanitize_text_field($input['blogtitle']);


    $input['footer-logo'] = educate_image_validation(esc_url_raw($input['footer-logo']));
    $input['footertext'] = sanitize_text_field($input['footertext']);


    for ($educate_l = 1; $educate_l <= 5; $educate_l++):
        $input['slider-img-' . $educate_l] = educate_image_validation(esc_url_raw($input['slider-img-' . $educate_l]));
        $input['slider-title-' . $educate_l] = sanitize_text_field($input['slider-title-' . $educate_l]);
        $input['slidercontent-' . $educate_l] = sanitize_text_field($input['slidercontent-' . $educate_l]);
    endfor;

    $input['about-title'] = sanitize_text_field($input['about-title']);
    $input['about-sub-title'] = sanitize_text_field($input['about-sub-title']);
    $input['about-detail'] = sanitize_text_field($input['about-detail']);


    for ($educate_l = 1; $educate_l <= 5; $educate_l++):
        $input['about-icon-' . $educate_l] = sanitize_text_field($input['about-icon-' . $educate_l]);
        $input['abouttitle-' . $educate_l] = sanitize_text_field($input['abouttitle-' . $educate_l]);
        $input['aboutdesc-' . $educate_l] = sanitize_text_field($input['aboutdesc-' . $educate_l]);
    endfor;

    $input['blog-title'] = sanitize_text_field($input['blog-title']);
    $input['blog-sub-title'] = sanitize_text_field($input['blog-sub-title']);
    $input['blog-category'] = sanitize_text_field($input['blog-category']);

    $input['mission-title'] = sanitize_text_field($input['mission-title']);
    $input['mission-sub-title'] = sanitize_text_field($input['mission-sub-title']);
    $input['mission-detail'] = sanitize_text_field($input['mission-detail']);

    $input['mission-link'] = esc_url_raw($input['mission-link']);
    $input['mission-link-name'] = sanitize_text_field($input['mission-link-name']);

    $input['fburl'] = esc_url_raw($input['fburl']);
    $input['twitter'] = esc_url_raw($input['twitter']);
    $input['youtube'] = esc_url_raw($input['youtube']);
    $input['rss'] = esc_url_raw($input['rss']);

    return $input;
}

function educate_image_validation($educate_imge_url) {
    $educate_filetype = wp_check_filetype($educate_imge_url);
    $educate_supported_image = array('gif', 'jpg', 'jpeg', 'png', 'ico');
    if (in_array($educate_filetype['ext'], $educate_supported_image)) {
        return $educate_imge_url;
    } else {
        return '';
    }
}

function educate_framework_load_scripts($educate_hook) {
    if ('appearance_page_educate_framework' != $educate_hook)
        return;
    wp_enqueue_media();
    wp_enqueue_style('educate_framework', get_template_directory_uri() . '/theme-options/css/educate_framework.css', false, '1.0.0');
    wp_enqueue_script('options-custom', get_template_directory_uri() . '/theme-options/js/educate-custom.js', array('jquery'));
    wp_enqueue_script('media-uploader', get_template_directory_uri() . '/theme-options/js/media-uploader.js', array('jquery'));
}

add_action('admin_enqueue_scripts', 'educate_framework_load_scripts');

function educate_framework_menu_settings() {
    $educate_menu = array(
        'page_title' => __('Theme Options', 'educate_framework'),
        'menu_title' => __('Theme Options', 'educate_framework'),
        'capability' => 'edit_theme_options',
        'menu_slug' => 'educate_framework',
        'callback' => 'educate_framework_page'
    );
    return apply_filters('educate_framework_menu', $educate_menu);
}

add_action('admin_menu', 'educate_options_add_page');

function educate_options_add_page() {
    $educate_menu = educate_framework_menu_settings();
    add_theme_page($educate_menu['page_title'], $educate_menu['menu_title'], $educate_menu['capability'], $educate_menu['menu_slug'], $educate_menu['callback']);
}

function educate_framework_page() {
    global $select_options;
    if (!isset($_REQUEST['settings-updated']))
        $_REQUEST['settings-updated'] = false;
    ?>

    <div class="themeoption-themes">
        <form method="post" action="options.php" id="form-option" class="theme_option_ft">
            <div class="themeoption-header">
                <div class="logo">
                    <?php
                    $educate_image = get_template_directory_uri() . '/theme-options/images/logo.png';
                    echo "<a href='http://fruitthemes.com' target='_blank'><img src='" . esc_url($educate_image) . "' alt='" . __('FruitThemes', 'educate') . "'  /></a>";
                    ?>
                </div>
                <div class="header-right">
                    <div class='btn-save'>
                        <input type='submit' class='button-primary' value='<?php _e('Save Options', 'educate'); ?>' />
                    </div>
                </div>
            </div>
            <div class="themeoption-details">
                <div class="themeoption-options">
                    <div class="right-box">
                        <div class="nav-tab-wrapper">
                            <div class="option-title">
                                <h2>
                                    <?php _e('Theme Options', 'educate'); ?>
                                </h2>
                            </div>
                            <ul>
                                <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="<?php _e('Basic Settings', 'educate'); ?>" href="#options-group-1">
                                        <?php _e('Basic Settings', 'educate'); ?>
                                    </a></li>
                                <li><a id="options-group-4-tab" class="nav-tab footersettings-tab" title="<?php _e('Footer Settings', 'educate'); ?>" href="#options-group-4">
                                        <?php _e('Footer Settings', 'educate'); ?>
                                    </a></li>
                                <li><a id="options-group-2-tab" class="nav-tab homepagesettings-tab" title="<?php _e('Home Page Settings', 'educate'); ?>" href="#options-group-2">
                                        <?php _e('Home Page Settings', 'educate'); ?>
                                    </a></li>
                                <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="<?php _e('Social Settings', 'educate'); ?>" href="#options-group-3">
                                        <?php _e('Social Settings', 'educate'); ?>
                                    </a></li>
                                <li><a id="options-group-5-tab" class="nav-tab profeatures-tab" title="<?php _e('PRO Theme Features','educate');?>" href="#options-group-5"><?php _e('PRO Theme Features','educate');?></a></li>     
                            </ul>
                        </div>
                    </div>
                    <div class="right-box-bg"></div>
                    <div class="postbox left-box">
                        <!--======================== F I N A L - - T H E M E - - O P T I O N ===================-->
                        <?php
                        settings_fields('educate_option');
                        global $educate_options;
                        ?>
                        <!-------------- Basic Settings group ----------------->
                        <div id="options-group-1" class="group theme-option-inner-tabs">
                            <div class="section theme-tabs theme-logo"> <a class="heading theme-option-inner-tab active" href="javascript:void(0)">
                                    <?php _e('Site Logo (Recommended Size : 200px * 50px)', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group active">
                                    <div class="explain">
                                        <?php _e('Size of Logo should be exactly 200x50px for best results.', 'educate'); ?>
                                    </div>
                                    <div class="ft-control">
                                        <input id="logo-img" class="upload" type="text" name="educate_theme_options[logo]"
                                               value="<?php
                                               if (!empty($educate_options['logo'])) {
                                                   echo esc_attr($educate_options['logo']);
                                               }
                                               ?>" placeholder="<?php _e('No file chosen', 'educate'); ?>" />
                                        <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload', 'educate'); ?>" />
                                        <div class="screenshot" id="logo-image">
                                            <?php if (!empty($educate_options['logo'])) { ?>
                                                <img src="<?php echo esc_url($educate_options['logo']) ?>" alt="<?php _e('logo', 'educate'); ?>" /> <a class='remove-image'> </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section theme-tabs theme-favicon"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('Favicon (Recommended Size : 32px * 32px)', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="explain">
                                        <?php _e('Size of favicon should be exactly 32x32px for best results.', 'educate'); ?>
                                    </div>
                                    <div class="ft-control">
                                        <input id="favicon-img" class="upload" type="text" name="educate_theme_options[favicon]"
                                               value="<?php
                                               if (!empty($educate_options['favicon'])) {
                                                   echo esc_attr($educate_options['favicon']);
                                               }
                                               ?>" placeholder="<?php _e('No file chosen', 'educate'); ?>" />
                                        <input id="upload_image_button1" class="upload-button button" type="button" value="<?php _e('Upload', 'educate'); ?>" />
                                        <div class="screenshot" id="favicon-image">
                                            <?php if (!empty($educate_options['favicon'])) { ?>
                                                <img src="<?php echo esc_url($educate_options['favicon']) ?>" alt="<?php _e('favicon', 'educate'); ?>" /> <a class='remove-image'> </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="section-blogtitle" class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('Blog Title', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <input type="text" id="blogtitle" class="of-input" name="educate_theme_options[blogtitle]" maxlength="30" size="32"  value="<?php
                                        if (!empty($educate_options['blogtitle'])) {
                                            echo esc_attr($educate_options['blogtitle']);
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-------------- Footer Settings group ----------------->
                        <div id="options-group-4" class="group theme-option-inner-tabs">
                            <div class="theme-tabs theme-hide-check">
                                <div style="display: block;">
                                    <div class="ft-control">
                                        <input type="checkbox" id="educate-remove-footer-logo" name="educate_theme_options[remove-footer-logo]" <?php if (!empty($educate_options['remove-footer-logo'])) { ?> checked="checked" <?php } ?> value="yes">
                                        <label class="remove-slider-class" for="educate-remove-footer-logo">
                                            <?php _e('Check this if you want to hide the footer logo.', 'educate') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="section theme-tabs theme-logo"> <a class="heading theme-option-inner-tab active" href="javascript:void(0)">
                                    <?php _e('Footer Logo (Recommended Size : 200px * 50px)', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="explain">
                                        <?php _e('Footer of Logo should be exactly 200x50px for best results.', 'educate'); ?>
                                    </div>
                                    <div class="ft-control">
                                        <input id="logo-img" class="upload" type="text" name="educate_theme_options[footer-logo]"
                                               value="<?php
                                               if (!empty($educate_options['footer-logo'])) {
                                                   echo esc_attr($educate_options['footer-logo']);
                                               }
                                               ?>" placeholder="<?php _e('No file chosen', 'educate'); ?>" />
                                        <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload', 'educate'); ?>" />
                                        <div class="screenshot" id="logo-image">
                                            <?php if (!empty($educate_options['footer-logo'])) { ?>
                                                <img src="<?php echo esc_url($educate_options['footer-logo']) ?>" alt="<?php _e('logo', 'educate'); ?>" /> <a class='remove-image'> </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-tabs theme-fonts">
                                <div style="display: block;">
                                    <div class="ft-control">
                                        <input type="checkbox" id="educate-remove-footer-socialicon" name="educate_theme_options[remove-footer-socialicon]" <?php if (!empty($educate_options['remove-footer-socialicon'])) { ?> checked="checked" <?php } ?> value="yes">
                                        <label class="remove-slider-class" for="educate-remove-footer-socialicon">
                                            <?php _e('Check this if you want to hide the footer social icon.', 'educate') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="section-footertext" class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('Copyright Text', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <div class="explain">
                                            <?php _e('Some text regarding copyright of your site, you would like to display in the footer.', 'educate'); ?>
                                        </div>
                                        <input type="text" id="footertext" class="of-input" maxlength="100" name="educate_theme_options[footertext]" size="32"  value="<?php
                                        if (!empty($educate_options['footertext'])) {
                                            echo esc_attr($educate_options['footertext']);
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-------------- Home Page Settings group ----------------->
                        <div id="options-group-2" class="group theme-option-inner-tabs">
                            <h3>
                                <?php _e('Banner Slider', 'educate'); ?>
                            </h3>
                            <?php for ($educate_i = 1; $educate_i <= 5; $educate_i++): ?>
                                <div class="section theme-tabs theme-slider-img"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                        <?php _e('Slider', 'educate'); ?>
                                        <?php echo $educate_i; ?>
                                        <?php _e(' (Recommended Size : 1350px * 450px)', 'educate'); ?>
                                    </a>
                                    <div class="theme-option-inner-tab-group">
                                        <div class="ft-control">
                                            <input id="slider-img-<?php echo $educate_i; ?>" class="upload" type="text" name="educate_theme_options[slider-img-<?php echo $educate_i; ?>]"
                                                   value="<?php
                                                   if (!empty($educate_options['slider-img-' . $educate_i])) {
                                                       echo esc_url($educate_options['slider-img-' . $educate_i]);
                                                   }
                                                   ?>" placeholder="<?php _e('No file chosen', 'educate'); ?>" />
                                            <input id="1upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload', 'educate'); ?>" />
                                            <div class="screenshot" id="slider-img-<?php echo $educate_i; ?>">
                                                <?php
                                                if (!empty($educate_options['slider-img-' . $educate_i])) {
                                                    echo "<img src='" . esc_url($educate_options['slider-img-' . $educate_i]) . "' /><a class='remove-image'></a>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ft-control">
                                            <input type="text" maxlength="40" placeholder="<?php _e('Slide Title', 'educate'); ?>" class="of-input" name="educate_theme_options[slider-title-<?php echo $educate_i; ?>]" size="50"  value="<?php
                                            if (!empty($educate_options['slider-title-' . $educate_i])) {
                                                echo esc_attr($educate_options['slider-title-' . $educate_i]);
                                            }
                                            ?>">
                                        </div>
                                        <div class="ft-control">
                                            <input type="text" maxlength="130" placeholder="<?php _e('Slide Content', 'educate'); ?>" class="of-input" name="educate_theme_options[slidercontent-<?php echo $educate_i; ?>]" size="70"  value="<?php
                                            if (!empty($educate_options['slidercontent-' . $educate_i])) {
                                                echo esc_attr($educate_options['slidercontent-' . $educate_i]);
                                            }
                                            ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <?php /** Our Services tab... * */ ?>
                            <h3>
                                <?php _e('About Us', 'educate'); ?>
                            </h3>
                            <div class="section theme-tabs theme-logo"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('About US Details', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <input id="about-title" class="of-input" maxlength="130" name="educate_theme_options[about-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['about-title'])) {
                                            echo esc_attr($educate_options['about-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <input id="about-sub-title" class="of-input" maxlength="130" name="educate_theme_options[about-sub-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['about-sub-title'])) {
                                            echo esc_attr($educate_options['about-sub-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Sub Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <textarea name="educate_theme_options[about-detail]" placeholder="<?php _e('Details', 'educate'); ?>"><?php
                                            if (!empty($educate_options['about-detail'])) {
                                                echo esc_attr($educate_options['about-detail']);
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <?php for ($educate_j = 1; $educate_j <= 5; $educate_j++): ?>
                                <div class="section theme-tabs theme-logo"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                        <?php _e('Tab', 'educate'); ?>
                                        <?php echo $educate_j; ?></a>
                                    <div class="theme-option-inner-tab-group">
                                        <div class="ft-control">
                                            <input id="about-icon-<?php echo $educate_j; ?>" class="of-input" maxlength="30" name="educate_theme_options[about-icon-<?php echo $educate_j; ?>]" type="text" size="46" value="<?php
                                            if (!empty($educate_options['about-icon-' . $educate_j])) {
                                                echo esc_attr($educate_options['about-icon-' . $educate_j]);
                                            }
                                            ?>"  placeholder="<?php _e('Section Icon', 'educate'); ?>" />
                                            <span>
                                                <?php _e('Font Awesome icon names', 'educate'); ?>
                                                <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">
                                                    <?php _e('[View all]', 'educate'); ?>
                                                </a></span> </div>
                                        <div class="ft-control">
                                            <input id="abouttitle-<?php echo $educate_j; ?>" class="of-input" maxlength="50" name="educate_theme_options[abouttitle-<?php echo $educate_j; ?>]" type="text" size="46" value="<?php
                                            if (!empty($educate_options['abouttitle-' . $educate_j])) {
                                                echo esc_attr($educate_options['abouttitle-' . $educate_j]);
                                            }
                                            ?>"  placeholder="<?php _e('Section Title', 'educate'); ?>" />
                                        </div>
                                        <div class="ft-control">
                                            <textarea name="educate_theme_options[aboutdesc-<?php echo $educate_j; ?>]" id="aboutdesc-<?php echo $educate_j; ?>" class="of-input" placeholder="<?php _e('Section Description', 'educate'); ?>" maxlength="150" rows="5" ><?php
                                                if (!empty($educate_options['aboutdesc-' . $educate_j])) {
                                                    echo esc_attr($educate_options['aboutdesc-' . $educate_j]);
                                                }
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <h3>
                                <?php _e('Blog', 'educate'); ?>
                            </h3>
                            <div class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('Blog Details', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <input id="blog-title" class="of-input" maxlength="130" name="educate_theme_options[blog-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['blog-title'])) {
                                            echo esc_attr($educate_options['blog-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <input id="blog-title" class="of-input" maxlength="130" name="educate_theme_options[blog-sub-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['blog-sub-title'])) {
                                            echo esc_attr($educate_options['blog-sub-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Sub Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <select name="educate_theme_options[blog-category]" id="category">
                                            <option value=""><?php echo esc_attr(__('Select Category', 'educate')); ?></option>
                                            <?php
                                            $educate_args = array(
                                                'post_status' => 'publish',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => '_thumbnail_id',
                                                        'compare' => 'EXISTS'
                                                    ),
                                                )
                                            );
                                            $educate_post = new WP_Query($educate_args);
                                            $educate_cat_id = array();
                                            while ($educate_post->have_posts()) {
                                                $educate_post->the_post();
                                                $educate_post_categories = wp_get_post_categories(get_the_id());
                                                $educate_cat_id[] = $educate_post_categories[0];
                                            }
                                            $educate_cat_id = array_unique($educate_cat_id);
                                            $educate_args = array(
                                                'orderby' => 'name',
                                                'parent' => 0,
                                                'include' => $educate_cat_id
                                            );
                                            $educate_categories = get_categories($educate_args);
                                            foreach ($educate_categories as $educate_category) {
                                                if ($educate_category->term_id == $educate_options['blog-category'])
                                                    $educate_selected = "selected=selected";
                                                else
                                                    $educate_selected = '';
                                                $educate_option = '<option value="' . $educate_category->term_id . '" ' . $educate_selected . '>';
                                                $educate_option .= $educate_category->cat_name;
                                                $educate_option .= '</option>';
                                                echo $educate_option;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h3>
                                <?php _e('Our Mission', 'educate'); ?>
                            </h3>
                            <div class="section theme-tabs"><a class="heading theme-option-inner-tab" href="javascript:void(0)">
                                    <?php _e('Our Mission', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <input class="of-input" maxlength="130" name="educate_theme_options[mission-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['mission-title'])) {
                                            echo esc_attr($educate_options['mission-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <input class="of-input" maxlength="130" name="educate_theme_options[mission-sub-title]" type="text" size="46" value="<?php
                                        if (!empty($educate_options['mission-sub-title'])) {
                                            echo esc_attr($educate_options['mission-sub-title']);
                                        }
                                        ?>"  placeholder="<?php _e('Sub Title', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <textarea name="educate_theme_options[mission-detail]" class="of-input" placeholder="<?php _e('Description', 'educate'); ?>" rows="5" ><?php
                                            if (!empty($educate_options['mission-detail'])) {
                                                echo esc_attr($educate_options['mission-detail']);
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                    <div class="ft-control">
                                        <input type="text" class="of-input" maxlength="130" name="educate_theme_options[mission-link-name]" size="46" value="<?php
                                            if (!empty($educate_options['mission-link-name'])) {
                                                echo esc_attr($educate_options['mission-link-name']);
                                            }
                                            ?>"  placeholder="<?php _e('Mission button name', 'educate'); ?>" />
                                    </div>
                                    <div class="ft-control">
                                        <input type="url" class="of-input" maxlength="130" name="educate_theme_options[mission-link]" size="46" value="<?php
                                    if (!empty($educate_options['mission-link'])) {
                                        echo esc_attr($educate_options['mission-link']);
                                    }
                                    ?>"  placeholder="<?php _e('Mission Link', 'educate'); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-------------- Social Settings group ----------------->
                        <div id="options-group-3" class="group theme-option-inner-tabs">
                            <div id="section-facebook" class="section theme-tabs"> <a class="heading theme-option-inner-tab active" href="javascript:void(0)">
    <?php _e('Facebook', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group active">
                                    <div class="ft-control">
                                        <div class="explain">
                                               <?php _e('Facebook profile or page URL ', 'educate'); ?>
                                            i.e. http://facebook.com/username/ </div>
                                        <input id="facebook" class="of-input" name="educate_theme_options[fburl]" size="30" maxlength="40" type="text" value="<?php
                                           if (!empty($educate_options['fburl'])) {
                                               echo esc_attr($educate_options['fburl']);
                                           }
                                           ?>" />
                                    </div>
                                </div>
                            </div>
                            <div id="section-twitter" class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
    <?php _e('Twitter', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <div class="explain">
                                               <?php _e('Twitter profile or page URL ', 'educate'); ?>
                                            i.e. http://www.twitter.com/username/</div>
                                        <input id="twitter" class="of-input" name="educate_theme_options[twitter]" type="text" size="30" maxlength="40" value="<?php
                                           if (!empty($educate_options['twitter'])) {
                                               echo esc_attr($educate_options['twitter']);
                                           }
                                           ?>" />
                                    </div>
                                </div>
                            </div>
                            <div id="section-youtube" class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
    <?php _e('Youtube', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <div class="explain">
                                               <?php _e('youtube profile or page URL ', 'educate'); ?>
                                            i.e. https://youtube.com/username/</div>
                                        <input id="youtube" class="of-input" name="educate_theme_options[youtube]" type="text" size="30" maxlength="40" value="<?php
                                           if (!empty($educate_options['youtube'])) {
                                               echo esc_attr($educate_options['youtube']);
                                           }
                                           ?>" />
                                    </div>
                                </div>
                            </div>
                            <div id="section-rss" class="section theme-tabs"> <a class="heading theme-option-inner-tab" href="javascript:void(0)">
    <?php _e('RSS', 'educate'); ?>
                                </a>
                                <div class="theme-option-inner-tab-group">
                                    <div class="ft-control">
                                        <div class="explain">
                                               <?php _e('RSS profile or page URL ', 'educate'); ?>
                                            i.e. https://www.rss.com/username/</div>
                                        <input id="rss" class="of-input" name="educate_theme_options[rss]" type="text" size="30" maxlength="40" value="<?php
                                           if (!empty($educate_options['rss'])) {
                                               echo esc_attr($educate_options['rss']);
                                           }
                                           ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <div id="options-group-5" class="group theme-option-inner-tabs educate-pro-image">  
							<div class="educate-pro-header">
							  <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/educate_logopro_features.png" class="educate-pro-logo" />
							  <a href="http://fruitthemes.com/wordpress-themes/educate" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/educate-buy-now.png" class="educate-pro-buynow" /></a>
							  </div>
							<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/educate_pro_features.png" />
						  </div> 
		
                        
                        <!--======================== F I N A L - - T H E M E - - O P T I O N S ===================-->
                    </div>
                </div>
            </div>
            <div class="themeoption-footer">
                <ul>
                    <li class="btn-save">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'educate'); ?>" />
                    </li>
                </ul>
            </div>
        </form>
    </div>
<?php } ?>
