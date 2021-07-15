
<?php 

//Redirect subscriber accounts out of admin and onto homepage

function redirectSubsToFrontend(){
  $ourCurrentUser = wp_get_current_user();
  if(count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber'){
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('admin_init', 'redirectSubsToFrontend');


// Hide admin bar from Subscribers
function noSubsAdminBar(){
  $ourCurrentUser = wp_get_current_user();
  if(count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber'){
    show_admin_bar(false);
  }
}

add_action('wp_loaded', 'noSubsAdminBar');



// Redirect the logotype in login page to the frontpage
function ourHeaderUrl(){
  return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourHeaderUrl');



//Login styling CSS
function my_login_logo() { ?>
  <style type="text/css">
      #login h1 a, .login h1 a {
        background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2021/07/university-logo.png);
        height:65px;
        width:320px;
        background-size: 320px 65px;
        background-repeat: no-repeat;
      }
      body.login-action-login{
        background: rgb(141,198,199);
        background: linear-gradient(153deg, rgba(141,198,199,1) 0%, rgba(255,255,255,1) 50%, rgba(255,212,120,1) 100%);
      }
      body.login-action-register{
        background: rgb(141,198,199);
        background: linear-gradient(153deg, rgba(141,198,199,1) 0%, rgba(255,255,255,1) 50%, rgba(255,212,120,1) 100%);
      }
      #wp-submit {
        background: #F95738;
        border-color: #F95738;
        color: #fff;
        text-decoration: none;
        text-shadow: none;
    }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * To style the Login page, check the class names from the elements I wanto to style and override the styles
 */