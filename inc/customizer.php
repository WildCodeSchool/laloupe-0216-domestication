<?php
/**
 * domestication Theme Customizer
 *
 * @package domestication
 */

function domestication_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->get_section( 'header_image' )->panel = 'domestication_header_panel';
    $wp_customize->get_section( 'header_image' )->priority = '13';
    $wp_customize->get_section( 'title_tagline' )->priority = '9';
    $wp_customize->get_section( 'title_tagline' )->title = __('Site title/tagline/logo', 'domestication');

    //Divider
    class domestication_Divider extends WP_Customize_Control {
         public function render_content() {
            echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
         }
    }
    //Titles
    class domestication_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }    
    //Titles
    class domestication_Theme_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }


    //___General___//
    $wp_customize->add_section(
        'domestication_general',
        array(
            'title'         => __('General', 'domestication'),
            'priority'      => 8,
        )
    );
    //Top padding
    $wp_customize->add_setting(
        'wrapper_top_padding',
        array(
            'default' => __('83','domestication'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_top_padding',
        array(
            'label'         => __( 'Page wrapper - top padding', 'domestication' ),
            'section'       => 'domestication_general',
            'type'          => 'number',
            'description'   => __('Top padding for the page wrapper (the space between the header and the page title)', 'domestication'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
                'style' => 'margin-bottom: 15px; padding: 15px;',
            ),            
        )
    );
    //Bottom padding
    $wp_customize->add_setting(
        'wrapper_bottom_padding',
        array(
            'default' => __('100','domestication'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_bottom_padding',
        array(
            'label'         => __( 'Page wrapper - bottom padding', 'domestication' ),
            'section'       => 'domestication_general',
            'type'          => 'number',
            'description'   => __('Bottom padding for the page wrapper (the space between the page content and the footer)', 'domestication'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
                'style' => 'margin-bottom: 15px; padding: 15px;',
            ),            
        )
    );
    //___Header area___//
    $wp_customize->add_panel( 'domestication_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'domestication'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'domestication_header_type',
        array(
            'title'         => __('Header type', 'domestication'),
            'priority'      => 10,
            'panel'         => 'domestication_header_panel', 
            'description'   => __('You can select your header type from here. After that, continue below to the next two tabs (Header Slider and Header Image) and configure them.', 'domestication'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'slider',
            'sanitize_callback' => 'domestication_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'domestication'),
            'section'     => 'domestication_header_type',
            'description' => __('Select the header type for your front page', 'domestication'),
            'choices' => array(
                'slider'    => __('Full screen slider', 'domestication'),
                'image'     => __('Image', 'domestication'),
                'nothing'   => __('No header (only menu)', 'domestication')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'domestication_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'domestication'),
            'section'     => 'domestication_header_type',
            'description' => __('Select the header type for all pages except the front page', 'domestication'),
            'choices' => array(
                'slider'    => __('Full screen slider', 'domestication'),
                'image'     => __('Image', 'domestication'),
                'nothing'   => __('No header (only menu)', 'domestication')
            ),
        )
    );    
    //___Slider___//
    $wp_customize->add_section(
        'domestication_slider',
        array(
            'title'         => __('Header Slider', 'domestication'),
            'description'   => __('You can add up to 5 images in the slider. Make sure you select where to display your slider from the Header Type section found above. You can also add a Call to action button (scroll down to find the options)', 'domestication'),
            'priority'      => 11,
            'panel'         => 'domestication_header_panel',
        )
    );
    //Speed
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default' => __('4000','domestication'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'slider_speed',
        array(
            'label' => __( 'Slider speed', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'number',
            'description'   => __('Slider speed in miliseconds. Use 0 to disable [default: 4000]', 'domestication'),       
            'priority' => 7
        )
    );
    $wp_customize->add_setting(
        'textslider_speed',
        array(
            'default' => __('4000','domestication'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'textslider_speed',
        array(
            'label' => __( 'Text slider speed', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'number',
            'description'   => __('Text slider speed in miliseconds [default: 4000]', 'domestication'),       
            'priority' => 8
        )
    );
    $wp_customize->add_setting(
        'textslider_slide',
        array(
            'sanitize_callback' => 'domestication_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'textslider_slide',
        array(
            'type'      => 'checkbox',
            'label'     => __('Stop the text slider?', 'domestication'),
            'section'   => 'domestication_slider',
            'priority'  => 9,
        )
    );
    //Image 1
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 's1', array(
        'label' => __('First slide', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_1',
        array(
            'default' => get_template_directory_uri() . '/images/1.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_1',
            array(
               'label'          => __( 'Upload your first image for the slider', 'domestication' ),
               'type'           => 'image',
               'section'        => 'domestication_slider',
               'settings'       => 'slider_image_1',
               'priority'       => 11,
            )
        )
    );
    //Title titre site
    $wp_customize->add_setting(
        'slider_title_1',
        array(
            'default' => __('Titre','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_1',
        array(
            'label' => __( 'Titre', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Subtitle soustitre colloque
    $wp_customize->add_setting(
        'slider_subtitle_1',
        array(
            'default' => __('soustitre','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_1',
        array(
            'label' => __( 'soustitre', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 13
        )
    );
    // Subtitle_12 mention colloque
    $wp_customize->add_setting(
        'slider_subtitle_12',
        array(
            'default' => __('colloque','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
    )
    );
    $wp_customize->add_control(
        'slider_subtitle_12',
        array(
            'label' => __( 'colloque', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 13
        )
    );

   // Subtitle_13 lieu1
    $wp_customize->add_setting(
        'slider_subtitle_13',
        array(
            'default' => __('lieu1','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
    )
    );
    $wp_customize->add_control(
        'slider_subtitle_13',
        array(
            'label' => __( 'lieu1', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 13
        )
    );

       // Subtitle_14 lieu2
    $wp_customize->add_setting(
        'slider_subtitle_14',
        array(
            'default' => __('lieu2','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
    )
    );
    $wp_customize->add_control(
        'slider_subtitle_14',
        array(
            'label' => __( 'lieu2', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 13
        )
    );


       // Subtitle_15 dates
    $wp_customize->add_setting(
        'slider_subtitle_15',
        array(
            'default' => __('dates','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
    )
    );
    $wp_customize->add_control(
        'slider_subtitle_15',
        array(
            'label' => __( 'dates', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 13
        )
    );  


    //Image 2
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 's2', array(
        'label' => __('Second slide', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 14
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_2',
        array(
            'default' => get_template_directory_uri() . '/images/2.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_2',
            array(
               'label'          => __( 'Upload your second image for the slider', 'domestication' ),
               'type'           => 'image',
               'section'        => 'domestication_slider',
               'settings'       => 'slider_image_2',
               'priority'       => 15,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_2',
        array(
            'default' => __('Ready to begin your journey?','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_2',
        array(
            'label' => __( 'Title for the second slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 16
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_2',
        array(
            'default' => __('Click the button below','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_2',
        array(
            'label' => __( 'Subtitle for the second slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 17
        )
    );    
    //Image 3
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 's3', array(
        'label' => __('Third slide', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 18
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_3',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_3',
            array(
               'label'          => __( 'Upload your third image for the slider', 'domestication' ),
               'type'           => 'image',
               'section'        => 'domestication_slider',
               'settings'       => 'slider_image_3',
               'priority'       => 19,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_3',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_3',
        array(
            'label' => __( 'Title for the third slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 20
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_3',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_3',
        array(
            'label' => __( 'Subtitle for the third slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 21
        )
    );            
    //Image 4
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 's4', array(
        'label' => __('Fourth slide', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 22
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_4',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_4',
            array(
               'label'          => __( 'Upload your fourth image for the slider', 'domestication' ),
               'type'           => 'image',
               'section'        => 'domestication_slider',
               'settings'       => 'slider_image_4',
               'priority'       => 23,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_4',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_4',
        array(
            'label' => __( 'Title for the fourth slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 24
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_4',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_4',
        array(
            'label' => __( 'Subtitle for the fourth slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 25
        )
    );    
    //Image 5
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 's5', array(
        'label' => __('Fifth slide', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 26
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_5',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_5',
            array(
               'label'          => __( 'Upload your fifth image for the slider', 'domestication' ),
               'type'           => 'image',
               'section'        => 'domestication_slider',
               'settings'       => 'slider_image_5',
               'priority'       => 27,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_5',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_5',
        array(
            'label' => __( 'Title for the fifth slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 28
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_5',
        array(
            'default' => '',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_5',
        array(
            'label' => __( 'Subtitle for the fifth slide', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 29
        )
    );
    //Header button
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'hbutton', array(
        'label' => __('Call to action button', 'domestication'),
        'section' => 'domestication_slider',
        'settings' => 'domestication_options[info]',
        'priority' => 30
        ) )
    );     
    $wp_customize->add_setting(
        'slider_button_url',
        array(
            'default' => '#primary',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'slider_button_url',
        array(
            'label' => __( 'URL for your call to action button', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 31
        )
    );
    $wp_customize->add_setting(
        'slider_button_text',
        array(
            'default' => __('Click to begin','domestication'),
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_button_text',
        array(
            'label' => __( 'Text for your call to action button', 'domestication' ),
            'section' => 'domestication_slider',
            'type' => 'text',
            'priority' => 32
        )
    );         
    //___Menu style___//
    $wp_customize->add_section(
        'domestication_menu_style',
        array(
            'title'         => __('Menu style', 'domestication'),
            'priority'      => 15,
            'panel'         => 'domestication_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'domestication_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'domestication'),
            'section' => 'domestication_menu_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'domestication'),
                'static'   => __('Static', 'domestication'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'domestication_sanitize_menu_style',
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'domestication'),
            'section'   => 'domestication_menu_style',
            'choices'   => array(
                'inline'     => __('Inline', 'domestication'),
                'centered'   => __('Centered (menu and site logo)', 'domestication'),
            ),
        )
    );
    //Header image size
    $wp_customize->add_setting(
        'header_bg_size',
        array(
            'default'           => 'cover',
            'sanitize_callback' => 'domestication_sanitize_bg_size',
        )
    );
    $wp_customize->add_control(
        'header_bg_size',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Header background size', 'domestication'),
            'section' => 'header_image',
            'choices' => array(
                'cover'     => __('Cover', 'domestication'),
                'contain'   => __('Contain', 'domestication'),
            ),
        )
    );
    //Header height
    $wp_customize->add_setting(
        'header_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '300',
        )       
    );
    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'header_image',
        'label'       => __('Header height [default: 300px]', 'domestication'),
        'input_attrs' => array(
            'min'   => 250,
            'max'   => 600,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Disable overlay
    $wp_customize->add_setting(
        'hide_overlay',
        array(
            'sanitize_callback' => 'domestication_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_overlay',
        array(
            'type'      => 'checkbox',
            'label'     => __('Disable the overlay?', 'domestication'),
            'section'   => 'header_image',
            'priority'  => 12,
        )
    );    
    //Logo Upload
    $wp_customize->add_setting(
        'site_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'domestication' ),
               'type'           => 'image',
               'section'        => 'title_tagline',
               'priority'       => 12,
            )
        )
    );

    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'domestication'),
            'priority' => 13,
        )
    );  
    // Blog layout
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'domestication'),
        'section' => 'blog_options',
        'settings' => 'domestication_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'domestication_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'domestication'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'classic'           => __( 'Classic', 'domestication' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'domestication' ),
                'masonry-layout'    => __( 'Masonry (grid style)', 'domestication' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'domestication_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'domestication'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'content', array(
        'label' => __('Content/excerpt', 'domestication'),
        'section' => 'blog_options',
        'settings' => 'domestication_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content posts
    $wp_customize->add_setting(
      'full_content_home',
      array(
        'sanitize_callback' => 'domestication_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on the home page.', 'domestication'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'sanitize_callback' => 'domestication_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on all archives.', 'domestication'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '55',
        )       
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'domestication'),
        'description' => __('Choose your excerpt length. Default: 55 words', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ),
    ) );
    //Meta
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'domestication'),
        'section' => 'blog_options',
        'settings' => 'domestication_options[info]',
        'priority' => 17
        ) )
    ); 
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'domestication_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on index, archives?', 'domestication'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'domestication_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on singles?', 'domestication'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    //Featured images
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'domestication'),
        'section' => 'blog_options',
        'settings' => 'domestication_options[info]',
        'priority' => 21
        ) )
    );     
    //Index images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'sanitize_callback' => 'domestication_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on index, archives etc.', 'domestication'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'sanitize_callback' => 'domestication_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on single posts', 'domestication'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );




    //___Footer___//
    $wp_customize->add_section(
        'domestication_footer',
        array(
            'title'         => __('Footer', 'domestication'),
            'priority'      => 18,
        )
    );
    //Front page
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'domestication_sanitize_fw',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'domestication'),
            'section'     => 'domestication_footer',
            'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'domestication'),
            'choices' => array(
                '1'     => __('One', 'domestication'),
                '2'     => __('Two', 'domestication'),
                '3'     => __('Three', 'domestication'),
                '4'     => __('Four', 'domestication')
            ),
        )
    );



    //___Fonts___//
    $wp_customize->add_section(
        'domestication_fonts',
        array(
            'title' => __('Fonts', 'domestication'),
            'priority' => 15,
            'description' => __('Google Fonts can be found here: google.com/fonts. See the documentation if you need help in selecting Google Fonts: athemes.com/documentation/domestication', 'domestication'),
        )
    );
    //Body fonts title
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'domestication'),
        'section' => 'domestication_fonts',
        'settings' => 'domestication_options[info]',
        'priority' => 10
        ) )
    );    
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Source+Sans+Pro:400,400italic,600',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'domestication' ),
            'section' => 'domestication_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Source Sans Pro\', sans-serif',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'domestication' ),
            'section' => 'domestication_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts title
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'domestication'),
        'section' => 'domestication_fonts',
        'settings' => 'domestication_options[info]',
        'priority' => 13
        ) )
    );      
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Raleway:400,500,600',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'domestication' ),
            'section' => 'domestication_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Raleway\', sans-serif',
            'sanitize_callback' => 'domestication_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Font family', 'domestication' ),
            'section' => 'domestication_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );
    //Font sizes title
    $wp_customize->add_setting('domestication_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'domestication'),
        'section' => 'domestication_fonts',
        'settings' => 'domestication_options[info]',
        'priority' => 16
        ) )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'domestication_fonts',
        'label'       => __('Site title', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'domestication_fonts',
        'label'       => __('Site description', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );  
    // Nav menu
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'domestication_fonts',
        'label'       => __('Menu items', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );           
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '52',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'domestication_fonts',
        'label'       => __('H1 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '42',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'domestication_fonts',
        'label'       => __('H2 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'domestication_fonts',
        'label'       => __('H3 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '25',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'domestication_fonts',
        'label'       => __('H4 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'domestication_fonts',
        'label'       => __('H5 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'domestication_fonts',
        'label'       => __('H6 font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'domestication_fonts',
        'label'       => __('Body font size', 'domestication'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );

    //___Colors___//
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#d65050',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'domestication'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 11
            )
        )
    );
    //Menu bg
    $wp_customize->add_setting(
        'menu_bg_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg_color',
            array(
                'label' => __('Menu background', 'domestication'),
                'section' => 'colors',
                'priority' => 12
            )
        )
    );     
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'domestication'),
                'section' => 'colors',
                'settings' => 'site_title_color',
                'priority' => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'domestication'),
                'section' => 'colors',
                'priority' => 14
            )
        )
    );
    //Top level menu items
    $wp_customize->add_setting(
        'top_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'top_items_color',
            array(
                'label' => __('Top level menu items', 'domestication'),
                'section' => 'colors',
                'priority' => 15
            )
        )
    );
    //Sub menu items color
    $wp_customize->add_setting(
        'submenu_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_items_color',
            array(
                'label' => __('Sub-menu items', 'domestication'),
                'section' => 'colors',
                'priority' => 16
            )
        )
    );
    //Sub menu background
    $wp_customize->add_setting(
        'submenu_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_background',
            array(
                'label' => __('Sub-menu background', 'domestication'),
                'section' => 'colors',
                'priority' => 17
            )
        )
    );
    //Slider text
    $wp_customize->add_setting(
        'slider_text',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'slider_text',
            array(
                'label' => __('Header slider text', 'domestication'),
                'section' => 'colors',
                'priority' => 18
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'domestication'),
                'section' => 'colors',
                'priority' => 19
            )
        )
    );    
    //Sidebar backgound
    $wp_customize->add_setting(
        'sidebar_background',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_background',
            array(
                'label' => __('Sidebar background', 'domestication'),
                'section' => 'colors',
                'priority' => 20
            )
        )
    );
    //Sidebar color
    $wp_customize->add_setting(
        'sidebar_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_color',
            array(
                'label' => __('Sidebar color', 'domestication'),
                'section' => 'colors',
                'priority' => 21
            )
        )
    );
    //Footer widget area
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => '#252525',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_background',
            array(
                'label' => __('Footer widget area background', 'domestication'),
                'section' => 'colors',
                'priority' => 22
            )
        )
    );
    //Footer widget color
    $wp_customize->add_setting(
        'footer_widgets_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_color',
            array(
                'label' => __('Footer widget area color', 'domestication'),
                'section' => 'colors',
                'priority' => 23
            )
        )
    );
    //Footer background
    $wp_customize->add_setting(
        'footer_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background',
            array(
                'label' => __('Footer background', 'domestication'),
                'section' => 'colors',
                'priority' => 24
            )
        )
    );
    //Footer color
    $wp_customize->add_setting(
        'footer_color',
        array(
            'default'           => '#666666',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            array(
                'label' => __('Footer color', 'domestication'),
                'section' => 'colors',
                'priority' => 25
            )
        )
    );
    //Rows overlay
    $wp_customize->add_setting(
        'rows_overlay',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rows_overlay',
            array(
                'label' => __('Rows overlay', 'domestication'),
                'section' => 'colors',
                'priority' => 26
            )
        )
    );





    //___Theme info___//
    $wp_customize->add_section(
        'domestication_themeinfo',
        array(
            'title' => __('Theme info', 'domestication'),
            'priority' => 99,
            'description' => '<p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('1. Documentation for domestication can be found ', 'domestication') . '<a target="_blank" href="http://athemes.com/documentation/domestication/">here</a></p><p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('2. A full theme demo can be found ', 'domestication') . '<a target="_blank" href="http://demo.athemes.com/domestication/">here</a></p>' . __('3. If you enjoy domestication and want to see what domestication Pro offers, please go ', 'domestication') . '<a target="_blank" href="http://athemes.com/theme/domestication-pro/">here</a></p>',         
        )
    );
    $wp_customize->add_setting('domestication_theme_docs', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new domestication_Theme_Info( $wp_customize, 'documentation', array(
        'section' => 'domestication_themeinfo',
        'settings' => 'domestication_theme_docs',
        'priority' => 10
        ) )
    );  






}
add_action( 'customize_register', 'domestication_customize_register' );

/**
 * Sanitize
 */
//Header type
function domestication_sanitize_layout( $input ) {
    $valid = array(
        'slider'    => __('Full screen slider', 'domestication'),
        'image'     => __('Image', 'domestication'),
        'nothing'   => __('Nothing (only menu)', 'domestication')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Text
function domestication_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Background size
function domestication_sanitize_bg_size( $input ) {
    $valid = array(
        'cover'     => __('Cover', 'domestication'),
        'contain'   => __('Contain', 'domestication'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Footer widget areas
function domestication_sanitize_fw( $input ) {
    $valid = array(
        '1'     => __('One', 'domestication'),
        '2'     => __('Two', 'domestication'),
        '3'     => __('Three', 'domestication'),
        '4'     => __('Four', 'domestication')
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Sticky menu
function domestication_sanitize_sticky( $input ) {
    $valid = array(
        'sticky'     => __('Sticky', 'domestication'),
        'static'   => __('Static', 'domestication'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Blog Layout
function domestication_sanitize_blog( $input ) {
    $valid = array(
        'classic'    => __( 'Classic', 'domestication' ),
        'fullwidth'  => __( 'Full width (no sidebar)', 'domestication' ),
        'masonry-layout'    => __( 'Masonry (grid style)', 'domestication' )

    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Menu style
function domestication_sanitize_menu_style( $input ) {
    $valid = array(
        'inline'     => __('Inline', 'domestication'),
        'centered'   => __('Centered (menu and site logo)', 'domestication'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Checkboxes
function domestication_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function domestication_customize_preview_js() {
    wp_enqueue_script( 'domestication_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'domestication_customize_preview_js' );
