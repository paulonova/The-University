# T.H.E University

<h2>in theme folder, open terminal and write:  <code>npm run dev</code> or <code>npm run devFast</code> </h2>

## Automation Workflow

<ul>
	<li>Copy the files into the Theme folder</li>
	<li>webpack.config.js  and package.json</li>
	<li>Open the terminal and type npm install (To install all dependencies)</li>
	<li>Then type,  npm run dev</li>
	<li>Test some changings in Css, javascript and php files</li>
</ul>

## Archives links

#### <code> get_post_type_archive_link( 'event' ) -> Return the link of the post-type "event" </code>

<br>

## ACF Advanced Custom Fields

<p><a href="https://www.advancedcustomfields.com/resources/">ACF Documentation</a></p>
<p>To get the ACF Date Picker info and display first 3 letters from month, day and year</p>

#### <code> $eventDate = new DateTime(get_field('event_date', false, false)); // MUST have false, false.. </code>

#### <code> $eventDate->format('M');</code>

#### <code> $eventDate->format('d');</code>

#### <code> $eventDate->format('Y');</code>

### Set the Event Posts in ACF Date order:

#### <code>$homepageEvents = new WP_Query( array( </code>

    <code> ...  </code>
    <code> 'meta_key' => 'event_date', // set the name of custom field that i am intrested</code>
    <code> 'orderby' => 'meta_value_num',  // Must comr together with meta_key</code>
    <code> ... </code>

<code> ));?> </code>

### Set to hide all Past Events

<p>To filter past events in All Events Page without need to create a new parameters in WPQuery() function.
 * BUT: it aplies in all posts and even in Admin fields...
 * CREATE always a condition (if). </p>

<code>$today = date('Ymd');</code>

#### <code>$homepageEvents = new WP_Query( array( </code>

    <code> ...  </code>
    <code> 'meta_query' => array(, </code>
    <code> 'array(' </code>
    <code> 'key' => 'event_date', // Display events from event_date</code>
    <code> 'compare' => '>=', // that is grather or equal then</code>
    <code> 'value' => $today // Today´s date</code>
    <code> ) </code>
    <code> ) </code>

<code> ));?> </code>

## RELATIONSHIP Between Contents

<a href="https://www.advancedcustomfields.com/resources/relationship/">Relationship Documentation</a>

<p>Ex: Between Events and Programs (Diferent post types)</p>
<ul>
	<li>Create a ACF Relationship</li>
	<li>Filter by post-type Program</li>
	<li>Show this field group if Post-type is Events</li>
	<li>..See the documentation..</li>
</ul>

## Reduce duplicate Code and Recycle Functions

<p>I can create a function inside the functions.php to reuse it everywere.</p>
<p>I can create a Template Part with reusable block of codes to use also everywhere.</p><br>
<code> get_template_part('1rst arg', '2nd arg')</code><br>
<code> 1rst Arg: Points to the file I want to include. ex: 'template-parts/content' </code><br>
<code> 2nd  Arg: the name after the dash (-).  ex: 'event'</code><br>
<code> The file name is content-event.php and it is inside of template-parts folder..</code><br>

## Google Maps

<p><strong>Google Map Api: </strong> AIzaSyB_aanU78dFOqS7J6vCLzgqEGmniEXL5eY</p>

#### To display the Map in the page.

 <p><code>$mapLocation = get_field('map_location')</code></p>
 <p><code>class="marker" data-lat=" echo $mapLocation['lat']" data-lng="echo $mapLocation['lng']</code></p>
 <p><code>class="marker" data-lat=" echo $mapLocation['lat']" data-lng="echo $mapLocation['lng']"</code></p>
 <p><code>href="the_permalink();">< the_title();</code></p>
 <p><code>$mapLocation['address']</code></p>
    
 #### Follow the function in functions.php and in js/scripts.js

## WordPress RestApi

<p>Using jQuery to access the json file</p>
<p><code>$.getJson(url, function(data){})</code></p>

<p>Link:</p> <a href='https://api.jquery.com/jquery.getjson/ '>Jquery getJson() doc. </a>

#### The RestApi makes CRUD operations from enywhere (instead of only theme/plugin PHP files).

