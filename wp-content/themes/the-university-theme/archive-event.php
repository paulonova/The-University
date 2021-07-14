<!-- Generic page for Authors, Categories.. -->

<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'Se what is going on in our world!',
  'photo' => get_site_url() . '/wp-content/uploads/2021/07/events-1500x350.jpg'
))?>

<div class="container container--narrow page-section">

  <?php while(have_posts()): the_post() ?>  
    <?php get_template_part( 'template-parts/content', 'event');?>
  <?php endwhile ?>

  <!-- PAGINATION -->
  <?php echo paginate_links();?>


  <hr class="section-break">
  <div class="event-summary__past-event-align">
    <p>Looking for a recap of past events? &nbsp;</p>
    <a class="btn btn--blue" href="<?php echo site_url( '/past-events' ) ?>"> Past Events Archive</a>
  </div>
  
</div>

<?php get_footer(); ?>

