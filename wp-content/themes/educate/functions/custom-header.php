<?php

function educate_custom_header_setup() {
	$educate_args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '733a23',
		

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'educate_header_style',
		'admin-head-callback'    => 'educate_admin_header_style',
		'admin-preview-callback' => 'educate_admin_header_image',
	);

	add_theme_support( 'custom-header', $educate_args );

	
}
add_action( 'after_setup_theme', 'educate_custom_header_setup', 11 );


add_action( 'admin_print_styles-appearance_page_custom-header', 'educate_custom_header_fonts' );


function educate_header_style() {
	$educate_header_image = get_header_image();
	$educate_text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $educate_header_image ) && $educate_text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="educate-header-css">
	<?php
		if ( ! empty( $educate_header_image ) ) :
	?>
		.site-header {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
			background-size: 1600px auto;
		}
		@media (max-width: 767px) {
			.site-header {
				background-size: 768px auto;
			}
		}
		@media (max-width: 359px) {
			.site-header {
				background-size: 360px auto;
			}
		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
			if ( empty( $educate_header_image ) ) :
	?>
		.site-header .home-link {
			min-height: 0;
		}
	<?php
			endif;

		// If the user has set a custom color for the text, use that.
		elseif ( $educate_text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title,
		.site-description {
			color: #<?php echo esc_attr( $educate_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}


function educate_admin_header_style() {
	$educate_header_image = get_header_image();
?>
	<style type="text/css" id="educate-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $educate_header_image ) ) {
			echo 'background: url(' . esc_url( $educate_header_image ) . ') no-repeat scroll top; background-size: 1600px auto;';
		} ?>
		padding: 0 20px;
	}
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $educate_header_image ) || display_header_text() ) {
			echo 'min-height: 230px;';
		} ?>
		width: 100%;
	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>
	#headimg h1 {
		font: bold 60px/1 Bitter, Georgia, serif;
		margin: 0;
		padding: 58px 0 10px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		text-decoration: underline;
	}
	#headimg h2 {
		font: 200 italic 24px "Source Sans Pro", Helvetica, sans-serif;
		margin: 0;
		text-shadow: none;
	}
	
	</style>
<?php
}


function educate_admin_header_image() {
	?>
	<div id="headimg" style="background: url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto;">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="home-link">
			<h1 class="displaying-header-text"><a id="name"<?php echo $educate_style; ?> onclick="return false;" href="#" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc" class="displaying-header-text"<?php echo $educate_style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }

