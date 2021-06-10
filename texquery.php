<?php
/*
 * Template Name: Texonomy Query
 */
?>
<?php
/*
$args  = array(
	'post_type' => 'book',
	'posts_per_page'=>-1,
	'tax_query' => array(
		'relation'=>'AND',
		array(
			'taxonomy' => 'language',
			'field'    => 'slug',
			'terms'    => array('Bangla')
		),
		array(
			'taxonomy' => 'language',
			'field'    => 'slug',
			'terms'    => array('English'),
			'operator' => 'NOT IN'
		),
	),
);
$query = new WP_Query( $args );
//echo $query->found_posts;

while($query->have_posts()){
	$query->the_post();
	the_title();
	echo '<br/>';
}

wp_reset_query();

*/



/*
$args  = array(
	'post_type' => 'book',
	'posts_per_page'=>-1,
	'tax_query' => array(
		'relation'=>'AND',
		array(
			'taxonomy' => 'language',
			'field'    => 'slug',
			'terms'    => array('Bangla')
		),
		array(
			'taxonomy' => 'language',
			'field'    => 'slug',
			'terms'    => array('English'),
			'operator' => 'NOT IN'
		),
	),
);
$query = new WP_Query( $args );

while($query->have_posts()){
	$query->the_post();
	the_title();
	echo '<br/>';
}

wp_reset_query();

*/



$args  = array(
	'post_type' => 'book',
	'posts_per_page'=>-1,
	'tax_query' => array(
		'relation'=> 'AND',
		array(
			'relation'=>'AND',
			array(
				'taxonomy' => 'language',
				'field'    => 'slug',
				'terms'    => array('english')
			),
			array(
				'taxonomy' => 'language',
				'field'    => 'slug',
				'terms'    => array('bangla'),
				'operator' => 'NOT IN'
			),
		),

		array(
			'taxonomy' => 'genre',
			'field'    => 'slug',
			'terms'    => array('classic','horor'),
		),
	),
);
$query = new WP_Query( $args );

while($query->have_posts()){
	$query->the_post();
	the_title();
	echo '<br/>';
}

wp_reset_query();



















