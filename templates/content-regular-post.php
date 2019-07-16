<div class="col-lg-3 col-md-4 col-sm-6">
    <div <?php post_class('regular-post thumb'); ?> style="background-image: url(<?php the_post_thumbnail_url() ?>)">
        <div class="post-cat"><?php $aladdin_categories = get_the_category(); if ( ! empty( $aladdin_categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $aladdin_categories[0]->term_id ) ) . '">' . esc_html( $aladdin_categories[0]->name ) . '</a>';} ?></div>
        <div class="post-information">
            <div class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(mb_strimwidth(get_the_title(), 0, 40, '...')); ?></a></div>
            <div class="post-author"><?php echo 'By - '; the_author_posts_link(); ?></div>
            <div class="post-date"><?php echo 'On - ' . esc_html(get_the_date('M j, Y')); ?></div>
        </div>
    </div>
</div>
