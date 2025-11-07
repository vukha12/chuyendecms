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

    <div class="container-fluid">
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
                                <p class="card-text small text-muted mb-0 ">
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
                <?php
                // 🔹 Tạo truy vấn mới, chỉ lấy 6 bài viết theo từ khóa tìm kiếm hiện tại
                $args = array(
                    'posts_per_page' => 6,
                    's' => get_search_query(), // từ khóa tìm kiếm người dùng nhập vào
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/content', get_post_type());
                    }
                } else {
                    // 🔹 Nếu không có bài nào khớp
                ?>
                    <div class="no-search-results-form section-inner thin">
                        <?php
                        get_search_form(
                            array(
                                'aria_label' => __('search again', 'twentytwenty'),
                            )
                        );
                        ?>
                    </div>
                <?php
                }

                // 🔹 Trả lại truy vấn gốc để tránh ảnh hưởng chỗ khác
                wp_reset_postdata();
                ?>

            </div>

            <!-- ===== Cột Phải: Bình luận mới nhất ===== -->
            <div class="col-md-3 mb-4">
                <h4 class="fw-semibold border-bottom pb-2 mb-3">Bình luận gần đây</h4>

                <?php
                $recent_comments = get_comments(array(
                    'number' => 5,
                    'status' => 'approve',
                ));

                if ($recent_comments) :
                    foreach ($recent_comments as $comment) :
                        $post_title = get_the_title($comment->comment_post_ID);
                        $comment_content = wp_trim_words(wp_strip_all_tags($comment->comment_content), 35, '...');
                ?>
                        <div class="comment-box mb-3">
                            <div class="comment-inner d-flex">
                                <!-- Avatar (rectangle) -->
                                <div class="comment-avatar flex-shrink-0">
                                    <?php
                                    // lấy avatar kích thước lớn, nhưng CSS sẽ ép tỉ lệ chữ nhật
                                    echo get_avatar($comment, 64, '', '', array('class' => 'avatar-rect'));
                                    ?>
                                </div>

                                <!-- Phần nội dung (tên với nền xám ở trên + nội dung bên dưới) -->
                                <div class="comment-content flex-grow-1 ms-3">
                                    <div class="comment-author-bar">
                                        <span class="comment-author-name"><?php echo esc_html($comment->comment_author); ?></span>
                                    </div>

                                    <div class="comment-text p-2 bg-white border">
                                        <p class="mb-1 small text-muted" style="line-height:1.4;">
                                            <?php echo esc_html($comment_content); ?>
                                        </p>
                                    </div>
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

    <!-- Những bài viết mới nhất -->
    <div class="latest-news-wrapper">
        <ul class="latest-news-timeline list-unstyled">
            <?php foreach ($recent_posts as $rp) : ?>
                <li class="news-item">
                    <span class="timeline-dot"></span>
                    <div class="news-content">
                        <div class="d-flex">
                            <a class="text-primary fw-semibold" href="<?php echo esc_url(get_permalink($rp->ID)); ?>">
                                <?php echo esc_html(get_the_title($rp->ID)); ?>
                            </a>
                            <span><?php echo get_the_date('j F, Y', $rp->ID); ?></span>
                        </div>
                        <p>
                            <?php echo esc_html(wp_trim_words(wp_strip_all_tags($rp->post_content), 20, '...')); ?>
                        </p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</main>

<?php get_footer(); ?>