<?php get_header();?>

<div class="row m-0">

<?php if (has_post_thumbnail( $post->ID ) ): ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
  <div class="col-12 mx-auto p-0 page-featured-image"><img class="img-fluid mx-auto" src="<?php echo $image[0]; ?>"></div>
  <?php endif; ?>
  
    <div class="col-12 single-page-content mx-auto p-0 ">
      <div class="row m-0">
        <div class="col-10 mx-auto p-0"> 
          
        <?php the_content(); ?>

      </div>
    </div>
 </div>
</div>


<?php get_footer();?>
