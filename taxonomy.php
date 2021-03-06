<?php
get_header();
    // select category posts
    $term_slug = get_query_var( 'term' );
    $taxonomyName = get_query_var( 'taxonomy' );
    //create pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

       $args = array(
           'post_type' => 'Books',
           'posts_per_page' => 5,
           'paged' => $paged,
           'tax_query' => array(
            array (
                'taxonomy' => $taxonomyName,
                'field' => 'slug',
                'terms' => $term_slug,
              )
            ),
       );



       $loop = new WP_Query( $args );

       if ( $loop->have_posts() ) { ?>

<div class="container">
  <div class="row mx-0">

    <?php while ( $loop->have_posts() ) : $loop->the_post();  ?>

    <div class="col-md-4 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <div class="img-fluid featured-image"><?php the_post_thumbnail(); ?></div>
          <h2 class="card-title"><?php the_title();?></h2>
          <p class="card-text"><?php the_time('d-m-Y d:m:y'); ?></p>
          <a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>">Read More</a>
        </div>
      </div>
    </div>

  <?php endwhile; ?>
</div>
<div class="row mx-0">
  <div class="col-4 mx-auto text-center"> <?php

      $total_pages = $loop->max_num_pages;

      if ($total_pages > 1){

          $current_page = max(1, get_query_var('paged'));


          echo paginate_links(array(
              'base' => get_pagenum_link(1) . '%_%',
              'format' => 'page/%#%',
              'current' => $current_page,
              'total' => $total_pages,
              'prev_text'    => __('« prev'),
              'next_text'    => __('next »'),
          ));
      }

  ?>
  </div>
  </div>
</div>

<?php
        }



wp_reset_postdata();

get_footer();
?>
