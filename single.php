<?php

get_header();

?>
<div class="container">
<div class="row m-0">
  <div class="col-8 mx-auto">
    <div class="img-fluid featured-image"><?php the_post_thumbnail(); ?></div>
    <span><?php the_time('d-m-Y d:m:y'); ?></span>
    <?php
    $terms = get_the_terms( $post->ID , 'Kategoria' );
    foreach ( $terms as $term ) {
      echo "<span style='margin-right:5px;'>";
      echo $term->name;
      echo "</span>";
    }

    ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>



    <!-- custom post type wywołanie ustawionej wartości-->
    <?php if(get_field('wymiary')) : ?> <h2> <?php the_field('wymiary'); ?> </h2> <?php endif; 
    
    var_dump( get_attached_media( 'image' ));
    ?>


  </div>
</div>

<?php

get_footer();
?>