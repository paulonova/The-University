<!-- For all single Events -->

<?php get_header( ); ?>

<?php while(have_posts()): the_post() ?>

<?php pageBanner();?>

    <div class="container container--narrow page-section">

      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'campus' );?>"><i class="fa fa-home" aria-hidden="true">          
          </i> All Campuses</a> <span class="metabox__main"><?php the_title();?></span>
        </p>
      </div>

      <div class="generic-content">
      <?php the_content();?>

        <!-- Google Map-->
        <div class="acf-map">

            <?php $mapLocation = get_field('map_location');?>             
            <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng']?>">
                <h5><?php the_title();?></h5>
                <?php echo 'Somewhere out there' .  $mapLocation['address'];?>
            </div>
        </div>    
        
      </div>  
      
      <!-- *** Related Programs *** -->      

      <?php $relatedPrograms = new WP_Query( array(
      'posts_per_page' => -1,
      'post_type' => 'program',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(            
          array(                      // Filter to display related professors
          'key' => 'related_campus',
          'compare' => 'LIKE',        // or Contains..
          'value' => '"' . get_the_ID() . '"'
          )
      )
      ));?>
      <!-- 'value' => get_the_ID() is serialized in database and the IDs are in cotations "", thats why:  '"' . get_the_ID() . '"'  -->

      
      <?php if($relatedPrograms->have_posts()):?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Programs available in this Campus</h2>

        <ul class="min-list link-list">
          <?php while($relatedPrograms->have_posts()): $relatedPrograms->the_post()?>
            <li>
              <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </li>
          <?php endwhile; ?>
        </ul>
        
      <?php endif; ?>

      <?php 
      /**After looping through a separate query, this function restores the 
       * $post global to the current post in the main query.*/
      wp_reset_postdata();?>  

    </div>

  <?php endwhile; ?>

<?php get_footer();?>