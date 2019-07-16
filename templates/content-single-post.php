<div <?php post_class('post-single'); ?>>
<?php if ( has_post_thumbnail() ) {?>
<div class="thumb" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></div>
<?php } ?>
<div class="post-cat"><?php the_category(' '); ?></div>
<div class="post-information">
    <div class="post-title"><?php the_title(); ?></div>
    <div class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?></div>
    <div class="post-author"><?php echo 'By - '; the_author_posts_link(); ?></div>
    <div class="post-date"><?php echo 'On - ' . esc_html(get_the_date('M j, Y')); ?></div>
</div>
<div class="post-content"><?php the_content(); ?></div>
<div class="post-tags"><?php the_tags('',' ',''); ?></div>
<?php 
    $aladdin_args = array(
        'before'           => '<div class="post-pagination">',
        'after'            => '</div>',
        'next_or_number'   => 'next',
        'nextpagelink'     => __( 'Next page', 'aladdin'),
		'previouspagelink' => __( 'Previous page', 'aladdin' ),
    ); 
    wp_link_pages( $aladdin_args ); 
?>
<hr>

<div class="prev-nxt">
    <div class="prev-post">
    <?php
        $aladdin_prev_post = get_adjacent_post(false, '', true);
            if(!empty($aladdin_prev_post)){
                echo '<p><a href="' . esc_url(get_permalink($aladdin_prev_post->ID)) . '">Previous Post</a></p>';
                echo '<div class="post-title"><a href="' . esc_url(get_permalink($aladdin_prev_post->ID)) . '">' . esc_html(mb_strimwidth($aladdin_prev_post->post_title, 0, 40, '...')) . '</a></div>';
            }
    ?>
    </div>

    <div class="nxt-post">
    <?php
        $aladdin_next_post = get_adjacent_post(false, '', false);
        if(!empty($aladdin_next_post)) {
            echo '<p><a href="' . esc_url(get_permalink($aladdin_next_post->ID)) . '">Next Post</a></p>';
            echo '<div class="post-title"><a href="' . esc_url(get_permalink($aladdin_next_post->ID)) . '">' . esc_html(mb_strimwidth($aladdin_next_post->post_title, 0, 40, '...')) . '</a></div>'; }
    ?>
    </div>
</div>
</div>
<hr>
