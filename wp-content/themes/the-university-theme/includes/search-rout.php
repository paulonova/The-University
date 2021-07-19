<?php 

/**args
 * **** Creating my own API Endpoint *****
 * 1- the name space: (wp is a wordpress core) I will use the 'university/v1' to be my core in version one.
 * 2- the rout: is the last name in url, ex: post, page, professor etc. (I will use 'search')
 * 3- Array  (WP_REST_SERVER::READABLE === GET)
 */

function university_register_search(){
    register_rest_route( 'university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'university_search_results'
    ));
}
add_action('rest_api_init', 'university_register_search');



/**
 * Returns the data to the Json file
 * $data returns an array of info from the request (term)
 */
function university_search_results($data){
    $mainQuery = new WP_Query( array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ) );

    /** Create separated arrays to push in*/
    $results = array(
        'generalInfo'   => array(),
        'professors'    => array(),
        'programs'      => array(),
        'events'        => array(),
        'campuses'      => array()
    );

    while($mainQuery->have_posts()){
        $mainQuery->the_post();

        if(get_post_type() == 'post' || get_post_type() == 'page'){
          array_push($results['generalInfo'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'postType' => get_post_type(),
            'authorName' => get_the_author()
          ));
        }
        if(get_post_type() == 'professor'){
          array_push($results['professors'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'image' => get_the_post_thumbnail_url( 0, 'professorLandscape' )
          ));
        }
        if(get_post_type() == 'program'){
          $relatedCampuses = get_field('related_campus');

          if($relatedCampuses){
            foreach($relatedCampuses as $campus){
              array_push($results['campuses'], array(
                'title' => get_the_title($campus),
                'permalink' => get_the_permalink($campus)
              ));
            }
          }

          array_push($results['programs'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'id' => get_the_ID()
          ));
        }
        if(get_post_type() == 'campus'){
          array_push($results['campuses'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink()
          ));
        }
        if(get_post_type() == 'event'){
          $eventDate = new Datetime(get_field('event_date'));
          $description = NULL;

          if(has_excerpt()){
            $description = get_the_excerpt();
          }else{
            $description = wp_trim_words(get_the_content(), 10);
          }

          array_push($results['events'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'month' => $eventDate->format('M'),
            'day' => $eventDate->format('d'),
            'description' => $description
          ));
        }        
    }

    if($results['programs']){

        // for one or more programs..
        $programsMetaQuery = array('relation' => 'OR');

        foreach($results['programs'] as $item){
          array_push($programsMetaQuery, array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => '"' . $item['id'] . '"'
          ));
        }

        $programRelationshipQuery = new WP_Query(array(
          'post_type' => array('professor', 'event'),
          'meta_query' => $programsMetaQuery
        ));

        while($programRelationshipQuery->have_posts()){
              $programRelationshipQuery->the_post();

          if(get_post_type() == 'event'){
            $eventDate = new Datetime(get_field('event_date'));  
            array_push($results['events'], array(
              'title' => get_the_title(),
              'permalink' => get_the_permalink(),
              'month' => $eventDate->format('M'),
              'day' => $eventDate->format('d'),
              'description' => has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 18)
            ));
          }     

          if(get_post_type() == 'professor'){
            array_push($results['professors'], array(
              'title' => get_the_title(),
              'permalink' => get_the_permalink(),
              'image' => get_the_post_thumbnail_url( 0, 'professorLandscape' )
            ));
          }          
        }

        //The array_unique() removes all duplication
        $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));
        $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));

    }
    
 
    return $results;
}