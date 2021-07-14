<!-- Generic page for Authors, Categories.. -->

<?php get_header( ); ?>

<?php pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have several conveniently located campuses.'
))?>


<div class="container container--narrow page-section">

  <div class="acf-map">
    <?php while(have_posts()): the_post(); ?> 
    <?php $mapLocation = get_field('map_location');?> 
    
      <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng']?>">
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <?php $mapLocation['address'];?>
      </div>      
    <?php endwhile ?>      
  </div> 

  <?php while(have_posts()): the_post(); ?> 
    <ul class="min-list link-list">
      <li>Campus: <a href="<?php the_permalink();?>"><?php the_title();?></a></li>
    </ul>
  <?php endwhile ?>    

</div>

<?php get_footer(); ?>
