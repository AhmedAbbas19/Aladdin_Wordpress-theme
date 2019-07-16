<div class="row">
    <div class="col-md-5 col-sm-3 col-xs-5">
    <div class="thumb" style="background-image: url(<?php the_post_thumbnail_url() ?>)"></div>
    </div>
    <div class="col-md-7 col-sm-9 col-xs-7">
        <div class="post-information">
            <div class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(mb_strimwidth(get_the_title(), 0, 40, '...')); ?></a></div>
            <div class="post-date"><?php echo esc_html(get_the_date('M j, Y')); ?></div>
            <div class="post-comments"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></div>
            <span class="post-cat"><?php $aladdin_categories = get_the_category(); if ( ! empty( $aladdin_categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $aladdin_categories[0]->term_id ) ) . '">' . esc_html( $aladdin_categories[0]->name ) . '</a>';} ?></span>
        </div>
    </div>
</div>