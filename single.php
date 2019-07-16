<?php
    get_header();
?>

<ul class="breadcrumb">
  <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
  <li><?php $aladdin_categories = get_the_category(); if ( ! empty( $aladdin_categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $aladdin_categories[0]->term_id ) ) . '">' . esc_html( $aladdin_categories[0]->name ) . '</a>';} ?></li>
  <li class="active"><?php the_title(); ?></li>
</ul>

<div class="single-post-page">
    <div class="container-fluid">
        <div class="col-lg-9 col-md-8"> <!-- post content -->
        <?php 
            $aladdin_page_posts = array();
            if (have_posts()) { 
                while (have_posts()) { the_post();
                    $aladdin_page_posts[] = get_the_ID();
                    get_template_part( 'templates/content-single-post');
                }
            }
            comments_template( '', true );   
        ?>
        <div class="related-posts slider-area">
            <?php
                $aladdin_args = array(
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => 1,
                    'category__in' => wp_get_post_categories( $post->ID ), 
                    'post__not_in'  => $aladdin_page_posts
                );
                $aladdin_related_posts = new WP_Query( $aladdin_args );
                if ( $aladdin_related_posts->have_posts() ){
                    echo '<h2 class="heading">Related Posts</h2>';
                }
            ?>
            <div class="owl-carousel owl-theme" id="owl-carousel-2">
            <?php
                if ( $aladdin_related_posts->have_posts() ) {
                    while ( $aladdin_related_posts->have_posts() ) {$aladdin_related_posts->the_post();
                        $aladdin_page_posts[] = get_the_ID();
                        get_template_part( 'templates/content-slider-post');
                    }
                }
            ?>
            </div>
        </div>
        </div> <!--  -->
        <div class="col-lg-3 col-md-4">  <!-- Sidebar -->
            <div class="right-sidebar">
            <?php
                if ( is_active_sidebar( 'sidebar-right' )){
                    dynamic_sidebar('sidebar-right');
                }
            ?>
            <div class="side-post">
                    <?php
                        $aladdin_args = array(
                            'posts_per_page' => 5,
                            'ignore_sticky_posts' => 1,
                            'post__not_in'  => $aladdin_page_posts
                        );
                        $aladdin_side_posts = new WP_Query( $aladdin_args );
                        if ( $aladdin_side_posts->have_posts() ) {
                            echo '<h2 class="heading">Most Recent</h2>';
                            while ( $aladdin_side_posts->have_posts() ) {$aladdin_side_posts->the_post(); 
                                get_template_part( 'templates/content-side-post');
                            } 
                        } 
                    ?>
                </div><!-- side-post -->
                <?php 
                if (has_nav_menu( 'social-menui-sidebar' )){
                    echo '<div class="social-media">';
                    echo '<h2 class="heading">Follow Us</h2>';
                    wp_nav_menu( array( 
                        'theme_location'=>'social-menui-sidebar',
                        'depth'         => 1,
                    ));
                    echo '</div>';
                }  
                ?>
            </div><!-- sidebar -->
        </div><!-- col -->
    </div>
</div>

<div class="back-top"><i class="fa fa-arrow-up"></i></div>

<?php
    get_footer();
?>