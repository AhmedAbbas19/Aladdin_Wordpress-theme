<?php

// bootstrap menu navwalker
require_once('wp-bootstrap-navwalker.php');

/**
 *  theme basic setup.
 *  
*/
function aladdin_setup() {
	// Adds RSS feed links to <head> for posts and comments.  
	add_theme_support( 'automatic-feed-links' );
	// This theme supports custom background color and image.
	$defaults = array(
	'default-color' => '', 
    'default-image' => '',
	'wp-head-callback' => '_custom_background_cb',
	'admin-head-callback' => '',
	'admin-preview-callback' => '' );  
    add_theme_support( 'custom-background', $defaults );
	// This theme supports post thumbnails.
    add_theme_support( 'post-thumbnails' );
    // This theme supports site custom logo.
    add_theme_support( 'custom-logo' );
    // This theme supports a custom header image.
    $args = array(
	'width' => 1800,
	'height' => 400,
    'flex-width' => true,
    'flex-height' => true,
    'header-text' => false,
    'random-default' => true,);
    add_theme_support( 'custom-header', $args );
    // This theme supports the Title Tag feature.
    add_theme_support( 'title-tag' );
    global $content_width;
    if ( ! isset( $content_width ) ) { $content_width = 1130; }
}
add_action( 'after_setup_theme', 'aladdin_setup' );

