<?php
// Separate file to create my own RestAPI Url
require get_theme_file_path( './includes/logins.php' );
require get_theme_file_path( './includes/search-rout.php' );
require get_theme_file_path( './includes/custom-rest.php' );
require get_theme_file_path( './includes/wp-links.php' );
require get_theme_file_path( './includes/map-key.php' );


function university_features(){
  register_nav_menu( 'headerMenuLocation', 'Header Menu Location' ); 
  
  add_theme_support('title-tag');  
  add_theme_support('post-thumbnails'); 

  add_image_size( 'professorLandscape', 400, 260, true );
  add_image_size( 'professorPortrait', 480, 650, true );
  add_image_size( 'pageBanner', 1500, 350, true );
}
add_action('after_setup_theme', 'university_features');


function university_adjust_queries($query){
    
  if(!is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query()){
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }

  if(!is_admin() && is_post_type_archive( 'campus' ) && $query->is_main_query()){    
    $query->set('posts_per_page', -1); //Show all campuses pin Marker 
  }

  if(!is_admin() && is_post_type_archive( 'program' ) && $query->is_main_query()){    
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');    
    $query->set('posts_per_page', -1);    
  }
}
add_action('pre_get_posts', 'university_adjust_queries'); ?>


<?php function pageBanner($args = NULL){ ?>

  <?php if(!$args['title']):?>
    <?php $args['title'] = get_the_title();?>
  <?php endif;?>

  <?php if(!$args['subtitle']):?>
    <?php $args['subtitle'] = get_field('page_banner_subtitle');?>
  <?php endif;?>

  <?php if(!$args['photo']):?>
    <?php if(get_field('page_banner_background_image') && !is_archive() && !is_home()):?>
      <?php $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];?>
    <?php else:?>
      <?php $args['photo'] = get_theme_file_uri('./images/ocean.jpg')?>
    <?php endif;?>
  <?php endif;?>


  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'];?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle'];?></p>
      </div>
    </div>  
  </div>

<?php } ?>

<?php 

//Force note posts to be private

function make_note_private($data, $postarr){

  //The subscriber will not be able to save any note with html injected.. 
  if($data['post_type'] == 'note'){

    if(count_user_posts(get_current_user_id(), 'note') > 4 && !$postarr['ID']){
      die('You have reached your note limit!');
    }

    // $data['post_content'] = sanitize_textarea_field( $data['post_content'] );
    // $data['post_title'] = sanitize_text_field( $data['post_title'] );
  }

  if($data['post_type'] == 'note' && $data['post_status'] != 'trash'){
    $data['post_status'] = 'private';
  }

    
  return $data;
}

add_filter('wp_insert_post_data', 'make_note_private', 10, 2); // 2 = two parameters and 10 = function order to be run..

