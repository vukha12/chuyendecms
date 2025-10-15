<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.word	press.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$class = '';
if (!is_single()) {
	$class = 'danh-sach ';
}
?>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

	<title>Test2</title>

	<style>
		.h7 {
			font-size: 0.9rem
		}
	</style>

</head>

<article <?php post_class($class); ?> id="post-<?php the_ID(); ?>">

	<?php if (!is_single()) : ?>
		<!-- Cột ngày tháng -->
		<div class="post-date">
			<div class="day"><?php echo get_the_date('d'); ?></div>
			<div class="month"><?php echo get_the_date('M'); ?></div>
		</div>

		<!-- Thumbnail -->
		<!-- <?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('medium'); ?>
			</a>
		</div>
		<?php endif; ?> -->

		<!-- Nội dung bài viết -->
		<div class="entry-content entry-content-home">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<p>
				<?php echo wp_trim_words(get_the_content(), 100, '[...]'); ?>
			</p>
		</div>

	<?php else : ?>
		<!-- Nếu đang ở trang chi tiết -->
		<div class="entry-content">
			<?php
			get_template_part('template-parts/entry-header');
			?>
			<?php the_content(); ?>
		</div>
		<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();

		if ($prev_post || $next_post): ?>
			<div class="custom-post-navigation section-inner">

				<?php if ($next_post): ?>
					<div class="nav-item next-post">
						<a href="<?php echo get_permalink($next_post->ID); ?>">
							<div class="date">
								<div class="day-month">
									<span class="day"><?php echo get_the_date('d', $next_post->ID); ?></span>
									<span class="month"><?php echo get_the_date('m', $next_post->ID); ?></span>
								</div>
								<span class="year"><?php echo get_the_date('y', $next_post->ID); ?></span>
							</div>
							<div class="title"><?php echo get_the_title($next_post->ID); ?></div>
						</a>
					</div>
				<?php endif; ?>

				<?php if ($prev_post): ?>
					<div class="nav-item prev-post">
						<a href="<?php echo get_permalink($prev_post->ID); ?>">
							<div class="date">
								<div class="day-month">
									<span class="day"><?php echo get_the_date('d', $prev_post->ID); ?></span>
									<span class="month"><?php echo get_the_date('m', $prev_post->ID); ?></span>
								</div>
								<span class="year"><?php echo get_the_date('y', $prev_post->ID); ?></span>
							</div>
							<div class="title"><?php echo get_the_title($prev_post->ID); ?></div>
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	<?php endif; ?>

</article>