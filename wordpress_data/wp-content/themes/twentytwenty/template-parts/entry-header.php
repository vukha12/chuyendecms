<?php

/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$entry_header_classes = '';

if (is_singular()) {
	$entry_header_classes .= ' header-footer-group';
}
$post = get_post();;
?>

<header class="entry-header has-text-align-center <?php echo esc_attr($entry_header_classes); ?>">
	<div class="wrap-header-title-circle">
		<div class="entry-header-inner section-inner medium">

			<?php

			if (is_singular()) {
				the_title('<h1 class="entry-title">', '</h1>');
			} else {
				the_title('<h2 class="entry-title heading-size-1"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
			}

			$intro_text_width = '';

			if (is_singular()) {
				$intro_text_width = ' small';
			} else {
				$intro_text_width = ' thin';
			}

			if (has_excerpt() && is_singular()) {
			?>

				<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
																	?>">
					<?php the_excerpt(); ?>
				</div>

			<?php
			}

			// Default to displaying the post meta.
			// twentytwenty_the_post_meta(get_the_ID(), 'single-top');
			?>

		</div><!-- .entry-header-inner -->
		<div class="circle-date">
			<div class="left">
				<div class="day"><?php echo get_the_date('d', $post->ID); ?></div>
				<div class="month"><?php echo get_the_date('m', $post->ID); ?></div>
			</div>
			<div class="year"><?php echo get_the_date('y', $post->ID); ?></div>
		</div>
	</div>
</header><!-- .entry-header -->