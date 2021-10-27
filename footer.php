
<div class="container-fluid mx-0 px-0">
  <div>
    <img class="img-fluid footer-background-image" src="<?php echo get_template_directory_uri() . '/images/footer-background.png';?>">
 </div>
  <!--=== Footer ===-->
  <footer class="text-center">
    <div class="container footer-container  pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mt-3">
            <?php 
           if(function_exists('the_custom_logo')){ //Page logo 
             $custom_logo_id = get_theme_mod('custom_logo');
             $custom_logo_alt =  get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
             $logo = wp_get_attachment_image_src($custom_logo_id);

             if($logo == true){
             echo "<div><img class='img-fluid img-footer-logo' id='logo' src=" . $logo[0] . " alt=" . $custom_logo_alt . " title='Logo'></div>";
             }
           }
          
            $name = get_bloginfo('name');
              if(!empty($name)) {
                echo "<p>" . $name . "</p>";
              }

            $description = get_bloginfo('description');
              if(!empty($description)) {
                echo "<p>" . $description . "</p>";
              }
            ?>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none hr-line" />

          <!--== Footer menu column ==-->
          <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Menu</h6>

            <?php
               wp_nav_menu(array(
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>

          </div>
          <!--== Footer menu column end ==-->

          <hr class="w-100 clearfix d-md-none hr-line" />

          <!-- Grid column Do przemyslenia co tu wsadzic-->
          <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Przydatne</h6>
            <p>
              <a class="white-custom-text">Your Account</a>
            </p>
            <p>
              <a class="white-custom-text">Become an Affiliate</a>
            </p>
            <p>
              <a class="white-custom-text">Shipping Rates</a>
            </p>
            <p>
              <a class="white-custom-text">Help</a>
            </p>
          </div>

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none hr-line" />

          <!--=== Contact column ===-->
          <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Kontakt</h6>
            <p><i class="fas fa-home mr-3"></i> Grabskiego 8<br>37-450 Stalowa Wola</p>
            <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
          </div>
          <!--=== Contact column end===-->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-3 hr-line">

      <!-- Section: Copyright -->
      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <!--=== Copyright ===-->
            <div>
             <p class="mb-0 copyright">Realizacja <a class="white-custom-text" href="https://rbcode.pl/" target="_blank" title="Strony internetowe i pozycjonowanie">Rbcode</a> 2021</p>
            </div>
            <!--=== Copyright ===-->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">

            <?php do_action( 'rbcode_social_icons' ); ?>

          </div>
          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>
  <!-- Footer -->
</div>
<!-- End of .container -->

<?php wp_footer(); ?>

</body>
</html>
