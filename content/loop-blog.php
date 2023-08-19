<?php
/**
 * This template displays the blog loop.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?>

<?php $blog_query['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; ?>

<?php
$blog_query = new WP_Query( array(
	'cat'              => get_theme_mod( 'profile_lite_blog_category', '0' ),
	'paged'            => $paged,
	'suppress_filters' => 0,
) );
?>

<?php
// The loop.
if ( $blog_query->have_posts() ) :
	while ( $blog_query->have_posts() ) :
		$blog_query->the_post();
		?>

		<?php
		$temp_query = $wp_query;
		$wp_query   = null;
		$wp_query   = $blog_query;
		?>

	<!-- BEGIN .post class -->
	<div <?php post_class( 'blog-holder profile-lite-bg-light' ); ?> id="post-<?php the_ID(); ?>">

		<!-- BEGIN .entry-title -->
		<div class="entry-title">

			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr( the_title_attribute() ); ?>"><?php the_title(); ?></a></h2>

			<!-- BEGIN .post-meta -->
			<div class="post-meta">

				<div class="post-author">
					<p><em><?php esc_html_e( 'by', 'profile-lite' ); ?></em> <?php esc_url( the_author_posts_link() ); ?></p>
				</div>

				<div class="post-date">
					<p><?php profile_lite_posted_on(); ?></p>
				</div>

				<?php if ( comments_open() ) { ?>
					<div class="post-comments">
						<p><a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__( 'Leave a Comment', 'profile-lite' ), esc_html__( '1 Comment', 'profile-lite' ), '% Comments' ); ?></a></p>
					</div>
				<?php } ?>

			<!-- END .post-meta -->
			</div>

		<!-- END .entry-title -->
		</div>

		<?php if ( has_post_thumbnail() ) { ?>
			<a class="featured-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( /* translators: 1: Permalink. */ sprintf( esc_html__( 'Permalink to %s', 'profile-lite' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'profile-featured-medium' ); ?></a>
		<?php } ?>

		<!-- BEGIN .entry-content -->
		<article class="entry-content">

			<?php the_content( /* translators: 1: Permalink. */ sprintf( esc_html__( 'Continue reading%s', 'profile-lite' ), '<span class="screen-reader-text">  ' . get_the_title() . '</span>', false ) ); ?>

		<!-- END .entry-content -->
		</article>

	<!-- END .post class -->
	</div>

<?php endwhile; ?>

	<?php if ( $blog_query->max_num_pages > 1 ) { ?>

		<?php
		the_posts_pagination( array(
			'prev_text' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Previous Page', 'profile-lite' ) . ' </span>&laquo;',
			'next_text' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Next Page', 'profile-lite' ) . ' </span>&raquo;',
		) );
		?>

	<?php } ?>

<?php else : ?>

	<!-- BEGIN .entry-content -->
	<article class="entry-content">

		<?php get_template_part( 'content/content', 'none' ); ?>

	<!-- END .entry-content -->
	</article>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
