<?php

/*
  Plugin Name: Paying Attention Quiz
  Description: Give your readers a multiple choice question
  Version: 1.0
  Author: Paulo
  Author URI: https://www.paulonova.one
*/


if(!defined( 'ABSPATH' )) exit; // Exit if accessed directly

class AreYouPayingAttention{

  function __construct(){
    add_action('init', array($this, 'adminAssets'));
  }


  function adminAssets(){
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ourplugin/are-you-paying-attention', array(
      'editor_script' => 'ournewblocktype',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes){
    ob_start(); ?>
      <h3>Today the sky is <?php echo esc_html($attributes['skyColor'])?>, but the grass is <?php echo esc_html($attributes['grassColor'])?></h3>
    <?php return ob_get_clean();

  }
}

$areYouPayingAttention = new AreYouPayingAttention();


/**
 * Efter run "npm run start" a build folder will be created.
 */