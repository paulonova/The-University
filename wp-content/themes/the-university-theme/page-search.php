<?php get_header( ); ?>

<?php while(have_posts()): the_post();?>

    <!-- -->
    <?php pageBanner(array(
      'title' => get_the_title(),
      'subtitle' => get_field('page_banner_subtitle'),
      'photo' => get_field('page_banner_background_image')['sizes']['pageBanner']
    ));?>

    <div class="container container--narrow page-section">

      <!-- Show this block code  if page is a child page 
          Gets the Parent ID from the page ID (0 false, >1 true) -->
      <?php $theParent = wp_get_post_parent_id(get_the_ID());?>

      <?php if($theParent):?>
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true">          
          </i>Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title();?></span>
          </p>
        </div>
      <?php endif;?>
      
      <?php $isParent = get_pages(array(  //Check if the page is a parent page or not
        'child_of' => get_the_ID()
      )); ?>

      <!-- Menu in Content-->
      <?php if($theParent || $isParent):?>
        <div class="page-links">
          <h2 class="page-links__title"><a href="<?php echo ($theParent ? get_permalink($theParent) : ''); ?>"><?php echo get_the_title($theParent);?></a></h2>
          <ul class="min-list">
            <?php 
              // If it is a child page show th parent
              if($theParent){
                $findChildrenOf = $theParent;
              }else{
                //If not, get the page ID
                $findChildrenOf = get_the_ID();
              }
            ?>
            <?php wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order' // Allow to set the order from AdminPage
            ));?>
          </ul>
        </div>
      <?php endif;?>
      
      <div class="generic-content">
        <?php get_search_form();?>
      </div>

    </div>

  <?php endwhile;?>

<?php get_footer();?>