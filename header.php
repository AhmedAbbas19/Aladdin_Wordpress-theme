<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width" />  
<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { ?><title><?php wp_title( '|', true, 'right' ); ?></title><?php } ?>  
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>  
</head>

<body <?php body_class(); ?>>

<!-- Srart Header -->
<div class="header">
        <div class="container">
        <div class="col-sm-4">
            <div class="social-media">
                <?php wp_nav_menu( array( 
                    'theme_location'=>'social-menu',
                    'depth'         => 1,
                    )); 
                ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="site-logo text-center">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if($image[0]){
                    echo '<a href="'. esc_url( home_url() ) .'"><img src="'. esc_url($image[0]) .'" alt=""></a>';
                }
                ?>
                <h1><a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_url( bloginfo('name') ); ?></a></h1>
            </div>
        </div>
        <div class="col-sm-4">
        <form class="form-group searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" value="<?php echo esc_attr( get_search_query() );?>" name="s" class="form-control" placeholder="Hit enter to search" />
            <input type="submit" class="searchsubmit">
            <i class="fa fa-search"></i>
        </form>
        </div>
    </div>
</div>

<!-- Start Nav-bar -->
<nav class="navbar trans">
    <div class=container>
      <div class=navbar-header>
      
        <form class="form-group searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" value="<?php echo esc_attr( get_search_query() );?>" name="s" class="form-control" placeholder="Hit enter to search" />
            <input type="submit" class="searchsubmit">
            <i class="fa fa-search"></i>
        </form>

        <button type=button class="navbar-toggle collapsed" data-toggle=collapse data-target="#bs-example-navbar-collapse-1" aria-expanded=false>
          <span class=sr-only>Toggle navigation</span>
          <span class=icon-bar></span>
          <span class=icon-bar></span>
          <span class=icon-bar></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id=bs-example-navbar-collapse-1>
        <?php wp_nav_menu( array( 
            'theme_location'=>'navbar-menu',
            'menu_class'    => 'nav navbar-nav',
            'depth'         => 2,
            'walker'        => new wp_bootstrap_navwalker
            )); 
        ?>
      </div>
    </div>
  </nav>

    
