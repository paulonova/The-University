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