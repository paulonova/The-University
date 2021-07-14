<!-- For all single Events -->

<?php get_header( ); ?>

<?php while(have_posts()): the_post() ?>

<?php pageBanner();?>

    <div class="container container--narrow page-section">

      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'program' );?>"><i class="fa fa-home" aria-hidden="true">          
          </i> All Programs</a> <span class="metabox__main"><?php the_title();?></span>
        </p>
      </div>

      <div class="generic-content">
        <?php the_field('main_body_content');?>
      </div>  

      <?php $today = date('Ymd');?>

      <!-- *** Related Professors *** -->      

      <?php $relatedProfessors = new WP_Query( array(
      'posts_per_page' => -1,
      'post_type' => 'professor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(            
          array(                      // Filter to display related professors
          'key' => 'related_programs',
          'compare' => 'LIKE',        // or Contains..
          'value' => '"' . get_the_ID() . '"'
          )
      )
      ));?>
      <!-- 'value' => get_the_ID() is serialized in database and the IDs are in cotations "", thats why:  '"' . get_the_ID() . '"'  -->

      
      <?php if($relatedProfessors->have_posts()):?>
        <hr class="section-break">
        <h2 class="headline headline--medium"><?php echo get_the_title();?> Professors</h2>

        <ul class="professor-cards">
          <?php while($relatedProfessors->have_posts()): $relatedProfessors->the_post()?>
            <li class="professor-card__list-item"><a class="professor-card" href="<?php the_permalink();?>">
              <img src="<?php the_post_thumbnail_url('professorLandscape');?>" class="professor-card__image">
              <span class="professor-card__name"><?php the_title();?></span>
            </a></li>
          <?php endwhile; ?>
        </ul>
        
      <?php endif; ?>

      <?php 
      /**After looping through a separate query, this function restores the 
       * $post global to the current post in the main query.*/
      wp_reset_postdata();  
      ?>  

      <!-- *** Related Programs Here *** -->
      <?php $homepageEvents = new WP_Query( array(
      'posts_per_page' => 2,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(  
          array(                      // Filter to display only actual events
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
          ),
          array(                      // Filter to display related programs
          'key' => 'related_programs',
          'compare' => 'LIKE',        // or Contains..
          'value' => '"' . get_the_ID() . '"'
          )
      )
      ));?>
      <!-- 'value' => get_the_ID() is serialized in database and the IDs are in cotations "", thats why:  '"' . get_the_ID() . '"'  -->

      
      <?php if($homepageEvents->have_posts()):?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Upcoming <?php echo get_the_title();?> Events</h2>
        <br>
        <?php while($homepageEvents->have_posts()): $homepageEvents->the_post()?>
          <?php get_template_part( 'template-parts/content', 'event');?>
        <?php endwhile; ?>
      <?php endif; ?>
        
      <?php wp_reset_postdata();?>
      <?php $relatedCampuses= get_field('related_campus'); ?>

      <?php if($relatedCampuses):?>
        <hr class="section-break">
        <h2 class="headline headline--medium"><?php echo get_the_title();?> is available at these campuses:</h2>

        <ul class="min-list link-list">
          <?php foreach($relatedCampuses as $campus):?>
            <li><a href="<?php echo get_the_permalink($campus)?>"><?php echo get_the_title($campus)?></a></li>
          <?php endforeach;?>
        </ul>
        

      <?php endif;?>

      
    </div>

  <?php endwhile; ?>

<?php get_footer();?>