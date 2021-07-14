<?php 

/**
 * Function to modify the restAPI and add a new field in
 * http://localhost/university/wp-json/wp/v2/posts
 */

    function university_custom_rest(){
      register_rest_field( 'post', 'authorName', array(
          'get_callback' => function(){ return get_the_author();} 
      ));
  
      register_rest_field( 'post', 'hobies', array(
          'get_callback' => function(){ return array(
          'robby' => 'Guitar',
          'food' => 'Churrasco' 
          );} 
      ));
    }
    add_action('rest_api_init', 'university_custom_rest');