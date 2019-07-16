<?php
    get_header();
    global $wp_query;
?>

<!-- Header Slider -->
<div class="slider-area">
    <div class="owl-carousel owl-theme" id="owl-carousel-1">
        <?php
            if ( have_posts() ) {
                while ( have_posts() ) {the_post(); 
                    get_template_part( 'templates/content-slider-post');
                } 
            }
        ?>
    </div>
</div>

<!-- News Area -->
<div class="news-area">
    <div class="container-fluid">
            <div class="row">
            <div class="col-md-8 col-sm-7">
                <?php
                $aladdin_args = array(
                        'posts_per_page' => 1,
                        'orderby'    => 'comment_count',
                        'ignore_sticky_posts' => 1
                );
                $aladdin_lead_post_id = array();
                $aladdin_lead_post = new WP_Query( $aladdin_args );
                if ( $aladdin_lead_post->have_posts() ) {
                        while ( $aladdin_lead_post->have_posts() ) {$aladdin_lead_post->the_post();
                            $aladdin_lead_post_id[] = get_the_ID(); 
                            get_template_part( 'templates/content-lead-post');
                        } 
                    } 
                ?>
            </div>
            <div class="col-md-4 col-sm-5">
                <div class="side-post">
                    <?php
                        $aladdin_args = array(
                            'posts_per_page' => 5,
                            'orderby'    => 'comment_count',
                            'ignore_sticky_posts' => 1,
                            'post__not_in'  => $aladdin_lead_post_id
                        );
                        $aladdin_side_posts = new WP_Query( $aladdin_args );
                        if ( $aladdin_side_posts->have_posts() ) {
                            echo '<h2 class="heading">Trending</h2>';
                            while ( $aladdin_side_posts->have_posts() ) {$aladdin_side_posts->the_post(); 
                                get_template_part( 'templates/content-side-post');
                            } 
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Area -->
<div class="main-area">
    <div class="container-fluid">
        <div class="row">
            <?php
                if ( have_posts() ) {
                    echo '<h2 class="heading">Latest</h2>';
                    while ( have_posts() ) {the_post(); 
                        get_template_part( 'templates/content-regular-post');
                    } 
                }
            ?>
        </div>
            <?php
                if (  $wp_query->max_num_pages > 1 ){
                    echo '<div class="aladdin_loadmore">More posts</div>';
                }
            ?>
    </div>
</div>

<div class="back-top"><i class="fa fa-arrow-up"></i></div>

<?php
    get_footer();
?>