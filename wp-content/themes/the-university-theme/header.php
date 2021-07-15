<!DOCTYPE html>

<!-- Set the appropriated language in browser-->
<html <?php language_attributes();?>>
<head>
  <meta charset="<?php bloginfo('charset');?>"> <!-- Set the appropriated type of characters-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php wp_head();?>
  <title>Document</title>
</head>
<!-- This function gives the body element different classes and can be used in css or in javascript. -->
<body <?php body_class();?>>  

      <header class="site-header">
        <div class="container">
          <h1 class="school-logo-text float-left">
            <a href="<?php echo site_url(); ?>"><strong>T.H.E.</strong> University</a>
          </h1>

          <a href="<?php echo esc_url(site_url('/search'))?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>

          <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
          <div class="site-header__menu group">
            <nav class="main-navigation">
              <ul>
                <!-- Check if the link is active or if it is a child-->
                <li <?php if(is_page('about-us') || wp_get_post_parent_id(0) == 9) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/about-us');?>">About Us</a></li>
                <li <?php if(get_post_type() == 'program') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('program');?>">Programs</a></li>
                <li <?php if(get_post_type() == 'event' || is_page('past-events')) echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('event');?>">Events</a></li>
                <li <?php if(get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('campus');?>">Campuses</a></li>
                <li <?php if(get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/blog');?>">Blog</a></li>
              </ul>

              <?php 
                /*wp_nav_menu( array(
                  'theme_location' => 'headerMenuLocation' 
                ));*/
              
              ?>

            </nav>
            <div class="site-header__util">
              <?php if( is_user_logged_in()):?>
                <a href="<?php echo wp_logout_url();?>" class="btn btn--small btn--dark-orange float-left btn--with-photo">
                <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60);?></span>
                <span class="btn__text">Log Out</span>
              </a>

              <?php else:?>
                <a href="<?php echo wp_login_url();?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                <a href="<?php echo wp_registration_url();?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>

              <?php endif;?>
              
              <a href="<?php echo esc_url(site_url('/search')) ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </header>