<p>Wordpress REST API Documentation: </p><a href='https://developer.wordpress.org/rest-api/'> REST API Documentation</a>

<p><a href="https://developer.wordpress.org/rest-api/reference/">Endpoints References</a></p>

### Dinamic URL to use in search.js

<p>In functions.php in the <code>add_action('wp_enqueue_scripts', 'university_files');</code> i need to set this code..</p>

  <p><code>wp_localize_script('main-university-js', 'universityData',  array(</code></p>
    <p><code>'root_url' => get_site_url()</code></p>
  <p><code>));</code></p>

  <p>It will create a js code in the sorce-code like this:</p>

  <p><code>[CDATA]</code></p>
  <p><code>var universityData = {"root_url":"http:\/\/localhost\/university"};</code></p>
  <p><code>[]</code></p>

## Creating my own RestAPI URL

  <ul>
	<li>Custom search Logic</li>
	<li>Respond with less Json data (load faster for visitors)</li>
	<li>Send only one getJson request instead of 6 in our JS</li>
	<li>Perfect exercise for sharping PHP skills.</li>
  </ul>

### Sanitize the search data

  <p><code>sanitize_test_field($args)</code></p>

### The Search Function process:

<ul>
  <li>Create a Javascript Main </li>
  <li>Create a Serach js file and then import and instantiate in the main js</li>
  <li>Crreate a class with a constructor and the nset all variables and element references in it</li>
  <li>Create the overlay and the close() and open() functions</li>
  <li>Create the search html in js (addSearchHtml)</li>
  <li>Extra: Create a key-press function for "s" to open and "esc" to close</li>
  <li>Create the typing logic with timeout</li>
  <li>*************************************************</li>
  <li>*************************************************</li>
  <li>Create the GetResults Function</li>
  <li>Inside of a try catch</li>
  <li>Install AXIOS to make the async request</li>
  <li>Create a PHP file (searchRout) and import to functions.php</li>
  <li>In SearchRout, create a new endpoint url that will create also the json format with: title, links, posttypes, authorName, etc.. (For all post-types)</li>
  
</ul>

## SECURITY

<ul>
  <li>esc_html() https://developer.wordpress.org/reference/functions/esc_html/</li>
  <li>esc_url()  https://developer.wordpress.org/reference/functions/esc_url/ </li>
  <li>esc_attr()</li>
  <li>esc_texarea()</li>
  <li>More...</li>
</ul>

## Roles and Permissions

<ul>
  <li>Install plugin Members by MemberPress</li>
  <li>In mu-plugins folder set in every post_type this: <code>'capability_type' => 'post-type-name',</code></li>
  <li>And <code>'map_meta_cap' => true,</code></li>
</ul>

### New Members Sign-upp

<ul>
  <li>Go to Settings and select Membership as "Anyone can register"</li>
  <li>Open url: /wp-login.php/action=register OR </li>
  <li>Set in header login button the <code>href= echo esc_url(site_url('/wp-signup.php'))</code></li>
  <li>Set a condition to when user created or logged in, redirect to frontpage in functions.php and hide the admin-bar</li>
  <li>Format the styling of the login page</li>
</ul>

### Styling the Login/Register page

<p>Link: https://codex.wordpress.org/Customizing_the_Login_Form</p>

## Creating a NOTE page with CRUD

<ul>
<li>Create a content-type NOTE</li>
<li>A Javascript file thet set Listenner in Delete and Edit buttons</li>
<li>Create in functions.php <code>'nonce' => wp_create_nonce('wp_rest')</code></li>
<li>In source-code, get the nonce number: <code>universityData.nonce</code></li>
</ul>

## Create LIKE to Professors

<ul>
<li>Create a new Post-type LIKE</li>
<li>Every time some one click to LIKE, it will <strong>create</strong> a post in Likes</li>
<li>Tu unLike the post, I need to click again and <strong>delete</strong> the post in Likes</li>
<li>Create a Custom Field to retreave the professor Id</li>
<li>Create a like.js and instantiate in scripts.js</li>
<li>Create there functions to handle the like.</li>
</ul>

### Create My API ENDPOINT
