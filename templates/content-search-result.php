<div <?php post_class('grid-post'); ?>>
    <div class="row">
        <div class="col-sm-4">
            <div class="slider-post thumb" style="background-image: url(<?php the_post_thumbnail_url() ?>)">
                <div class="post-cat"><?php $aladdin_categories = get_the_category(); if ( ! empty( $aladdin_categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $aladdin_categories[0]->term_id ) ) . '">' . esc_html( $aladdin_categories[0]->name ) . '</a>';} ?></div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(mb_strimwidth(get_the_title(), 0, 45, '...')); ?></div>
            <div class="post-information">
                <div class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></div>
                <div class="post-author"><?php echo 'By - '; the_author_posts_link(); ?></div>
                <div class="post-date"><?php echo 'On - ' . esc_html(get_the_date('M j, Y')); ?></div>
                <div class="post-comments"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></div>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="continue-reading-btn">Continue Reading</a>
            </div>
        </div>
    </div>
</div>
<hr>