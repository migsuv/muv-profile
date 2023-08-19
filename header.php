<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="wrap">
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- BEGIN #wrapper -->
<div id="wrapper">

	<!-- BEGIN #header -->
	<header id="header">

		<!-- BEGIN #header-info -->
		<div id="header-info">

			<div class="site-info">

				<?php if ( is_front_page() && is_home() ) { ?>
					<h2 class="site-description">
						<?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
					</h2>
				<?php } else { ?>
					<p class="site-description">
						<?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
					</p>
				<?php } ?>

				<?php if ( is_front_page() ) { ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
					</h1>
				<?php } else { ?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
					</p>
				<?php } ?>

			</div>

			<!-- BEGIN #nav-bar -->
			<div id="nav-bar">

			<?php if ( has_nav_menu( 'main-menu' ) ) { ?>

				<!-- BEGIN #navigation -->
				<nav id="navigation" class="navigation-main" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'profile-lite' ); ?>">

					<?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'title_li'       => '',
							'depth'          => 4,
							'fallback_cb'    => 'wp_page_menu',
							'container'      => false,
							'menu_class'     => 'menu',
							'walker'         => new Aria_Walker_Nav_Menu(),
							'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
						) );
					?>

				<!-- END #navigation -->
				</nav>

				<button type="button" id="menu-toggle" class="menu-toggle" href="#sidr">
					<svg class="icon-menu-open" version="1.1" id="icon-open" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
						<rect y="2" width="24" height="2"/>
						<rect y="11" width="24" height="2"/>
						<rect y="20" width="24" height="2"/>
					</svg>
					<svg class="icon-menu-close" version="1.1" id="icon-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
						<rect x="0" y="11" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 12 28.9706)" width="24" height="2"/>
						<rect x="0" y="11" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 28.9706 12)" width="24" height="2"/>
					</svg>
				</button>

			<?php } ?>

			<!-- END #nav-bar -->
			</div>

		<!-- END #header-info -->
		</div>

		<?php
		global $post;
		if ( $post ) {
			$page_template = get_page_template_slug( $post->ID );
		} else {
			$page_template = false;
		}
		?>

		<?php if ( is_page_template( 'template-home.php' ) || is_singular() && ! has_post_thumbnail() || is_home() || is_archive() || is_search() || is_attachment() || is_404() ) { ?>

			<!-- BEGIN #custom-header -->
			<div id="custom-header">

				<!-- BEGIN .row -->
				<div class="row">

					<?php if ( is_page() && ! empty( $post->post_excerpt ) && 'templates/organic-custom-template.php' !== $page_template ) { ?>
						<div class="img-title vertical-center">
							<div class="excerpt"><?php the_excerpt(); ?></div>
						</div>
					<?php } ?>

					<?php the_custom_header_markup(); ?>

				<!-- END .row -->
				</div>

			<!-- END #custom-header -->
			</div>

			<?php if ( has_custom_logo() && ! is_single() || has_custom_logo() && 'templates/organic-custom-template.php' !== $page_template && ! is_single() ) { ?>

			<!-- BEGIN .site-logo -->
			<div class="site-logo">

				<?php the_custom_logo(); ?>

				<?php if ( has_nav_menu( 'social-menu' ) ) { ?>

				<nav role="navigation" aria-label="<?php esc_attr_e( 'Social Navigation', 'profile-lite' ); ?>">

					<?php
					wp_nav_menu( array(
						'theme_location'  => 'social-menu',
						'title_li'        => '',
						'depth'           => 1,
						'container_class' => 'social-menu',
						'menu_class'      => 'social-icons circle-container',
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
					) );
					?>

				</nav>

				<?php } ?>

			<!-- END .site-logo -->
			</div>

			<?php } // End custom logo conditional. ?>

		<?php } ?>

	<!-- END #header -->
	</header>

	<!-- BEGIN .container -->
	<main class="container" role="main">
