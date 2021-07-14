<!-- SEARCH RESULT PAGE-->

<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => 'Search Rsults',
  'subtitle' => 'You searched for &ldquo; ' . esc_html(get_search_query(false)) . ' &ldquo;',
  'photo' => get_site_url() . '/wp-content/uploads/2021/07/search-image-1500x350.jpg'
))?>


<div class="container container--narrow page-section">
  <?php if(have_posts()):?>
    <?php while(have_posts()): the_post() ?>
      <?php get_template_part('template-parts/content', get_post_type()); // Create a dinamic template_parts using /content/post-type?>  
    <?php endwhile ?>
    <!-- PAGINATION -->
    <?php echo paginate_links();?>

  <?php else:?>
    <h2 class="headline headline--small-plus">No result match that search..</h2>
  <?php endif;?>
  
  <?php get_search_form();?>
  
</div>

<?php get_footer(); ?>

