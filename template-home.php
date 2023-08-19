<?php
/**
Template Name: Home
 *
 * This template is used to display full-width pages.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class( 'home-page' ); ?> id="page-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">

			<!-- BEGIN .sixteen columns -->
			<section class="sixteen columns">

				<?php get_template_part( 'content/loop', 'page' ); ?>

			<!-- END .sixteen columns -->
			</section>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

	<?php if ( is_active_sidebar( 'home-widgets' ) && ( class_exists( 'Organic_Widgets_Pro' ) || class_exists( 'Organic_Widgets' ) ) ) { ?>

	<!-- BEGIN .row -->
	<div class="row">

		<section class="organic-ocw-container">
			<?php dynamic_sidebar( 'home-widgets' ); ?>
		</section>

	<!-- END .row -->
	</div>

	<?php } ?>

<!-- END .post class -->
</div>

<?php get_footer(); ?>
