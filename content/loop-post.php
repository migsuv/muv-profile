<?php
/**
 * This template displays the post loop.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?>

<?php
// The loop.
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

	<!-- BEGIN .entry-content -->
	<article class="entry-content">

		<?php if ( ! has_post_thumbnail() || '' == get_theme_mod( 'display_img_title_post', '1' ) ) { ?>
			<h1 class="entry-header"><?php the_title(); ?></h1>
		<?php } ?>

		<?php the_content( /* translators: 1: Permalink. */ sprintf( esc_html__( 'Continue reading%s', 'profile-lite' ), '<span class="screen-reader-text">  ' . get_the_title() . '</span>', false ) ); ?>

		<?php
		wp_link_pages( array(
			'before'           => '<p class="page-links"><span class="link-label">' . esc_html__( 'Pages:', 'profile-lite' ) . '</span>',
			'after'            => '</p>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'next_or_number'   => 'next_and_number',
			'nextpagelink'     => esc_html__( 'Next', 'profile-lite' ),
			'previouspagelink' => esc_html__( 'Previous', 'profile-lite' ),
			'pagelink'         => '%',
			'echo'             => 1,
		) );
		?>

		<?php edit_post_link( esc_html__( '(Edit)', 'profile-lite' ), '', '' ); ?>

		<!-- BEGIN .post-meta -->
		<div class="post-meta">

			<!-- BEGIN .post-author -->
			<div class="post-author">
				<p class="align-left"><em><?php profile_lite_posted_on(); ?> <?php esc_html_e( 'by', 'profile-lite' ); ?></em> <?php esc_url( the_author_posts_link() ); ?> <span class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span></p>
			<!-- END .post-author -->
			</div>

			<?php $tag_list = get_the_tag_list( esc_html__( ', ', 'profile-lite' ) ); if ( ! empty( $tag_list ) || has_category() ) { ?>
				<!-- BEGIN .post-taxonomy -->
				<div class="post-taxonomy">
					<p class="align-left"><?php esc_html_e( 'Category:', 'profile-lite' ); ?> <?php the_category( ', ' ); ?><p>
					<?php if ( ! empty( $tag_list ) ) { ?>
						<p class="align-right"><?php esc_html_e( 'Tags:', 'profile-lite' ); ?> <?php the_tags( '' ); ?></p>
					<?php } ?>
				<!-- END .post-taxonomy -->
				</div>
			<?php } ?>

			<!-- BEGIN .post-navigation -->
			<div class="post-navigation">
				<div class="previous-post"><?php previous_post_link( '<i class="fa fa-angle-left"></i> %link', 'Previous Post' ); ?></div>
				<div class="next-post"><?php next_post_link( '%link <i class="fa fa-angle-right"></i>', 'Next Post' ); ?></div>
			<!-- END .post-navigation -->
			</div>

		<!-- END .post-meta -->
		</div>

	<!-- END .entry-content -->
	</article>

		<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
			<?php comments_template(); ?>
		<?php } ?>

<?php endwhile; else : ?>

	<!-- BEGIN .entry-content -->
	<article class="entry-content">

		<?php get_template_part( 'content/content', 'none' ); ?>

	<!-- END .entry-content -->
	</article>

<?php endif; ?>
