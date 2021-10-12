<?php

get_header();

?>
<div class="container">
<div class="row m-0">
  <div class="col-8 mx-auto">
    <div class="img-fluid featured-image"><?php the_post_thumbnail(); ?></div>
    <span><?php the_time('d-m-Y d:m:y'); ?></span>
    <?php
    $terms = get_the_terms( $post->ID , 'Genre' );
    foreach ( $terms as $term ) {
      echo "<span style='margin-right:5px;'>";
      echo $term->name;
      echo "</span>";
    }

    ?>
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(); ?></p>
  </div>
</div>
</div>

<?php

get_footer();
