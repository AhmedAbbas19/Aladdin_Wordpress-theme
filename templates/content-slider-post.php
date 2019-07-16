<div <?php post_class('slider-post thumb'); ?> style="background-image: url(<?php the_post_thumbnail_url() ?>)">
    <div class="post-information">
        <div class="post-cat"><?php $aladdin_categories = get_the_category(); if ( ! empty( $aladdin_categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $aladdin_categories[0]->term_id ) ) . '">' . esc_html( $aladdin_categories[0]->name ) . '</a>';} ?></div>
        <div class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(mb_strimwidth(get_the_title(), 0, 40, '...')); ?></div>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="view-post-btn">View Post</a>
    </div>
</div>
