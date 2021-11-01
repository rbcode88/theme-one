<?php get_header(); ?>

<div class="container-fluid p-0 hero-image">
    <div class="row m-0">
    <!-- order-md-first order-last  order-md-last order-first-->
        <div class="col-lg-5 col-md-6 p-0 ">
            <div class="hero d-flex justify-content-center flex-column hero-large-window" data-aos="zoom-out">
                <a href="<?php echo get_site_url()."/trofea-personalizowane"; ?>">
                        <h2 class="window-text-center">TROFEA<br> PERSONALIZOWANE</h2>
                        <div class="window-button-center"><button type="button" class="btn btn-custom">Zobacz więcej
                            <div class="button__horizontal"></div>
	                        <div class="button__vertical"></div>
                        </button></div>
                        <div class="image-nav image-1"></div>
                    </a>
              
                <!-- <a href="#" title="..." class="hero__btn">
                    <i class="fas fa-chevron-down"></i>
                </a> -->
            </div>
        </div>
        <div class="col-lg-7 col-md-6 p-0 ">
            <div class="row m-0 hero-part-two">
                <div class="col-lg-6 col-md-12 col-6 p-0 hero-small-window" data-aos="zoom-out" data-aos-delay="100">
                    <a href="<?php echo get_site_url()."/dyplomy-drewniane"; ?>">
                        <h2 class="window-text-center">DYPLOMY</h2>
                        <div class="window-button-center"><button type="button" class="btn btn-custom">Zobacz więcej
                            <div class="button__horizontal"></div>
	                        <div class="button__vertical"></div>
                        </button></div>
                        <div class="image-nav image-1"></div>
                    </a>
                </div>

                <div class=" col-lg-6 col-md-12 col-6 p-0 hero-small-window" data-aos="zoom-out" data-aos-delay="200">
                    <a href="<?php echo get_site_url()."/statuetki-szklane"; ?>">
                        <h2 class="window-text-center">SZKŁA</h2>
                        <div class="window-button-center"><button type="button" class="btn btn-custom">Zobacz więcej
                            <div class="button__horizontal"></div>
	                        <div class="button__vertical"></div>
                        </button></div>
                        <div class="image-nav image-2"></div>
                    </a>
                </div>
                
                
                <div class=" col-lg-6 col-md-12 col-6 p-0 hero-small-window" data-aos="zoom-out" data-aos-delay="300">
                    <a href="<?php echo get_site_url()."/trofea-z-pleksy"; ?>">
                        <h2 class="window-text-center">TROFEA Z PLEKSY</h2>
                        <div class="window-button-center"><button type="button" class="btn btn-custom">Zobacz więcej
                            <div class="button__horizontal"></div>
	                        <div class="button__vertical"></div>
                        </button></div>
                        <div class="image-nav image-3"></div>
                    </a>
                </div>

                <div class=" col-lg-6 col-md-12 col-6 p-0 hero-small-window" data-aos="zoom-out" data-aos-delay="400">
                    <a href="<?php echo get_site_url()."/v-line-custom"; ?>">
                        <h2 class="window-text-center">V-LINE CUSTOM</h2>
                        <div class="window-button-center"><button type="button" class="btn btn-custom">Zobacz więcej
                            <div class="button__horizontal"></div>
	                        <div class="button__vertical"></div>
                        </button></div>
                        <div class="image-nav image-4"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container p-0 " style="height:700px;">



    <?php the_content(); ?>
</div>
<?php get_footer(); ?>