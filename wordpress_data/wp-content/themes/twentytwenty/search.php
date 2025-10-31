<?php

/**
 * Template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 */

get_header();
?>
<link rel="stylesheet" href="style.css">
<main id="site-content" class="py-5 bg-light">

    <div class="container">
        <!-- Tiêu đề trang -->
        <header class="text-center mb-5">
            <h1 class="fw-bold">
                Kết quả tìm kiếm cho:
                <span class="text-primary">"<?php echo esc_html(get_search_query()); ?>"</span>
            </h1>
        </header>

        <div class="row">
            <!-- ===== Cột Trái: Bài viết mới nhất ===== -->
            <div class="col-lg-3 col-md-4 mb-4">
                <h5 class="mb-3 border-bottom pb-2">Bài viết mới nhất</h5>

                <?php
                // Lấy 5 bài mới nhất bằng get_posts (WP_Post objects)
                $recent_posts = get_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish',
                ));

                if (! empty($recent_posts)) :
                    foreach ($recent_posts as $rp) : ?>
                        <div class="card mb-3 shadow-sm">
                            <?php
                            // Nếu có featured image
                            if (has_post_thumbnail($rp->ID)) {
                                echo '<a href="' . esc_url(get_permalink($rp->ID)) . '">';
                                echo get_the_post_thumbnail($rp->ID, 'medium', array('class' => 'card-img-top', 'alt' => esc_attr($rp->post_title)));
                                echo '</a>';
                            }
                            ?>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1 fs-5">
                                    <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="text-decoration-none text-secondary fs-6">
                                        <?php echo esc_html(get_the_title($rp->ID)); ?>
                                    </a>
                                </h6>
                                <p class="card-text small text-muted mb-0">
                                    <?php
                                    $short = wp_trim_words(wp_strip_all_tags($rp->post_content), 10, '...');
                                    echo esc_html($short);
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                else :
                    ?>
                    <p>Không có bài viết mới nào.</p>
                <?php endif; ?>
            </div>

            <!-- ===== Cột Giữa: Kết quả tìm kiếm ===== -->
            <div class="col-md-6 mb-4">
                <h4 class="fw-semibold border-bottom pb-2 mb-3">Kết quả tìm kiếm</h4>

                <?php if (have_posts()) : ?>
                    <div class="list-group">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="card mb-4 shadow-sm border-0">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'card-img-top rounded', 'alt' => get_the_title())); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <?php
                                        // excerpt giới hạn (25 words)
                                        if (has_excerpt()) {
                                            echo esc_html(wp_trim_words(get_the_excerpt(), 25, '...'));
                                        } else {
                                            echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_content()), 25, '...'));
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <small class="text-secondary"><?php echo esc_html(get_the_date()); ?></small>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Đọc tiếp</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <?php get_template_part('template-parts/pagination'); ?>

                <?php else : ?>
                    <div class="text-center my-5">
                        <h5>Không tìm thấy kết quả nào.</h5>
                        <p>Hãy thử tìm kiếm với từ khóa khác:</p>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ===== Cột Phải: Bình luận mới nhất ===== -->
            <div class="col-md-3 mb-4">
                <h4 class="fw-semibold border-bottom pb-2 mb-3">Bình luận gần đây</h4>
                <?php
                $recent_comments = get_comments(array(
                    'number' => 5,
                    'status' => 'approve'
                ));
                if ($recent_comments) :
                    foreach ($recent_comments as $comment) :
                        $post_title = get_the_title($comment->comment_post_ID);
                        $comment_content = wp_trim_words(wp_strip_all_tags($comment->comment_content), 20, '...');
                ?>
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body d-flex">
                                <!-- Avatar -->
                                <div class="me-3">
                                    <?php echo get_avatar($comment, 50, '', '', ['class' => 'rounded-circle shadow-sm']); ?>
                                </div>

                                <!-- Nội dung bình luận -->
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark"><?php echo esc_html($comment->comment_author); ?></h6>
                                    <p class="mb-2 small text-muted"><?php echo esc_html($comment_content); ?></p>
                                    <a href="<?php echo esc_url(get_comment_link($comment)); ?>" class="small text-decoration-none text-primary">
                                        → <?php echo esc_html($post_title); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                else :
                    echo '<p>Chưa có bình luận nào.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>