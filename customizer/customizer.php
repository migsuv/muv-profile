<?php
/**
 * Theme customizer with real-time update
 *
 * Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

/**
 * Begin the customizer functions.
 *
 * @param array $wp_customize Returns classes and sanitized inputs.
 */
function profile_lite_theme_customizer( $wp_customize ) {

	include( get_template_directory() . '/customizer/customizer-sanitize.php' );

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @since Profile Lite 1.0
	 * @see profile_lite_customize_register()
	 *
	 * @return void
	 */
	function profile_lite_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @since Profile Lite 1.0
	 * @see profile_lite_customize_register()
	 *
	 * @return void
	 */
	function profile_lite_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

	/**
	 * Return an array of all categories.
	 */
	function profile_lite_blog_categories() {
		$cats    = array();
		$cats[0] = esc_html__( 'All Categories', 'profile-lite' );
		foreach ( get_categories() as $categories => $category ) {
			$cats[ $category->term_id ] = $category->name;
		}

		return $cats;
	}

	// Set site name and description text to be previewed in real-time.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'profile_lite_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'profile_lite_customize_partial_blogdescription',
		) );
	}

	/*
	-------------------------------------------------------------------------------------------------------
		Site Title Section
	-------------------------------------------------------------------------------------------------------
	*/

		// Custom Display Site Title Option.
		$wp_customize->add_setting( 'profile_lite_site_title', array(
			'default'           => '1',
			'sanitize_callback' => 'profile_lite_sanitize_checkbox',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_lite_site_title', array(
			'label'    => esc_html__( 'Display Site Title', 'profile-lite' ),
			'type'     => 'checkbox',
			'section'  => 'title_tagline',
			'settings' => 'profile_lite_site_title',
			'priority' => 12,
		) ) );

		// Custom Display Tagline Option.
		$wp_customize->add_setting( 'profile_lite_site_tagline', array(
			'default'           => '1',
			'sanitize_callback' => 'profile_lite_sanitize_checkbox',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_lite_site_tagline', array(
			'label'    => esc_html__( 'Display Site Tagline', 'profile-lite' ),
			'type'     => 'checkbox',
			'section'  => 'title_tagline',
			'settings' => 'profile_lite_site_tagline',
			'priority' => 15,
		) ) );

		/*
		-------------------------------------------------------------------------------------------------------
			Theme Options Panel
		-------------------------------------------------------------------------------------------------------
		*/

		$wp_customize->add_panel( 'profile_lite_theme_options', array(
			'priority'       => 1,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Options', 'profile-lite' ),
			'description'    => esc_html__( 'This panel allows you to customize specific areas of the theme.', 'profile-lite' ),
		) );

		/*
		-------------------------------------------------------------------------------------------------------
			Page Templates Section
		-------------------------------------------------------------------------------------------------------
		*/

		$wp_customize->add_section( 'profile_lite_templates_section', array(
			'title'    => esc_html__( 'Blog Options', 'profile-lite' ),
			'priority' => 100,
			'panel'    => 'profile_lite_theme_options',
		) );

		// Blog Categories.
		$wp_customize->add_setting( 'profile_lite_blog_category', array(
			'default'           => '0',
			'sanitize_callback' => 'sanitize_key',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_lite_blog_category', array(
			'settings' => 'profile_lite_blog_category',
			'label'    => __( 'Select Blog Categories', 'profile-lite' ),
			'section'  => 'profile_lite_templates_section',
			'type'     => 'select',
			'choices'  => profile_lite_blog_categories(),
			'priority' => 20,
		) ) );

		/*
		-------------------------------------------------------------------------------------------------------
			Layout Options
		-------------------------------------------------------------------------------------------------------
		*/

		$wp_customize->add_section( 'profile_lite_layout_section', array(
			'title'       => esc_html__( 'Layout', 'profile-lite' ),
			'description' => esc_html__( 'Toggle the display and layout of various elements throughout the theme.', 'profile-lite' ),
			'priority'    => 140,
			'panel'       => 'profile_lite_theme_options',
		) );

		// Display Post Image Title Overlay.
		$wp_customize->add_setting( 'display_img_title_post', array(
			'default'           => '1',
			'sanitize_callback' => 'profile_lite_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_img_title_post', array(
			'label'    => esc_html__( 'Overlay Post Title On Featured Image?', 'profile-lite' ),
			'section'  => 'profile_lite_layout_section',
			'settings' => 'display_img_title_post',
			'type'     => 'checkbox',
			'priority' => 80,
		) ) );

		// Display Page Image Title Overlay.
		$wp_customize->add_setting( 'display_img_title_page', array(
			'default'           => '1',
			'sanitize_callback' => 'profile_lite_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_img_title_page', array(
			'label'    => esc_html__( 'Overlay Page Title On Featured Image?', 'profile-lite' ),
			'section'  => 'profile_lite_layout_section',
			'settings' => 'display_img_title_page',
			'type'     => 'checkbox',
			'priority' => 100,
		) ) );

}
add_action( 'customize_register', 'profile_lite_theme_customizer' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 */
function profile_lite_customize_preview_js() {
	wp_enqueue_script( 'profile-customizer', get_template_directory_uri() . '/customizer/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'profile_lite_customize_preview_js' );

/**
 * Logo Resizer
 */
require get_template_directory() . '/customizer/logo-resizer.php';
