<?php
/**
 * This page template is used to display a 404 error message.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .row -->
<div class="row">

	<!-- BEGIN .content -->
	<div class="content">

		<!-- BEGIN .sixteen columns -->
		<section class="sixteen columns">

			<!-- BEGIN .entry-content -->
			<article class="entry-content text-center">

				<?php get_template_part( 'content/content', 'none' ); ?>

			<!-- END .entry-content -->
			</article>

		<!-- END .sixteen columns -->
		</section>

	<!-- END .content -->
	</div>

<!-- END .row -->
</div>

<?php get_footer(); ?>
