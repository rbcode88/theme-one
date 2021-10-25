<?php

function rbcode_register_styles() {

  $version = wp_get_theme()->get( 'Version' );

  wp_enqueue_style( 'rbcode-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(),'1.0', 'all' );
  wp_enqueue_style( 'rbcode-theme-style', get_template_directory_uri() . '/style.css', array( 'rbcode-bootstrap' ), $version, 'all' );
  wp_enqueue_style( 'rbcode-fontawasome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), '5.7.2', 'all' );

}
add_action( 'wp_enqueue_scripts', 'rbcode_register_styles' );

function rbcode_register_scripts() {

  $version = wp_get_theme()->get( 'Version' );

  wp_enqueue_script( 'rbcode-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '', true );
  wp_enqueue_script( 'rbcode-theme-script', get_template_directory_uri() . '/scripts.js', array('jquery'), '', true );
  wp_enqueue_script( 'rbcode-jquery-script', 'https://code.jquery.com/jquery-3.6.0.min.js', array('jquery'), '', false );

}
add_action( 'wp_enqueue_scripts', 'rbcode_register_scripts' );


function rbcode_theme_support(){
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo');
  add_post_type_support( 'nagrody', 'thumbnail' );
}

add_action('after_setup_theme', 'rbcode_theme_support');


function rbcode_nagrody() {
    register_post_type('nagrody',
        array(
            'labels'      => array(
                'name'          => __( 'Nagrody', 'nagrody' ),
                'singular_name' => __( 'Nagroda', 'nagrody' ),
                'add_new' => __( 'Dodaj' ),
                'add_new_item' => __( 'Dodaj nową nagrodę' )
                ),
            'taxonomies'  => array( 'Kategoria' ),
            'label' => 'Gallery',
            'supports' => array( 'title', 'excerpt' ),
            'register_meta_box_cb' => 'my_meta_box_cb',
            'query_var' => true,
            'public'  => true,
            'has_archive' => true,
            'show_ui' => true,
            'menu_icon' => 'dashicons-star-filled',
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'rewrite' => array(
            'slug'  => 'nagrody'
            )
        )
    );
}
add_action('init', 'rbcode_nagrody');

function rbcode_category() {
  register_taxonomy( 'Kategoria', 'nagrody', array(
      'label'        => __( 'Kategoria', 'nagrody' ),
      'rewrite'      => array( 'slug' => 'kategoria' ),
      'show_admin_column' => true,
      'hierarchical' => true,
  ) );
}
add_action( 'init', 'rbcode_category', 0 );

//galeria którą można dodać na produkcie
function my_meta_box_cb () {
  add_meta_box( 'nagrody' . '_details' , 'Galeria produktu', 'my_meta_box_details', 'nagrody', 'normal', 'high' );
}

function my_meta_box_details () {
  global $post;
  $post_ID = $post->ID; // global used by get_upload_iframe_src
  printf( "<iframe frameborder='0' src=' %s ' style='width: 100%%; height: 400px;'> </iframe>", get_upload_iframe_src('media') );
}

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');

//register another two menus
function rbcode_menus(){

  $location = array(
    'sideabar' => "Sidebar menu",
    'footer' => "Footer menu"
  );

  register_nav_menus($location);

}
add_action('init','rbcode_menus');


// Info bar above main menu
class Rbcode_TopBar {
  public static function register ( $wp_customize ) {
    $wp_customize->add_section('top-bar-info', 
    array(
         'title'      => __( 'Top info bar', 'theme-one' ),
         'priority'   => 30,
    ));

    $wp_customize->add_setting('rbcode_topbar_bgcolor',
                array(
                  'default' => apply_filters( 'rbcode_topbar_bgcolor', '#5b5b5b' ),
                  'sanitize_callback' => 'sanitize_hex_color', // this will return a color picker in Admin Dashboard
                  'type' => 'option', // Options are 'option' & 'theme_mod' default - theme_mod
                ));
    $wp_customize->add_setting( 'rbcode_topbar_textcolor', 
                array(
                  'default' => apply_filters( 'rbcode_topbar_textcolor', '#5b5b5b' ),
                  'sanitize_callback' => 'sanitize_hex_color',
                  'type' => 'option',
                ));
    $wp_customize->add_setting('rbcode_info_bar_phone', 
                array(
                  'default'        => '+48',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));
    $wp_customize->add_setting('rbcode_contact_email', 
                array(
                  'default'        => 'info@domain.com',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));
    $wp_customize->add_setting('rbcode_info_one', 
                array(
                  'default'        => '',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));
    $wp_customize->add_setting('rbcode_info_two', 
                array(
                  'default'        => '',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));
   $wp_customize->add_setting('rbcode_info_three', 
                array(
                  'default'        => '',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));

    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize, 'rbcode_topbar_bgcolor',
        array(
            'label'      => __( 'Kolor tła', 'theme-one' ),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_topbar_bgcolor',
             )));
    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'rbcode_topbar_textcolor',
        array(
            'label'      => __( 'Kolor czcionki', 'theme-one' ),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_topbar_textcolor',
            )));
    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize,'rbcode_info_bar_phone',
        array(
            'label'      => __('Telefon', 'theme-one'),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_info_bar_phone',
            'priority'   => 10,
            'type'       => 'text'
            ))); 
    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize,'rbcode_contact_mail',
        array(
            'label'      => __('E-mail', 'theme-one'),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_contact_mail',
            'priority'   => 10,
            'type'       => 'text'
            )));
    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize,'rbcode_info_one',
        array(
            'label'      => __('Tekst 1', 'theme-one'),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_info_one',
            'priority'   => 10,
            'type'       => 'text'
            )));
    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize,'rbcode_info_two',
        array(
            'label'      => __('Tekst 2', 'theme-one'),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_info_two',
            'priority'   => 10,
            'type'       => 'text'
           )));
    $wp_customize->add_control(
      new WP_Customize_Color_Control($wp_customize,'rbcode_info_three',
        array(
            'label'      => __('Tekst 3', 'theme-one'),
            'section'    => 'top-bar-info',
            'settings'   => 'rbcode_info_three',
            'priority'   => 10,
            'type'       => 'text'
            )));       
}


 public static function inject_css()
{
    $background = get_option('rbcode_topbar_bgcolor');
    $textcolor = get_option('rbcode_topbar_textcolor');
    ?><style>
        .top-bar-info{background:<?php echo $background;?>;}
        .top-bar-info .carousel-item, .top-bar-info .carousel-item a{color:<?php echo $textcolor;?>!important;}
    </style><?php  
}
public static function top_bar_html( $wp_customize ){  

    $phone = get_option('rbcode_info_bar_phone');
    $text_one = get_option('rbcode_info_one');
    $text_two = get_option('rbcode_info_two');
    $text_three = get_option('rbcode_info_three');
 
    if(!empty($phone) || !empty($text_one) || !empty($text_two) || !empty($text_three)) { ?>
        
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
    <?php 

      if(!empty($phone)) { ?>
        <div class="carousel-item active" data-bs-interval="5000">
          <img class="top-bar-icon" src="<?php echo get_template_directory_uri() . '/images/phone.png';?>"><a href="tel:+48<?php echo str_replace(' ','',$phone);?>" title="Kontakt"><?php echo $phone;?></a>
        </div>
      <?php } 
      if(!empty($text_one)) { ?>
        <div class="carousel-item" data-bs-interval="5000">
          <?php echo $text_one;?>
        </div>
      <?php } 
      if(!empty($text_two)) { ?>
        <div class="carousel-item" data-bs-interval="3000">
          <?php echo $text_two;?>
        </div>
      <?php } 
      if(!empty($text_three)) { ?>
        <div class="carousel-item" data-bs-interval="3000">
          <?php echo $text_three;?>
        </div>
      <?php } ?>

       </div>
     </div>
    <?php

    }
       
    }
}

