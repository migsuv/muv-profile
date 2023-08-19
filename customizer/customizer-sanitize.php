<?php
/**
 * Theme customizer sanitization
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

/**
 * Sanitize Pages.
 *
 * @param array $input Sanitizes user input.
 * @return array
 */
function profile_lite_sanitize_pages( $input ) {
	$pages = get_all_page_ids();

	if ( in_array( $input, $pages, true ) ) {
			return $input;
	} else {
		return '';
	}
}

/**
 * Sanitize Alignment.
 *
 * @param array $input Sanitizes user input.
 * @return array
 */
function profile_lite_sanitize_align( $input ) {
	$valid = array(
		'left'   => esc_html__( 'Left Align', 'profile-lite' ),
		'center' => esc_html__( 'Center Align', 'profile-lite' ),
		'right'  => esc_html__( 'Right Align', 'profile-lite' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitize Checkboxes.
 *
 * @param array $input Sanitizes user input.
 * @return array
 */
function profile_lite_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return 1;
	} else {
		return '';
	}
}
