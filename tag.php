<?php
    get_header();
?>

<ul class="breadcrumb">
  <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
  <li class="active"><?php echo 'Tag: '; single_tag_title(); ?></li>
</ul>

<div class="grid-area">
    <div class="container-fluid">
            <div class="grid-area-info">
                    <h2 class="heading"><?php single_tag_title(); ?></h2>
            </div>

        <div class="col-lg-9 col-md-8">
        <?php 
            $aladdin_page_posts = array();
            if (have_posts()) {
                while (have_posts()) { the_post();
                    $aladdin_page_posts[] = get_the_ID();
                    get_template_part( 'templates/content-category');
                }
                echo '<div class="grid-pagination">' ;
                        if(get_previous_posts_link()){ echo '<div class="prev-posts-link">'; previous_posts_link('<i class="fas fa-long-arrow-alt-left"></i>'); echo '</div>'; }
                        if(get_next_posts_link()){ echo '<div class="next-posts-link">'; next_posts_link('<i class="fas fa-long-arrow-alt-right"></i>'); echo '</div>' ; }
                echo  '</div>';
            }
        ?>
        </div>
        <div class="col-lg-3 col-md-4">
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
        </div>
    </div>
</div>

<div class="back-top"><i class="fa fa-arrow-up"></i></div>

<?php
    get_footer();
?>