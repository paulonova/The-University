<!-- For all single Events -->

<?php get_header( ); ?>

<?php while(have_posts()): the_post() ?>

<?php pageBanner();?>

    <div class="container container--narrow page-section">


      <div class="generic-content">
        <?php //the_post_thumbnail(); the_content();?>
        <div class="row group">

          <div class="one-third">
            <?php the_post_thumbnail('professorPortrait');?>
          </div>

          <div class="two-third">
            <?php $likeCount = new WP_Query(array(
              'post_type' => 'like',
              'meta_query' => array(
                array(
                  'key' => 'liked_professor_id',
                  'compare' => '=',
                  'value' => get_the_ID()
                )
              )
            ))?>

            <?php $existStatus = 'no'; ?>

            <?php if(is_user_logged_in()){
              $existQuery = new WP_Query(array(
                'author' => get_current_user_id(),
                'post_type' => 'like',
                'meta_query' => array(
                  array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => get_the_ID()
                  )
                )
              )); 
            
              if($existQuery->found_posts){
                $existStatus = 'yes';
              }
            } ?>                             

            <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">  
              <i class="fa fa-heart-o" aria-hidden="true"></i>
              <i class="fa fa-heart" aria-hidden="true"></i>
              <span class="like-count"><?php echo $likeCount->found_posts;?></span>
            </span>
          <?php the_content();?>         
          </div>
        </div>
      </div>
      
      <!-- Related Programs -->
      <?php $relatedPrograms = get_field('related_programs');?>

      <?php if( $relatedPrograms ): ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Subjects(s)</h2>
        <ul class="link-list min-list">
          <?php foreach( $relatedPrograms as $program ): ?>
            <li><a href="<?php echo get_the_permalink($program);?>"><?php echo get_the_title($program); ?></a></li>
          <?php endforeach; ?>
        </ul>
        
      <?php endif ?>      
    </div>

  <?php endwhile; ?>

<?php get_footer();?>