<?php 


function universityMapKey( $api ){
	
	$api['key'] = 'AIzaSyB_aanU78dFOqS7J6vCLzgqEGmniEXL5eY';	
	return $api;	
}
add_filter('acf/fields/google_map/api', 'universityMapKey');