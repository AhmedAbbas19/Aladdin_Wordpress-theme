<?php
    get_header();
?>

<ul class="breadcrumb">
  <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
  <?php global $post;
  if ( $post->post_parent ) { ?>
    <li><a href="<?php echo esc_url(get_permalink( $post->post_parent )); ?>" >
    <?php echo esc_html(get_the_title( $post->post_parent )); ?>
    </a></li>
<?php } ?>
  <li class="active"><?php the_title(); ?></li>
</ul>

<div class="single-post-page">
    <div class="container">
        <?php 
            if (have_posts()) { 
                while (have_posts()) { the_post();
                    get_template_part( 'templates/content-single-page');
                }
            }
            comments_template( '', true ); 
        ?>
        <div class="recent-posts slider-area">
            <h2 class="heading">Recent Posts</h2>
            <div class="owl-carousel owl-theme" id="owl-carousel-2">
            <?php
                $aladdin_args = array(
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => 1,
                );
                $aladdin_related_posts = new WP_Query( $aladdin_args );
                if ( $aladdin_related_posts->have_posts() ) {
                    while ( $aladdin_related_posts->have_posts() ) {$aladdin_related_posts->the_post();
                        get_template_part( 'templates/content-slider-post');
                    }
                }
            ?>
            </div>
        </div>
    </div>
</div>

<div class="back-top"><i class="fa fa-arrow-up"></i></div>

<?php
    get_footer();
?>