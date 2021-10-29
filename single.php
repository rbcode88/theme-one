<?php get_header();?>

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
    
    $media = get_attached_media( '' );
    print_r($media);

    echo wp_get_attachment_image_src($image->ID,'full')[0];
    ?>

<?php 
$images = get_attached_media('image', $post->ID);
foreach($images as $image) { ?>
    <img src="<?php echo wp_get_attachment_image_src($image->ID,'full'); ?>" />
<?php } ?>



  </div>
</div>

<?php get_footer();?>