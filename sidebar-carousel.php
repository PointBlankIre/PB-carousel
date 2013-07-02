<!--   carousel section -->
<div id="myCarousel" class="carousel slide">

<!-- Carousel items -->
                  <div class="carousel-inner">
                  	
                <?php 

                  $c = 0;
                  $class = "item active";
                  $mypost = array( 'post_type' => 'pb_carousel' );
                  $loop = new WP_Query( $mypost ); 

                ?>
                	      
                <!-- Cycle through all posts -->

                <?php 

                  while ( $loop->have_posts() ) : $loop->the_post(); 
                    
                    if ( $c > 0 ) $class = "item";	
                    
                ?>
                                <div class="<?php echo $class?>">
                                  <a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'url_carousel', true ) ); ?>" title="<?php the_title(); ?>">
                                   	<?php the_post_thumbnail(); ?>
                                  </a>
                                  <div class="carousel-caption">
                                    <h4><?php the_title(); ?></h4>
                                    <p><?php echo esc_html( get_post_meta( get_the_ID(), 'desc_carousel', true ) ); ?></p>
                                  </div>
                                </div> 
                   	    
                <?php 

                    $c++; 
                  endwhile;

                  wp_reset_query(); 
                ?>
                  </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>

  
</div>

<!--   endo of carousel section -->