add_action('customize_register' , array( 'Rbcode_TopBar' , 'register' ));
add_action('wp_head',array( 'Rbcode_TopBar' , 'inject_css' ));
add_action('rbcode_before_header', array( 'Rbcode_TopBar' , 'top_bar_html' ));


// Social icons 
class Rbcode_Social {
  public static function register_social ( $wp_customize ) {
    $wp_customize->add_section('social-icons', 
    array(
         'title'      => __( 'Social Media', 'theme-one' ),
         'priority'   => 30,
    ));

    $wp_customize->add_setting('rbcode_social_facebook',
                array(
                  'default'        => '',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));
    $wp_customize->add_setting( 'rbcode_social_instagram', 
                array(
                  'default'        => '',
                  'capability'     => 'edit_theme_options',
                  'type'           => 'option',
                ));

    $wp_customize->add_control(
      new WP_Customize_Control($wp_customize, 'rbcode_social_facebook',
        array(
            'label'      => __( 'Facebook page URL', 'theme-one' ),
            'section'    => 'social-icons',
            'settings'   => 'rbcode_social_facebook',
            'priority'   => 10,
            'type'       => 'text'
             )));
    $wp_customize->add_control( 
      new WP_Customize_Control( $wp_customize, 'rbcode_social_instagram',
        array(
            'label'      => __( 'Instagram page URL', 'theme-one' ),
            'section'    => 'social-icons',
            'settings'   => 'rbcode_social_instagram',
            'priority'   => 10,
            'type'       => 'text'
            )));      
  }

public static function rbcode_social_icons( $wp_customize ){  

  $facebook = get_option('rbcode_social_facebook');
  $instagram = get_option('rbcode_social_instagram');

  if(!empty($facebook)) { ?>
      
      <a href="<?php echo $facebook; ?>" class="social-link"><img class="img-fluid social-icon instagram" src="<?php echo get_template_directory_uri() . '/images/instagram.png';?>" alt="Facebook logo" target="_blank"></a>
    <?php
  }

  if(!empty($instagram)) { ?>
  <a href="<?php echo $instagram; ?>" class="social-link"><img class="img-fluid social-icon facebook" src="<?php echo get_template_directory_uri() . '/images/facebook.png';?>" alt="Instagram logo" target="_blank"></a>
  <?php
  }
}
}
add_action( 'customize_register' , array( 'Rbcode_Social' , 'register_social' ));
add_action('rbcode_social_icons', array( 'Rbcode_Social' , 'rbcode_social_icons' ));





