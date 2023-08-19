<?php
/**
 * This template is used to manage style options.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

/**
 * Changes styles upon user defined options.
 */
function profile_lite_custom_styles() {

	$header_image    = get_header_image();
	$display_title   = get_theme_mod( 'profile_lite_site_title', '1' );
	$display_tagline = get_theme_mod( 'profile_lite_site_tagline', '1' );
	?>

	<style>

	<?php if ( ! empty( $header_image ) ) { ?>
		#custom-header {
			background-image: url('<?php header_image(); ?>');
		}
	<?php } ?>


	#wrapper .site-logo,
	#wrapper #custom-header::after {
		background-color: #<?php echo esc_html( get_theme_mod( 'background_color' ) ); ?> ;
	}

	#wrapper .site-title {
		<?php
		if ( '1' != $display_title ) {
			echo 'position: absolute; text-indent: -9999px; margin: 0px; padding: 0px;';
		};
		?>
	}

	#wrapper .site-description {
		<?php
		if ( '1' != $display_tagline ) {
			echo 'position: absolute; left: -9999px; margin: 0px; padding: 0px;';
		};
		?>
	}

	</style>

	<?php
}
add_action( 'wp_head', 'profile_lite_custom_styles', 100 );
