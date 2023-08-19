<?php
/**
 * Register Google Font URLs
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

/**
 * Register font variables.
 */
function profile_lite_fonts_url() {
	$fonts_url = '';

	/*
	Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/

	$roboto           = _x( 'on', 'Roboto font: on or off', 'profile-lite' );
	$roboto_condensed = _x( 'on', 'Roboto Condensed font: on or off', 'profile-lite' );
	$roboto_slab      = _x( 'on', 'Roboto Slab font: on or off', 'profile-lite' );
	$raleway          = _x( 'on', 'Raleway font: on or off', 'profile-lite' );

	if ( 'off' !== $raleway || 'off' !== $roboto || 'off' !== $roboto_condensed || 'off' !== $roboto_slab ) {

		$font_families = array();

		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:400,200,300,800,700,500,600,900,100';
		}

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:300,300i,400,400i,700,700i';
		}

		if ( 'off' !== $roboto_condensed ) {
			$font_families[] = 'Roboto Slab:300,400,700';
		}

		if ( 'off' !== $roboto_slab ) {
			$font_families[] = 'Roboto Slab:300,400,700';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Google Fonts on Front End
 *
 * @since Profile Lite 1.0
 */
function profile_lite_scripts_styles() {
	wp_enqueue_style( 'profile-lite-fonts', profile_lite_fonts_url(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'profile_lite_scripts_styles' );

/**
 * Add Google Scripts for use with the editor
 *
 * @since Profile Lite 1.0
 */
function profile_lite_editor_styles() {
	add_editor_style( array( 'style.css', profile_lite_fonts_url() ) );
}
add_action( 'after_setup_theme', 'profile_lite_editor_styles' );

if ( ! function_exists( 'profile_lite_block_editor_styles' ) ) {

	/**
	 * Add Google Scripts for use with the block editor
	 *
	 * @since Organic Profile 1.0
	 */
	function profile_lite_block_editor_styles() {
		wp_enqueue_style( 'profile-lite-fonts', profile_lite_fonts_url(), array(), '1.0' );
	}
}
add_action( 'enqueue_block_editor_assets', 'profile_lite_block_editor_styles' );
