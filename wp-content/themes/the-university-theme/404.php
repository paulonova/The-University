<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => '404',
  'subtitle' => 'Page not found!',
  'photo' => get_site_url() . '/wp-content/uploads/2021/07/image404-1500x350.jpg'
))?>

<div class="container container--narrow page-section">
    <h1 class="headline headline--large">404</h1>
    <h1 class="headline headline--large">This page was not found</h1>
    <br>
    <a class="btn btn--large btn--blue" href="<?php echo get_site_url();?>">Home Page</a>
</div>


<?php get_footer(); ?>
