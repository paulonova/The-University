<!-- GENERIC BLOG PAGE-->

<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => 'Welcome to our Blog!',
  'subtitle' => 'Keep up with our latest news.',
  'photo' => get_site_url() . '/wp-content/uploads/2021/07/blog-image-1500x350.jpg'
))?>


<div class="container container--narrow page-section">
  <?php while(have_posts()): the_post() ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

      <div class="metabox">
        <p>Posted by <?php the_author_posts_link( )?> on <?php the_time('y.n.j');?> in <?php echo get_the_category_list( ', ')?></p>
      </div>
      <div class="generic-content">
        <?php the_excerpt();?>
        <p><a class="btn btn--blue" href="<?php the_permalink();?>">Continue reading &raquo;</a></p>
      </div>
    </div>
  <?php endwhile ?>

  <!-- PAGINATION -->
  <?php echo paginate_links();?>
</div>

<?php get_footer(); ?>

