<?php
/**
 *
 * This template is used to display a blog. The content is displayed in post formats.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

			<!-- BEGIN .eleven columns -->
			<section class="columns eleven">

				<?php get_template_part( 'content/loop', 'blog' ); ?>

			<!-- END .eleven columns -->
			</section>

			<!-- BEGIN .five columns -->
			<section class="columns five">

				<?php get_sidebar(); ?>

			<!-- END .five columns -->
			</section>

		<?php } else { ?>

			<!-- BEGIN .sixteen columns -->
			<section class="sixteen columns">

				<?php get_template_part( 'content/loop', 'blog' ); ?>

			<!-- END .sixteen columns -->
			</section>

		<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>
