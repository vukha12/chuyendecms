<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class('custom-timeline-card'); ?> id="post-<?php the_ID(); ?>">

	<?php if (is_single()) : ?>
		<!-- Giao diện chi tiết bài viết -->
		<div class="entry-content">

			<?php
			if (is_search() || ! is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				if (is_single()) {
					the_content(__('Continue reading', 'twentytwenty'));
				} else {
					$post = get_post();
					echo substr($post->post_content, 0, 100); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			?>

		</div><!-- .entry-content -->

	<?php else : ?>
		<!-- Giao diện danh sách bài viết (timeline) -->
		<div class="timeline-card-wrapper">

			<!-- Ngày bên trái -->
			<div class="timeline-date">
				<span class="day"><?php echo get_the_date('d'); ?></span>
				<span class="month"><?php echo strtoupper(get_the_date('M')); ?></span>
			</div>

			<!-- Nội dung bên phải -->
			<div class="timeline-content">
				<h2 class="timeline-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<div class="timeline-excerpt">
					<?php
					$content = wp_strip_all_tags(get_the_content());
					$excerpt = mb_substr($content, 0, 120);
					echo $excerpt . ' [...]';
					?>
				</div>
			</div>

		</div>
	<?php endif; ?>

</article>