function most_recent_book_title() {

  $args = array(
      'post_type' => 'Nagrody',
      'posts_per_page' => 1,
    );
    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) { ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post();

      $title = the_title();

      endwhile;

      wp_reset_query();
    }

  return $title;
}

 add_shortcode('recent-book', 'most_recent_book_title');

function last_five_genre_books($atts) {

$arg =  shortcode_atts( array(
          'id' => 1,
      ), $atts);

$termId = $arg['id'];

      $args = array(
          'orderby'=> 'name',
          'order' => 'ASC',
          'post_type' => 'Nagrody',
          'posts_per_page' => 5,
          'tax_query' => array(
           array (
             'taxonomy' => 'Genre',
             'field' => 'name',
             'terms' => $termId,
             )
           ),
      );

      $my_query = new WP_Query($args); ?>

      <ol>

      <?php if( $my_query->have_posts() ) {
          while ($my_query->have_posts()) : $my_query->the_post(); ?>

          <li><?php $message = the_title(); ?> </li>

      <?php endwhile;

       } ?>

       </ol>

       <?php wp_reset_query();

       return $message;

}

add_shortcode('genre-books', 'last_five_genre_books');


function number_posts_per_page( $query ) {

  global $wp_the_query;

  if ($query->is_archive() ) {
    $query->set( 'posts_per_page', 5 );
  }
  else {
    $query->set( 'posts_per_page', 9 );
  }

  return $query;
}
add_action( 'pre_get_posts',  'number_posts_per_page'  );

// function ajax_enqueue() {
//   wp_enqueue_script( 'ajax-script', plugins_url( '/assets/js/script.js', __FILE__ ), array('jquery') );
//   wp_localize_script( 'ajax-script', 'get_ajax_books', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
// }
// add_action( 'wp_enqueue_scripts', 'ajax_enqueue' );

// function ajax_posts() {
//     $args = array(
//         'post_type' => 'Bagrody',
//         'posts_per_page' => 20,
//     );

//     $ajaxposts = get_posts( $args );

//     $list = array();

//         foreach ( $ajaxposts as $post ) {

//            $terms = get_the_terms( $post , 'Genre' );

//            foreach ( $terms as $term ) {
//              $list[] = array(
//                'name'   => $post->post_title,
//                'date' => $post->post_date,
//                'genre' => $term->name,
//                'excerpt' =>$post->post_excerpt
//              );
//            }

//         }
//       echo json_encode( $list );

//     exit;
// }

// add_action('wp_ajax_ajax_posts', 'ajax_posts');
// add_action('wp_ajax_nopriv_ajax_posts', 'ajax_posts');