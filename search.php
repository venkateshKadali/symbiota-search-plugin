<?php
include('C:/xampp/htdocs/WP/wordpress/wp-blog-header.php');
include_once('C:/xampp/htdocs/WP/wordpress/wp-content/plugins/symbiota/symbiota/config/symbini.php');
include_once('C:/xampp/htdocs/WP/wordpress/wp-content/plugins/symbiota/symbiota/classes/OccurrenceListManager.php');

$occListMgrObj = new OccurrenceListManager();

// Preparing a WP_query
$the_query = new WP_Query(
array(
'post_type' => 'page', // We only want pages
//'post_parent' => 244, // We only want children of a defined post ID
'post_count' => -1 // We do not want to limit the post count
// We can define any additional arguments that we need - see Codex for the full list
)
);
$return_array = array(); // Initializing the array that will be used for the table

while( $the_query->have_posts() ){

// Fetch the post
$the_query->the_post();

// Filling in the new array entry
//$return_array = $occListMgrObj->getSearchTerms();
$return_array = $occListMgrObj->getRecordArr(1,2500);
// Get first 200 chars of the content and replace the shortcodes and tags

}

$context = Timber::get_context();
$context['return'] = $return_array;
if(($_POST['template1'])=="true"){
  Timber::render('search1.twig', $context);
}
else if(($_POST['template2'])=="true"){
  Timber::render('search2.twig', $context);
}
else if(($_POST['template3'])=="true"){
  Timber::render('search3.twig', $context);
}


?>


