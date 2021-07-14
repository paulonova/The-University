<?php 

//Runs CSS or Javascript
function university_files(){
    // wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('custom-google-fonts', "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
    // wp_enqueue_style('university_main-Styles', get_stylesheet_uri());
    wp_enqueue_style('fontawesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"); 
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB_aanU78dFOqS7J6vCLzgqEGmniEXL5eY', NULL, '1.0', true);  
    
    wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    
    
    if(strstr($_SERVER['SERVER_NAME'], '/university')) {
      //wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    }else{
      // wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/vendors~scripts.1fa169383e64a33bfd0c.js'), NULL, '1.0', true);
      // wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.93410b58bd3dfcaa5b29.js'), NULL, '1.0', true);
      // wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.93410b58bd3dfcaa5b29.css')); 
    }

    //Allow the root url to use in search.js as a dinamic url
    wp_localize_script('main-university-js', 'universityData',  array(
      'root_url' => get_site_url(),
    ));
    
  }
  add_action('wp_enqueue_scripts', 'university_files');