function aladdin_add_styles(){
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.min.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Merienda|Lato|Poppins:600|Poppins|Roboto|Monoton');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('aladdin-custom-color', get_template_directory_uri() . '/css/custom-color.scss');
}
function aladdin_add_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array(),false,true);
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.js',array(),false,true);
    wp_enqueue_script('aladdin-main-js', get_template_directory_uri() . '/js/main.js',array(),false,true);
    wp_enqueue_script('aladdin-html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js');
    wp_script_add_data('aladdin-html5shiv','conditional','lt IE 9');
    wp_enqueue_script('aladdin-respond', get_template_directory_uri() . '/js/respond.min.js');
    wp_script_add_data('aladdin-respond','conditional','lt IE 9');

    global $wp_query; 
	wp_register_script( 'aladdin_my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );
    wp_localize_script( 'aladdin_my_loadmore', 'aladdin_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
     wp_enqueue_script( 'aladdin_my_loadmore' );
     
     if ( is_singular() ) wp_enqueue_script( "comment-reply" );
    
}
add_action('wp_enqueue_scripts','aladdin_add_styles');
add_action('wp_enqueue_scripts','aladdin_add_scripts');

/**
 * Backwards compatibility for older WordPress versions which do not support the Title Tag feature.
 *  
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function aladdin_wp_title( $title, $sep ) {
        if ( is_feed() )
            return $title;
        $title .= get_bloginfo( 'name' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";
        return $title;
    }
    add_filter( 'wp_title', 'aladdin_wp_title', 10, 2 );
}

/**
 * Register our menu.
 *
 */
function aladdin_register_menus() {
    register_nav_menu( 'navbar-menu', __( 'Navbar Menu', 'aladdin' ) );
    register_nav_menu( 'social-menu', __( 'Header Social Media Icons', 'aladdin' ) );
    register_nav_menu( 'social-menui-sidebar', __( 'Sidebar Social Media Icons', 'aladdin' ) );
}
add_action( 'after_setup_theme', 'aladdin_register_menus' );


/**
*  Loadmore posts button script
*/
function aladdin_loadmore_ajax_handler(){
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	query_posts( $args );
	if( have_posts() ) :
		while( have_posts() ): the_post();
			get_template_part( 'templates/content-regular-post'); 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'aladdin_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'aladdin_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


/**
 * Register our sidebars and widgets.
 *
*/
function aladdin_widgets_init() {
    register_sidebar( array(
          'name' => __( 'Right Sidebar', 'aladdin' ),
          'id' => 'sidebar-right',
          'description' => __( 'Right sidebar which appears on all posts and pages.', 'aladdin' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => '</div><hr>',
          'before_title' => ' <h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
    register_sidebar( array(
          'name' => __( 'Footer left widget area', 'aladdin' ),
          'id' => 'sidebar-l',
          'description' => __( 'Left column with widgets in footer.', 'aladdin' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => '</div><hr>',
          'before_title' => ' <h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
    register_sidebar( array(
          'name' => __( 'Footer middle widget area', 'aladdin' ),
          'id' => 'sidebar-m',
          'description' => __( 'Middle column with widgets in footer.', 'aladdin' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => '</div><hr>',
          'before_title' => ' <h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
    register_sidebar( array(
          'name' => __( 'Footer right widget area', 'aladdin' ),
          'id' => 'sidebar-r',
          'description' => __( 'Right column with widgets in footer.', 'aladdin' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => '</div><hr>',
          'before_title' => ' <h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
    register_sidebar( array(
          'name' => __( 'Footer notices', 'aladdin' ),
          'id' => 'sidebar-notice',
          'description' => __( 'The line for copyright and other notices below the footer widget areas. Insert here one Text widget. The "Title" field at this widget should stay empty.', 'aladdin' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => '</div>',
          'before_title' => ' <h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
  }
  add_action( 'widgets_init', 'aladdin_widgets_init' );
  

/**
 * Template for comments and pingbacks.
 *
*/
  if ( ! function_exists( 'aladdin_comment' ) ) :
    function aladdin_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'aladdin' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'aladdin' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment single-comment">
                <div class="comment-meta comment-author vcard">
                    <?php
                        echo get_avatar( $comment, 44 );
                        printf( '<span><b class="fn">%1$s</b> %2$s</span>',
                            get_comment_author_link(),
                            ( $comment->user_id === $post->post_author ) ? '<span class="auth">' . __( '(Author)', 'aladdin' ) . '</span>' : ''
                        );
                        printf( '<time datetime="%2$s">%3$s</time>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            // translators: 1: date, 2: time
                            sprintf( __( '%1$s at %2$s', 'aladdin' ), get_comment_date(''), get_comment_time() )
                        );
                    ?>
                </div><!-- .comment-meta -->
    
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aladdin' ); ?></p>
                <?php endif; ?>
    
                <div class="comment-content comment">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->    
                 <div class="reply">
                   <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i>', 'aladdin' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
                   <?php edit_comment_link( __( 'Edit', 'aladdin' ), '<p class="edit-link">', '</p>' ); ?>
            </div><!-- #comment-## -->
        <?php
            break;
        endswitch;
    }
    endif;

    /**
     * Share post buttons
     */

    function aladdin_social_sharing_buttons($content) {
        global $post;
        if(is_singular() || is_home()){
        
            // Get current page URL 
            $aladdinURL = urlencode(get_permalink());
            // Get current page title
            $aladdinTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
            // $aladdinTitle = str_replace( ' ', '%20', get_the_title());
            // Get Post Thumbnail for pinterest
            $aladdinThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
     
            // Construct sharing URL without using any script
            $twitterURL = 'https://twitter.com/intent/tweet?text='.$aladdinTitle.'&amp;url='.$aladdinURL.'&amp;via=aladdin';
            $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$aladdinURL;
            $googleURL = 'https://plus.google.com/share?url='.$aladdinURL;
            $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$aladdinURL.'&amp;title='.$aladdinTitle;
            
            // Add sharing button at the end of page/page content
            $content .= '<div class="aladdin-social">';
            $content .= '<h5>SHARE ON</h5> <a class="aladdin-link aladdin-twitter" href="'. $twitterURL .'" target="_blank"><i class="fab fa-twitter"></i></a>';
            $content .= '<a class="aladdin-link aladdin-facebook" href="'.$facebookURL.'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
            $content .= '<a class="aladdin-link aladdin-googleplus" href="'.$googleURL.'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
            $content .= '<a class="aladdin-link aladdin-linkedin" href="'.$linkedInURL.'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
            $content .= '</div>';
            
            return $content;
        }else{
            // if not a post/page then don't include sharing button
            return $content;
        }
    };
    add_filter( 'the_content', 'aladdin_social_sharing_buttons');
    

/**
* Post excerpt settings.
*
*/
function aladdin_custom_excerpt_length( $length ) { 
    return 35;
}
add_filter( 'excerpt_length', 'aladdin_custom_excerpt_length', 20 );

function aladdin_new_excerpt_more( $more ) {
    global $post;
    return '...';
}
add_filter( 'excerpt_more', 'aladdin_new_excerpt_more' ); 


/**
*   Counts Author Comments
*/
function aladdin_count_user_comments($aladdin_user_email) {
    global $wpdb;
    $count = $wpdb->get_var(
    'SELECT COUNT(comment_ID) FROM ' . $wpdb->comments. ' 
    WHERE comment_author_email = "' . $aladdin_user_email . '" 
    AND comment_approved = "1" 
    AND comment_type IN ("comment", "")'
    );
    return $count;
}


/**
*  Add Customization Settings
*/ 
function aladdin_customizer( $wp_customize ) {
	$wp_customize->add_setting( 'aladdin-main-color',
        array(
            'default'    => '#00aced',
            'transport'  => 'refresh',
            'sanitize_callback' => 'esc_attr',
        )
    );
    
    $wp_customize->add_section('aladdin-standard-color',
        array(
            'title' => __('Standard Colors', 'aladdin'),
            'priority'  => 30
        )
    );    

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aladdin-main-color-control',
        array(
            'label' => __('Main Color', 'aladdin'),
            'section'   => 'aladdin-standard-color',
            'settings'   => 'aladdin-main-color'
        )
    ));
}
add_action( 'customize_register', 'aladdin_customizer' );

/**
 * Output Customize Css
 */
function aladdin_customize_css(){?>
    <style type="text/css">
        .breadcrumb .active, .breadcrumb .active,
        a:hover, .view-post-btn:hover, .aladdin_loadmore:hover,
        .comments-area .single-comment .fn, .comments-area .single-comment .reply,
        .comments-area .single-comment .edit-link, .grid-pagination .next-posts-link:hover,
        .grid-pagination .prev-posts-link:hover, .post-pagination a:hover,
        .notfound .home-btn:hover, .author-profile .author-name, .author-profile .author-email,
        .author-profile .author-url, .author-profile .auth-posts-count,
        .author-profile .auth-comments-count{
            color: <?php echo get_theme_mod('aladdin-main-color'); ?> ;
        }

        .aladdin_loadmore,.heading::after,
        .view-post-btn, .dropdown-menu::before,
        .news-area .lead-post .post-cat, .side-post .post-cat a,
        .main-area .regular-post .post-cat, .back-top,
        .widget-content .widget-title::after, #wp-calendar tbody #today,
        .comments-area .comment-respond .submit, .grid-post .post-cat, .grid-pagination .prev-posts-link,
        .grid-pagination .next-posts-link, .post-pagination a, .grid-pagination .next-posts-link:hover,
        .grid-pagination .prev-posts-link:hover, .post-pagination a:hover, .notfound .home-btn{
            background-color: <?php echo get_theme_mod('aladdin-main-color'); ?> ;
        }

        .view-post-btn, .aladdin_loadmore, .aladdin_loadmore:hover,
        .notfound .home-btn:hover{
            border-color: <?php echo get_theme_mod('aladdin-main-color'); ?> ;
        }

        .dropdown-menu{
            border-color: <?php echo get_theme_mod('aladdin-main-color'); ?> ;
        }
    </style>
<?php }
add_action('wp_head','aladdin_customize_css');
?>