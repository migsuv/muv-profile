<?php
/**
 * The footer for our theme.
 * This template is used to generate the footer for the theme.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?>

<!-- END .container -->
</main>

<!-- BEGIN .footer -->
<footer class="footer" role="contentinfo">

	<?php if ( is_active_sidebar( 'footer-widgets' ) && ( class_exists( 'Organic_Widgets_Pro' ) || class_exists( 'Organic_Widgets' ) ) ) { ?>

		<!-- BEGIN .row -->
		<div class="row">

			<section class="organic-ocw-container">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</section>

		<!-- END .row -->
		</div>

	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">

			<!-- BEGIN .footer-information -->
			<div class="footer-information">

				<div <?php if ( ! is_page_template( 'template-home.php' ) ) { ?>
					class="align-left"
				<?php } else { ?>
					class="text-center"<?php } ?>>

					<p><?php esc_html_e( 'Copyright', 'profile-lite' ); ?> &copy; <?php echo esc_html( date( 'Y' ) ); ?> &middot; <?php esc_html_e( 'All Rights Reserved', 'profile-lite' ); ?> &middot; <?php esc_html( bloginfo( 'name' ) ); ?></p>

					<p><?php /* translators: 1: Theme name. 2: Theme link. */ printf( esc_html__( 'Theme: %1$s by %2$s', 'profile-lite' ), 'Profile Lite', '<a href="http://organicthemes.com/">Organic Themes</a>' ); ?></p>

				</div>

				<?php if ( has_nav_menu( 'social-menu' ) && ! is_page_template( 'template-home.php' ) ) { ?>

				<nav class="align-right" role="navigation" aria-label="<?php esc_attr_e( 'Social Navigation', 'profile-lite' ); ?>">

					<?php
					wp_nav_menu( array(
						'theme_location'  => 'social-menu',
						'title_li'        => '',
						'depth'           => 1,
						'container_class' => 'social-menu',
						'menu_class'      => 'social-icons',
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
					) );
					?>

				</nav>

				<?php } ?>

			<!-- END .footer-information -->
			</div>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .footer -->
</footer>

<!-- END #wrapper -->
</div>

<?php wp_footer(); ?>

</body>
</html>
