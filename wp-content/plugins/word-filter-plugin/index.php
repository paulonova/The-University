<?php

/*
  Plugin Name: Word Filter Plugin
  Description: Replacea list of words
  Version: 1.0
  Author: Paulo
  Author URI: https://www.paulonova.one
*/


if(!defined( 'ABSPATH' )) exit; // Exit if accessed directly

class OurWordFilterPlugin{

  function __construct(){
    add_action('admin_menu', array($this, 'ourMenu'));
    add_action('admin_init', array($this, 'ourSettings'));
    if(get_option('plugin_words_to_filter')) add_filter('the_content', array($this, 'filterLogic'));
  }

  function ourSettings(){
    add_settings_section('replacement-text-section', null, null, 'word-filter-options');
    register_setting('replacementFields', 'replacementText');
    add_settings_field( 'replacement-text', 'Filtered Text', array($this, 'replacementFieldHTML'), 'word-filter-options', 'replacement-text-section');
  }

  function replacementFieldHTML(){ ?>
    <input type="text" name="replacementText" value="<?php echo esc_attr(get_option('replacementText', '*****'))?>">
    <p class="description">Leave blank to simply remove the filtered words.</p>
  <?php }

  function filterLogic($content){
    $badWords = explode(',', get_option('plugin_words_to_filter'));
    $badWordsTrimmed = array_map('trim', $badWords);
    return str_ireplace($badWordsTrimmed, esc_html(get_option('replacementText')) , $content);
  }

  function ourMenu(){
    $mainPageHook = add_menu_page( 'Words to Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFiltePage'), plugin_dir_url(__FILE__) . 'src/images/custom.svg', 100);

    add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
    /**To remove the duplicate name "Word Filter" and set "Words List"*/
    add_submenu_page('ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'wordFiltePage'));
    add_submenu_page( 'ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
  }

  //To link CSS
  function mainPageAssets(){
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles/styles.css');
  }

  function handleForm(){
    if(wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') && current_user_can('manage_options')){
      update_option( 'plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter']) ); ?>
      <div class="updated"> 
        <p>Your filtered words were saved..</p>
      </div>

    <?php }else{
      echo '
        <div class="error">
          <p>Sorry! you don´t have permission to perform that action..</p>
        </div>
      ' ;
    }

  }

  function wordFilterPage(){ ?>

    <div class="wrap">
      <h1>Word Filter</h1>

      <?php if($_POST['justsubmitted'] == true) $this->handleForm();?>
      <form method="POST">
        <?php wp_nonce_field('saveFilterWords', 'ourNonce' ); // prevent hack atack?>
        <input type="hidden" name="justsubmitted" value="true">
        <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words</p></label>
        <div class="word-filter__flex-container">
          <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible">
            <?php echo esc_textarea(get_option('plugin_words_to_filter')) ?></textarea>
        </div> 
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
      </form>

    </div>
  <?php }

  function optionsSubPage(){ ?>
  
  <div class="wrap">
    <h1>Word Filter Options</h1>
    <form action="options.php" method="POST">
      <?php 
      settings_errors();
      settings_fields('replacementFields');
      do_settings_sections('word-filter-options');
      submit_button();?>
    </form>
  </div>
    

  <?php }



}

$ourWordFiltePlugin = new OurWordFilterPlugin();