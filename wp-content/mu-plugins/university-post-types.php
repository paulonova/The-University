<?php


function university_post_types(){

  /** Post type Caampus */
  register_post_type('campus', array(
    'capability_type' => 'campus',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array(
      'slug' => 'campuses'
    ),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true, 
    'labels' => array(
      'name' => 'Campuses',
      'add_new_item' => 'Add New Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus'
    ),
    'menu_icon' => 'dashicons-location-alt'
  ));

  /** Post type Event */
  register_post_type('event', array(
    'capability_type' => 'event',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array(
      'slug' => 'events'
    ),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));


  /** Post type Program */
  register_post_type('program', array(
    'capability_type' => 'program',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor'),
    'rewrite' => array(
      'slug' => 'programs'
    ),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
    'menu_icon' => 'dashicons-awards'
  ));


  /** Post type Professors */
  register_post_type('professor', array(
    'capability_type' => 'professor',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'show_in_rest' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));

  /** Post type Notes */
  register_post_type('note', array(
    'capability_type' => 'note', // open to a new permission
    'map_meta_cap' => true, //inforce and require the permission in right time and place.    
    'show_in_rest' => true, // this has couse some problems to register the Note in the editor, don´t know why???
    'supports' => array('title', 'editor'),
    'has_archive' => true,
    'public' => false,
    'show_ui' => true, //needs to be shown in editor
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));


  /** Post type Like */
  register_post_type('like', array(
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true, //needs to be shown in editor
    'labels' => array(
      'name' => 'Likes',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
    ),
    'menu_icon' => 'dashicons-heart'
  ));

}

add_action('init', 'university_post_types');

?>