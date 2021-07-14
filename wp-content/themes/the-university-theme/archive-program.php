<!-- Generic page for Authors, Categories.. -->

<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone! Have a look around!',
  'photo' => get_site_url() . '/wp-content/uploads/2021/07/programs-1500x350.jpg'
))?>




<div class="container container--narrow page-section">
  <ul class="link-list min-list">
    <?php while(have_posts()): the_post(); ?>  
      <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
    <?php endwhile ?>
  </ul>  

  <!-- PAGINATION -->
  <?php echo paginate_links();?>

</div>

<?php get_footer(); ?>

