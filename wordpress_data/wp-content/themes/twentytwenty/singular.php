<?php

/**
 * The template for displaying single posts and pages.
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

	if (have_posts()) {

		while (have_posts()) {
			the_post();

			get_template_part('template-parts/content', get_post_type());
		}
	}
	?>
	<?php
	if (post_password_required()) {
		return;
	}
	?>

	<!-- Comment Form (Bootstrap Styled) -->
	<div class="container d-flex justify-content-center align-items-center w-75 h-75">
		<section class="card my-5 shadow-sm comments ">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link active" id="posts-tab" href="#posts">
							<h2>Make a Post</h2>
						</a>
					</li>
				</ul>
			</div>

			<div class="card-body">
				<?php
				comment_form(array(
					'title_reply' => '',
					'comment_field' => '
                <div class="form-group">
                    <textarea id="comment" name="comment" class="form-control comments-post" rows="6" placeholder="What are you thinking..." required></textarea>
                </div>',
					'fields' => array(
						'author' => '
                    <div class="form-group">
                        <input id="author" name="author" type="text" class="form-control" placeholder="Your name" required>
                    </div>',
						'email' => '
                    <div class="form-group">
                        <input id="email" name="email" type="email" class="form-control" placeholder="Your email" required>
                    </div>',
					),
					'submit_button' => '<div class="text-right"><button type="submit" class="btn btn-primary px-4"><h3>share</h3></button></div>',
					'logged_in_as' => '',
					'comment_notes_before' => '',
					'comment_notes_after' => '',
				));
				?>
			</div>
		</section>
	</div>


</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
