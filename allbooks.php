<?php
/*
 * Template Name: All Books
 */

?>

<h1>Books</h1>
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
$posts_oer_page = 3;

$book_query = new WP_Query(array(
	'post_type'=>'book',
	'post_per_page'=> $posts_per_page,
	'paged'=>$paged
));

while($book_query->have_posts()){
	$book_query->the_post();
	the_title();
	echo '<br/>';
}
the_posts_pagination();
echo paginate_links([
	'current'=>$paged,
	'total'=>$book_query->max_num_pages,
	//'prev_next'=>false
]);
?>




























