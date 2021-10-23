<!DOCTYPE html>
<html lang="pl">
  <head>

    <?php wp_head(); ?>

  </head>

<body <?php body_class(); ?>>

<div class="container-fluid mx-lg-0 px-0 ">

<!--=== Info Bar ===-->
<div class="sticky-top text-center top-bar-info">

  <?php do_action( 'rbcode_before_header' ); ?>
  
</div>

<nav class="navbar fixed-top navbar-expand-lg navbar-light stroke">
    <div class="container-fluid navigation">
        <a class="navbar-brand navbar-img-logo" href="<?php echo get_home_url(); ?>">

          <?php 
           if(function_exists('the_custom_logo')){
             $custom_logo_id = get_theme_mod('custom_logo');
             $custom_logo_alt =  get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
             $logo = wp_get_attachment_image_src($custom_logo_id);
           }
          
          ?>

        <img class="img-fluid img-logo" id="logo" src="<?php echo $logo[0]; ?>" alt="<?php echo $custom_logo_alt;?>">
      </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
          <div class="social-menu-section">
          <!--=== Social Icons ===-->
          <?php do_action( 'rbcode_social_icons' ); ?>
          </div>
        </div>


    </div>
</nav>
