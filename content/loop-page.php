<?php
/**
 * This template displays the page loop.
 *
 * @package Profile Lite
 * @since Profile Lite 1.0
 */

?>

<?php $front_page = is_front_page(); ?>

<?php
// The loop.
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

	<!-- BEGIN .entry-content -->
	<article class="entry-content">

		<?php if ( ! $front_page && ! has_post_thumbnail() || $front_page && ! has_post_thumbnail() && ! has_custom_header() || '' == get_theme_mod( 'display_img_title_page', '1' ) ) { ?>
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
