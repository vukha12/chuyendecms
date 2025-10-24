<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if (is_search()) {
		/**
		 * @global WP_Query $wp_query WordPress Query object.
		 */
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __('Search:', 'twentytwenty') . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ($wp_query->found_posts) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n($wp_query->found_posts)
			);
		} else {
			$archive_subtitle = __('We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty');
		}
	} elseif (is_archive() && ! have_posts()) {
		$archive_title = __('Nothing Found', 'twentytwenty');
	} elseif (! is_home()) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ($archive_title || $archive_subtitle) {
	?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ($archive_title) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
				<?php } ?>

				<?php if ($archive_subtitle) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
			<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<!------ Include the above in your HEAD tag ---------->

			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
			<div class="search-result">
				<br />
				<div class="row justify-content-center">
					<div class="col-12 col-md-10 col-lg-8">
						<form role="search" method="get" class="card card-sm" action="<?php echo esc_url(home_url('/')); ?>">
							<div class="card-body row no-gutters align-items-center">
								<div class="col-auto">
									<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23">
										<path d="M38.710696,48.0601792 L43,52.3494831 L41.3494831,54 L37.0601792,49.710696 C35.2632422,51.1481185 32.9839107,52.0076499 30.5038249,52.0076499 C24.7027226,52.0076499 20,47.3049272 20,41.5038249 C20,35.7027226 24.7027226,31 30.5038249,31 C36.3049272,31 41.0076499,35.7027226 41.0076499,41.5038249 C41.0076499,43.9839107 40.1481185,46.2632422 38.710696,48.0601792 Z M36.3875844,47.1716785 C37.8030221,45.7026647 38.6734666,43.7048964 38.6734666,41.5038249 C38.6734666,36.9918565 35.0157934,33.3341833 30.5038249,33.3341833 C25.9918565,33.3341833 22.3341833,36.9918565 22.3341833,41.5038249 C22.3341833,46.0157934 25.9918565,49.6734666 30.5038249,49.6734666 C32.7048964,49.6734666 34.7026647,48.8030221 36.1716785,47.3875844 C36.2023931,47.347638 36.2360451,47.3092237 36.2726343,47.2726343 C36.3092237,47.2360451 36.347638,47.2023931 36.3875844,47.1716785 Z" transform="translate(-20 -31)"></path>
									</svg>
								</div>

								<div class="col">
									<input class="form-control form-control-lg form-control-borderless"
										type="search"
										placeholder="Search topics or keywords"
										name="s"
										value="<?php echo get_search_query(); ?>">
								</div>

								<div class="col-auto">
									<button class="btn btn-lg btn-success" type="submit">Search</button>
								</div>
							</div>
						</form>
					</div>
					<!--end of col-->
				</div>
			</div>
		</header><!-- .archive-header -->
		<!--  -->
	<?php
	}
	?>
	<div class="container-fluid">
		<div class="row">
			<!-- Left: Recent Posts (image ABOVE title) -->
			<aside class="col-md-3">
				<div class="sidebar-posts">
					<h3>Trang mới nhất</h3>
					<?php
					$recent_posts = wp_get_recent_posts(array(
						'numberposts' => 6,
						'post_status'  => 'publish',
					));
					foreach ($recent_posts as $rp) :
						$post_id = $rp['ID'];
						// use medium size so image sits nicely above title
						$thumb = get_the_post_thumbnail($post_id, 'medium', array('class' => 'recent-thumb img-fluid'));
					?>
						<div class="recent-item">
							<a class="recent-link" href="<?php echo esc_url(get_permalink($post_id)); ?>">
								<?php if ($thumb) {
									echo $thumb;
								} ?>
								<span class="recent-title"><?php echo esc_html($rp['post_title']); ?></span>
							</a>
						</div>
					<?php endforeach;
					wp_reset_postdata();
					?>
				</div>
			</aside>
			<!-- Middle: giữ nguyên loop hiện tại -->
			<section class="col-md-6">
				<?php
				if (have_posts()) {
					$i = 0;
					while (have_posts()) {
						++$i;
						the_post();
						get_template_part('template-parts/content', get_post_type());
					}
				} elseif (is_search()) {
				?>
					<div class="no-search-results-form section-inner thin">
						<h2>Không tìm thấy kết quả nào hết!</h2>
					</div>
				<?php
				}
				?>
			</section>

			<!-- Right: Recent Comments -->
			<aside class="col-md-3">
				<div class="sidebar-comments">
					<h3>Bình luận gần đây</h3>
					<?php
					$recent_comments = get_comments(array(
						'number' => 6,
						'status' => 'approve',
						'type' => 'comment'
					));
					if ($recent_comments) {
						foreach ($recent_comments as $comment) :
							$avatar = get_avatar_url($comment->comment_author_email, array('size' => 48));
							$post_link = get_permalink($comment->comment_post_ID);
							$post_title = get_the_title($comment->comment_post_ID);
					?>
							<div class="comment-item">
								<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($comment->comment_author); ?>" class="comment-avatar" />
								<div class="comment-body">
									<strong class="comment-author"><?php echo esc_html($comment->comment_author); ?></strong>
									<p class="comment-text"><?php echo esc_html(wp_trim_words($comment->comment_content, 30)); ?></p>
									<a href="<?php echo esc_url($post_link); ?>" class="comment-post-link">
										<?php echo esc_html($post_title); ?>
									</a>
								</div>
							</div>
					<?php
						endforeach;
					} else {
						echo '<p>Chưa có bình luận nào.</p>';
					}
					?>
				</div>
			</aside>
		</div>
	</div>
	<?php get_template_part('template-parts/pagination'); ?>

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
