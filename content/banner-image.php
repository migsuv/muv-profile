<?php
/**
 * This template is used to display the banner image on posts and pages.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?>

<?php $header_image = get_header_image(); ?>
<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'profile-lite-featured-large' ) : false; ?>

<?php if ( is_singular() && has_post_thumbnail() ) { ?>

	<!-- BEGIN .row -->
	<header class="header-img row" role="banner">

		<!-- BEGIN #custom-header -->
		<div id="custom-header" class="featured-img banner-img" style="background-image: url(<?php echo esc_url( $thumb[0] ); ?>);">

			<!-- BEGIN .row -->
			<div class="row">

			<?php if ( is_page() || is_single() ) { ?>
				<div class="img-title vertical-center">
					<h1 class="img-headline"><?php the_title(); ?></h1>
					<?php if ( is_single() && '1' == get_theme_mod( 'display_img_title_post', '1' ) ) { ?>
						<div class="post-author">
							<p><?php profile_lite_posted_on(); ?> <?php esc_html_e( 'by', 'profile-lite' ); ?> <?php the_post(); ?><?php echo get_the_author(); ?><?php rewind_posts(); ?></p>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<?php the_post_thumbnail( 'profile-lite-featured-large' ); ?>

			<!-- END .row -->
			</div>

		<!-- END #custom-header -->
		</div>

		<?php if ( has_custom_logo() && is_page() || has_custom_logo() && is_page() && 'templates/organic-custom-template.php' !== $page_template ) { ?>

		<!-- BEGIN .site-logo -->
		<div class="site-logo horizontal-center">

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

	<!-- END .row -->
	</header>

<?php } ?>
