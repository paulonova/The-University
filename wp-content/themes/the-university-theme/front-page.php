<?php get_header( ); ?>

<?php //echo $_SERVER['SERVER_NAME'];?>

<div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg')?>);"></div>
      <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="<?php echo get_post_type_archive_link( 'program' )?>" class="btn btn--large btn--blue">Find Your Major</a>
      </div>
    </div>

    <!-- -->
    <div class="full-width-split group">
      <div class="full-width-split__one">
        <div class="full-width-split__inner"> 
          <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

          <?php $today = date('Ymd');?>
          <?php $homepageEvents = new WP_Query( array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(  // Use to sort information
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            )
          ));?>

          <?php while($homepageEvents->have_posts()): $homepageEvents->the_post()?>
            <?php get_template_part( 'template-parts/content', 'event');?>
          <?php endwhile; ?>

          <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link( 'event' )?>" class="btn btn--blue">View All Events</a></p>
        </div>
      </div>

      <!-- From Our Blogs -->
      <div class="full-width-split__two">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

          <?php 
            $homepagePosts = new WP_Query(array(
              'posts_per_page' => 2
            ));
          ?>
          <?php while($homepagePosts->have_posts()): $homepagePosts->the_post();?>
            <div class="event-summary">
              <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink();?>">
                <span class="event-summary__month"><?php the_time('M');?></span>
                <span class="event-summary__day"><?php the_time('d');?></span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                <p>
                <?php if(has_excerpt()){
                  echo get_the_excerpt();
                }else{
                  echo wp_trim_words( get_the_content(), 18);
                }?>
                <a href="<?php the_permalink();?>" class="nu gray">Read more</a></p>
            </div>
          </div>
          <?php endwhile;?>

          <!-- to clean the some wp data and global Variables -->
          <?php wp_reset_postdata();?>

          <p class="t-center no-margin"><a href="<?php echo site_url('/blog');?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
      </div>
    </div>

    <?php
    //Variables to Slide
    $slideTitle1 = get_field('slide_title_1');
    $slideTitle2 = get_field('slide_title_2');
    $slideTitle3 = get_field('slide_title_3');

    $slideSubtitle1 = get_field('slide_subtitle_1');
    $slideSubtitle2 = get_field('slide_subtitle_2');
    $slideSubtitle3 = get_field('slide_subtitle_3');

    $slideLink1 = get_field('slide_link_1');
    $slideLink2 = get_field('slide_link_2');
    $slideLink3 = get_field('slide_link_3');

    $slideImage1 = get_field('slide_image_1');
    $slideImage2= get_field('slide_image_2');
    $slideImage3 = get_field('slide_image_3');    
    ?>

    <div class="hero-slider">
      <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">      

          <div class="hero-slider__slide" style="background-image: url(<?php echo esc_url($slideImage1['url']);?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php echo sanitize_text_field($slideTitle1)?></h2>
                <p class="t-center"><?php echo sanitize_text_field($slideSubtitle1)?></p>
                <p class="t-center no-margin"><a href="<?php echo esc_url($slideLink1['url']) ?>" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>

          <div class="hero-slider__slide" style="background-image: url(<?php echo esc_url($slideImage2['url']);?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php echo sanitize_text_field($slideTitle2)?></h2>
                <p class="t-center"><?php echo sanitize_text_field($slideSubtitle2)?></p>
                <p class="t-center no-margin"><a href="<?php echo esc_url($slideLink2['url']) ?>" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>

          <div class="hero-slider__slide" style="background-image: url(<?php echo esc_url($slideImage3['url']);?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php echo sanitize_text_field($slideTitle3)?></h2>
                <p class="t-center"><?php echo sanitize_text_field($slideSubtitle3)?></p>
                <p class="t-center no-margin"><a href="<?php echo esc_url($slideLink3['url']) ?>" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>

        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
      </div>
    </div>

<?php get_footer(); ?>

