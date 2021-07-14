<!-- For all single Events -->

<?php get_header( ); ?>


<?php while(have_posts()): the_post() ?>

  <?php pageBanner(array(
    'title' => get_the_title(),
    'subtitle' => 'Keep up with our latest news.'
  ))?>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'event' );?>"><i class="fa fa-home" aria-hidden="true">          
        </i> Events Home</a> <span class="metabox__main"><?php the_title();?></span>
      </p>
    </div>

    <div class="generic-content"><?php the_content();?></div>
    
    <!-- Related Programs -->
    <?php $relatedPrograms = get_field('related_programs');?>
    <?php if( $relatedPrograms ): ?>
      <hr class="section-break">
      <h2 class="headline headline--medium">Related Program(s)</h2>
      <ul class="link-list min-list">
        <?php foreach( $relatedPrograms as $program ): ?>
          <li><a href="<?php echo get_the_permalink($program);?>"><?php echo get_the_title($program); ?></a></li>
        <?php endforeach; ?>
      </ul>
      
    <?php endif ?>      
  </div>

  <?php endwhile; ?>

<?php get_footer();?>