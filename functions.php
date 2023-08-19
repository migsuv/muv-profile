<?php
/**
 * This file includes the theme functions.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

/*
-------------------------------------------------------------------------------------------------------
	Theme Setup
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_setup' ) ) :

	/** Function profile_lite_setup */
	function profile_lite_setup() {
		/*
		* Enable support for translation.
		*/
		load_theme_textdomain( 'profile-lite', get_template_directory() . '/languages' );

		/*
		* Enable support for RSS feed links to head.
		*/
		add_theme_support( 'automatic-feed-links' );

		/*
		* Enable selective refresh for widgets.
		*/
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		* Enable support for post thumbnails.
		*/
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'profile-lite-featured-large', 2400, 1800, true ); // Large Featured Image.
		add_image_size( 'profile-lite-featured-medium', 1200, 1200, false ); // Medium Featured Image.

		/*
		* Enable support for site title tag.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for wide alignment class for Gutenberg blocks.
		*/
		add_theme_support( 'align-wide' );

		/*
		* Enable support for responsive embed blocks.
		*/
		add_theme_support( 'responsive-embeds' );

		/*
		* Enable support for block styles.
		*/
		add_theme_support( 'wp-block-styles' );

		/*
		* Enable support for HTML5 output.
		*/
		add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		* Enable support for custom logo.
		*/
		add_theme_support( 'custom-logo', array(
			'height'      => 300,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		/*
		* Enable support for custom menus.
		*/
		register_nav_menus( array(
			'main-menu'   => esc_html__( 'Main Menu', 'profile-lite' ),
			'social-menu' => esc_html__( 'Social Menu', 'profile-lite' ),
		));

		/*
		* Enable support for custom header.
		*/
		register_default_headers( array(
			'default' => array(
				'url'           => get_template_directory_uri() . '/images/default-header.jpg',
				'thumbnail_url' => get_template_directory_uri() . '/images/default-header.jpg',
				'description'   => esc_html__( 'Default Custom Header', 'profile-lite' ),
			),
		));
		$defaults = array(
			'video'         => true,
			'width'         => 2400,
			'height'        => 1600,
			'flex-height'   => true,
			'flex-width'    => true,
			'default-image' => get_template_directory_uri() . '/images/default-header.jpg',
			'header-text'   => false,
			'uploads'       => true,
		);
		add_theme_support( 'custom-header', $defaults );

		/*
		* Enable support for custom background.
		*/
		$defaults = array(
			'default-color' => 'f9f9f9',
		);
		add_theme_support( 'custom-background', $defaults );

	}
endif; // End function profile_lite_setup.
add_action( 'after_setup_theme', 'profile_lite_setup' );

/*
-------------------------------------------------------------------------------------------------------
	Register Scripts
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_enqueue_scripts' ) ) {

	/** Function profile_lite_enqueue_scripts */
	function profile_lite_enqueue_scripts() {

		// Enqueue Styles.
		wp_enqueue_style( 'profile-lite-style', get_stylesheet_uri(), '', '1.0' );
		wp_enqueue_style( 'profile-lite-style-conditionals', get_template_directory_uri() . '/css/style-conditionals.css', array( 'profile-lite-style' ), '1.0' );
		wp_enqueue_style( 'profile-lite-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'profile-lite-style' ), '1.0' );
		wp_enqueue_style( 'profile-lite-font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'profile-lite-style' ), '1.0' );

		// Resgister Scripts.
		wp_register_script( 'jquery-sidr', get_template_directory_uri() . '/js/jquery.sidr.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'jquery-brightness', get_template_directory_uri() . '/js/jquery.bgBrightness.js', array( 'jquery' ), '1.0', true );

		// Enqueue Scripts.
		wp_enqueue_script( 'profile-lite-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'jquery-sidr', 'jquery-fitvids', 'jquery-brightness' ), '1.0', true );

		// Load single scripts only on single pages.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'profile_lite_enqueue_scripts' );

/*
-------------------------------------------------------------------------------------------------------
	Gutenberg Editor Styles
-------------------------------------------------------------------------------------------------------
*/

/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function profile_lite_gutenberg_styles() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style(
		'profile-lite-gutenberg',
		get_theme_file_uri( '/css/gutenberg.css' ),
		false,
		'1.0',
		'all'
	);
	wp_enqueue_style(
		'profile-lite-font-awesome',
		get_template_directory_uri() . '/css/font-awesome.css',
		array( 'profile-lite-gutenberg' ),
		'1.0'
	);
}
add_action( 'enqueue_block_editor_assets', 'profile_lite_gutenberg_styles' );

/*
-------------------------------------------------------------------------------------------------------
	Admin Support and Upgrade Link
-------------------------------------------------------------------------------------------------------
*/

function profile_lite_support_link() {
	global $submenu;
	$support_link = esc_url( 'https://organicthemes.com/support/' );
	$submenu['themes.php'][] = array( __( 'Theme Support', 'profile-lite' ), 'manage_options', $support_link );
}
add_action( 'admin_menu', 'profile_lite_support_link' );

function profile_lite_upgrade_link() {
	global $submenu;
	$upgrade_link = esc_url( 'https://organicthemes.com/theme/profile-theme/?utm_source=lite_upgrade' );
	$submenu['themes.php'][] = array( __( 'Theme Upgrade', 'profile-lite' ), 'manage_options', $upgrade_link );
}
add_action( 'admin_menu', 'profile_lite_upgrade_link' );

/*
-------------------------------------------------------------------------------------------------------
	Admin Notice
-------------------------------------------------------------------------------------------------------
*/

/** Function profile_lite_admin_notice_discount */
function profile_lite_admin_notice_discount() {
	if ( ! PAnD::is_admin_notice_active( 'notice-profile-lite-discount-30' ) ) {
		return;
	}
	?>

	<div data-dismissible="notice-profile-lite-discount-30" class="notice updated is-dismissible">

		<p><?php printf( wp_kses_post( '🍍 Aloha! Mahalo for using Profile Lite. We would like to extend a <b>20&#37; discount</b> towards our <a href="%1$s" target="_blank">Blocks Bundle Plugin</a> or any <a href="%2$s" target="_blank">Organic Themes Membership</a>. Just enter the coupon code "LITEUP20" during checkout.', 'profile-lite' ), 'https://organicthemes.com/blocks/', 'https://organicthemes.com/pricing/' ); ?></p>
		<p><b><?php esc_html_e( '&mdash; David Morgan', 'profile-lite' ); ?></b><br/>
		<b><?php printf( wp_kses_post( 'Co-founder of <a href="%1$s" target="_blank">Organic Themes</a>', 'profile-lite' ), 'https://organicthemes.com/' ); ?></b></p>

	</div>

	<?php
}

add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'profile_lite_admin_notice_discount', 10 );

require( get_template_directory() . '/includes/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php' );

/*
-------------------------------------------------------------------------------------------------------
	Category ID to Name
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_cat_id_to_name' ) ) :

	/**
	 * Changes category IDs to names.
	 *
	 * @param array $id IDs for categories.
	 * @return array
	 */
	function profile_lite_cat_id_to_name( $id ) {
		$cat = get_category( $id );
		if ( is_wp_error( $cat ) ) {
			return false; }
		return $cat->cat_name;
	}

endif;

/*
-------------------------------------------------------------------------------------------------------
	Register Sidebars
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_widgets_init' ) ) :

	/** Function profile_lite_widgets_init */
	function profile_lite_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sidebar', 'profile-lite' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		if ( class_exists( 'Organic_Widgets_Pro' ) || class_exists( 'Organic_Widgets' ) ) {
			register_sidebar(array(
				'name'          => esc_html__( 'Home Page Widgets', 'profile-lite' ),
				'id'            => 'home-widgets',
				'before_widget' => '<div id="%1$s" class="organic-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			));
			register_sidebar(array(
				'name'          => esc_html__( 'Footer Widgets', 'profile-lite' ),
				'id'            => 'footer-widgets',
				'before_widget' => '<div id="%1$s" class="organic-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			));
		}
	}
endif;
add_action( 'widgets_init', 'profile_lite_widgets_init' );

/*
-------------------------------------------------------------------------------------------------------
	Posted On Function
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_posted_on' ) ) :

	/** Function profile_lite_posted_on */
	function profile_lite_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted: %s', 'post date', 'profile-lite' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}

endif;

/*
------------------------------------------------------------------------------------------------------
	Content Width
------------------------------------------------------------------------------------------------------
*/

if ( ! isset( $content_width ) ) {
	$content_width = 760;
}

if ( ! function_exists( 'profile_lite_content_width' ) ) :

	/** Function profile_lite_content_width */
	function profile_lite_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'profile_lite_content_width', 760 );
	}

endif;
add_action( 'after_setup_theme', 'profile_lite_content_width', 0 );

/*
-------------------------------------------------------------------------------------------------------
	Comments Function
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_comment' ) ) :

	/**
	 * Setup our comments for the theme.
	 *
	 * @param array $comment IDs for categories.
	 * @param array $args Comment arguments.
	 * @param array $depth Level of replies.
	 */
	function profile_lite_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
		<li class="post pingback">
			<p><?php esc_html_e( 'Pingback:', 'profile-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'profile-lite' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default:
				?>
			<li <?php comment_class(); ?> id="<?php echo esc_attr( 'li-comment-' . get_comment_ID() ); ?>">

				<article id="<?php echo esc_attr( 'comment-' . get_comment_ID() ); ?>" class="comment">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php
								$avatar_size = 72;
							if ( '0' != $comment->comment_parent ) {
								$avatar_size = 48; }

								echo get_avatar( $comment, $avatar_size );

								/* translators: 1: comment author, 2: date and time */
								printf( esc_html__( '%1$s %2$s', 'profile-lite' ),
									sprintf( '<span class="fn">%s</span><br />', wp_kses_post( get_comment_author_link() ) ),
									sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a><br />',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										esc_html( get_comment_time( 'c' ) ),
										/* translators: 1: date, 2: time */
										sprintf( esc_html__( '%1$s, %2$s', 'profile-lite' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) )
									)
								);
							?>
						</div><!-- END .comment-author .vcard -->
					</footer>

					<div class="comment-content">
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'profile-lite' ); ?></em>
						<br />
					<?php endif; ?>
						<?php comment_text(); ?>
						<div class="reply">
						<?php
						comment_reply_link( array_merge( $args, array(
							'reply_text' => esc_html__( 'Reply', 'profile-lite' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) );
						?>
						</div><!-- .reply -->
						<?php edit_comment_link( esc_html__( 'Edit', 'profile-lite' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

				</article><!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
endif; // Ends check for profile_lite_comment().

/*
-------------------------------------------------------------------------------------------------------
	Custom Excerpt
-------------------------------------------------------------------------------------------------------
*/

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Profile Lite 1.0
 * @param string $link Exacerpt permalink to post.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function profile_lite_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'profile-lite' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'profile_lite_excerpt_more' );

/**
 * Adds line break before Read More tag.
 *
 * @since Profile Lite 1.0
 *
 * @param string $more_link The anchor for rendering the more tag.
 * @param string $more_link_text The text for the more tag.
 */
function profile_lite_more_link( $more_link, $more_link_text ) {
	return '<p><a class="more-link" href="' . get_permalink() . '">' . $more_link_text . '</a></p>';
}
add_filter( 'the_content_more_link', 'profile_lite_more_link', 10, 2 );

/*
-------------------------------------------------------------------------------------------------------
	Add Excerpt To Pages
-------------------------------------------------------------------------------------------------------
*/

/**
 * Add excerpt to pages.
 */
function profile_lite_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'profile_lite_page_excerpts' );

/*
-------------------------------------------------------------------------------------------------------
	Custom Page Links
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_wp_link_pages_args_prevnext_add' ) ) :

	/**
	 * Adds custom page links to pages.
	 *
	 * @param array $args for page links.
	 * @return array
	 */
	function profile_lite_wp_link_pages_args_prevnext_add( $args ) {
		global $page, $numpages, $more, $pagenow;

		if ( 'next_and_number' != $args['next_or_number'] ) {
			return $args; }

		$args['next_or_number'] = 'number'; // Keep numbering for the main part.
		if ( ! $more ) {
			return $args; }

		if ( $page - 1 ) { // There is a previous page.
			$args['before'] .= _wp_link_page( $page - 1 )
				. $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>'; }

		if ( $page < $numpages ) { // There is a next page.
			$args['after'] = _wp_link_page( $page + 1 )
				. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
				. $args['after']; }

		return $args;
	}
endif;
add_filter( 'wp_link_pages_args', 'profile_lite_wp_link_pages_args_prevnext_add' );

/*
-------------------------------------------------------------------------------------------------------
	Body Class
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'profile_lite_body_class' ) ) :

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function profile_lite_body_class( $classes ) {

		$header_image = get_header_image();
		$post_pages   = is_home() || is_archive() || is_search() || is_attachment();

		global $post;
		if ( $post ) {
			$page_template = get_page_template_slug( $post->ID );
		} else {
			$page_template = false;
		}

		if ( is_page_template( 'template-home.php' ) && ! empty( $post->post_excerpt ) && 'templates/organic-custom-template.php' !== $page_template ) {
			$classes[] = 'profile-has-excerpt';
		}

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$classes[] = 'profile-has-logo';
		}

		if ( is_page_template( 'template-slideshow.php' ) ) {
			$classes[] = 'profile-slideshow';
		}

		if ( 'blank' != get_theme_mod( 'profile_lite_site_tagline' ) ) {
			$classes[] = 'profile-desc-active';
		} else {
			$classes[] = 'profile-desc-inactive';
		}

		if ( has_nav_menu( 'social-menu' ) ) {
			$classes[] = 'profile-has-social-menu';
		} else {
			$classes[] = 'profile-no-social-menu';
		}

		if ( is_singular() && ! has_post_thumbnail() || is_home() && ! has_custom_header() || is_archive() && ! has_custom_header() ) {
			$classes[] = 'profile-no-img'; }

		if ( is_singular() && has_post_thumbnail() ) {
			$classes[] = 'profile-has-img'; }

		if ( $post_pages && ! empty( $header_image ) || is_page() && has_post_thumbnail() || is_page() && ! empty( $header_image ) || is_single() && ! has_post_thumbnail() && ! empty( $header_image ) ) {
			$classes[] = 'profile-header-active';
		} else {
			$classes[] = 'profile-header-inactive';
		}

		if ( is_header_video_active() && has_header_video() ) {
			$classes[] = 'profile-header-video-active';
		} else {
			$classes[] = 'profile-header-video-inactive';
		}

		if ( is_singular() ) {
			$classes[] = 'profile-singular';
		}

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'profile-sidebar-1';
		}

		if ( is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'template-full.php' ) && ! is_page_template( 'template-home.php' ) ) {
			$classes[] = 'profile-sidebar-active';
		} else {
			$classes[] = 'profile-sidebar-inactive';
		}

		if ( '' != get_theme_mod( 'background_image' ) ) {
			// This class will render when a background image is set
			// regardless of whether the user has set a color as well.
			$classes[] = 'profile-background-image';
		} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ), true ) ) {
			// This class will render when a background color is set
			// but no image is set. In the case the content text will
			// Adjust relative to the background color.
			$classes[] = 'profile-relative-text';
		}

		return $classes;
	}
endif;
add_action( 'body_class', 'profile_lite_body_class' );

/*
-------------------------------------------------------------------------------------------------------
	Includes
-------------------------------------------------------------------------------------------------------
*/

require_once( get_template_directory() . '/customizer/customizer.php' );
require_once( get_template_directory() . '/includes/style-options.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
require_once( get_template_directory() . '/includes/plugin-activation.php' );
require_once( get_template_directory() . '/includes/plugin-activation-class.php' );
require_once( get_template_directory() . '/includes/aria-walker-nav-menu.php' );
