<?php


require_once( get_theme_file_path( "/inc/tgm.php" ) );
require_once( get_theme_file_path( "/inc/attachments.php" ) );
require_once( get_theme_file_path( "/inc/cmb2-attached-posts.php" ) );
require_once( get_theme_file_path( "/inc/social-icons-widget.php" ) );
require_once( get_theme_file_path( "/lib/csf/cs-framework.php" ) );
require_once( get_theme_file_path( "/inc/cs.php" ) );

define('CS_ACTIVE_LIGHT_THEME', true);

if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

if ( site_url() == "http://demo.lwhh.com" ) {
	define( "VERSION", time() );
} else {
	define( "VERSION", wp_get_theme()->get( "Version" ) );
}

function philosophy_theme_setup() {
	load_theme_textdomain( "philosophy" );
	add_theme_support( "post-thumbnails" );
	add_theme_support( "custom-logo" );
	add_theme_support( "title-tag" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', ' comment-list' ) );
	add_theme_support( "post-formats", array( "image", "gallery", "quote", "audio", "video", "link" ) );
	add_editor_style( "/assets/css/editor-style.css" );

	register_nav_menu( "topmenu", __( "Top menu", "philosophy" ) );
	register_nav_menus( array(
		"footer-left"  => __( "Footer Left Menu", "philosophy" ),
		"footer-right" => __( "Footer Right Menu", "philosophy" ),
	) );
	add_image_size( "philosophy-home-square", 400, 400, true );
}

add_action( "after_setup_theme", "philosophy_theme_setup" );

function philosophy_assets() {
	wp_enqueue_style( "fontawesome-css", get_theme_file_uri( "/assets/css/font-awesome/font-awesome.css" ), null, "1.0" );
	wp_enqueue_style( "fonts-css", get_theme_file_uri( "/assets/css/fonts.css" ), null, "1.0" );
	wp_enqueue_style( "base-css", get_theme_file_uri( "/assets/css/base.css" ), null, "1.0" );
	wp_enqueue_style( "vendor-css", get_theme_file_uri( "/assets/css/vendor.css" ), null, "1.0" );
	wp_enqueue_style( "main-css", get_theme_file_uri( "/assets/css/main.css" ), null, VERSION );
	wp_enqueue_style( "philosophy-css", get_stylesheet_uri(), null, VERSION );

	wp_enqueue_script( "modernizr-js", get_theme_file_uri( "/assets/js/modernizr.js" ), null, "1.0" );
	wp_enqueue_script( "pace-js", get_theme_file_uri( "/assets/js/pace.min.js" ), null, "1.0" );
	wp_enqueue_script( "plugins-js", get_theme_file_uri( "/assets/js/plugins.js" ), array( "jquery" ), "1.0", true );
	if ( is_singular() ) {
		wp_enqueue_script( "comment-reply" );
	}
	wp_enqueue_script( "main-js", get_theme_file_uri( "/assets/js/main.js" ), array( "jquery" ), "1.0", true );
}

add_action( "wp_enqueue_scripts", "philosophy_assets" );

function philosophy_pagination() {
	global $wp_query;
	$links = paginate_links( array(
		'current'  => max( 1, get_query_var( 'paged' ) ),
		'total'    => $wp_query->max_num_pages,
		'type'     => 'list',
		'mid_size' => apply_filters( "philosophy_pagination_mid_size", 3 )

	) );
	$links = str_replace( "page-numbers", "pgn__num", $links );
	$links = str_replace( "<ul class='pgn__num'>", "<ul/>", $links );
	$links = str_replace( "next pgn__num", "pgn__next", $links );
	$links = str_replace( "prev pgn__num", "pgn__prev", $links );
	echo wp_kses_post( $links );
}

;

remove_action( "term_description", "wpautop" );

function philosophy_widgets() {
	register_sidebar( array(
		'name'          => __( 'Header Section', 'philosophy' ),
		'id'            => 'header-section',
		'description'   => __( 'Widgets in this area will be shown on Header.', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'About-us', 'philosophy' ),
		'id'            => 'about-us',
		'description'   => __( 'Widgets in this area will be shown on about us page.', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="col-block %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="quarter-top-margin">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Contact Page Maps Section', 'philosophy' ),
		'id'            => 'contact-maps',
		'description'   => __( 'Widgets in this area will be shown on contact page.', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Contact Page Information Section', 'philosophy' ),
		'id'            => 'contact-info',
		'description'   => __( 'Widgets in this area will be shown on contact page.', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="col-block %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="quarter-top-margin">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Before Footer Section', 'philosophy' ),
		'id'            => 'before-footer-right',
		'description'   => __( 'Before footer section, right side', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( ' Footer Left Section', 'philosophy' ),
		'id'            => 'footer-left-archive',
		'description'   => __( 'Footer left section archive, left side', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( ' Footer Right Section', 'philosophy' ),
		'id'            => 'footer-right-newsletter',
		'description'   => __( 'Footer right section , Right side', 'philosophy' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( ' Footer Bottom Section', 'philosophy' ),
		'id'            => 'footer-bottom',
		'description'   => __( 'Footer bottom side , Bottom side', 'philosophy' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

}

add_action( 'widgets_init', 'philosophy_widgets' );


function philosophy_search_form( $form ) {
	$homedir      = home_url( "/" );
	$label        = __( "Search for", "philosophy" );
	$button_label = __( "Search", "philosophy" );
	$post_type = <<<PT
<input type="hidden" name="post_type" value="post">
PT;

	if(is_post_type_archive('book')){
		$post_type = <<<PT
<input type="hidden" name="post_type" value="book">
PT;
	}


	$newform = <<<FORM
<form role="search" method="get" class="header__search-form" action="{$homedir}">
	<label>
		<span class="hide-content">{$label}</span>
		<input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="{$label}" autocomplete="off">
	</label>
	{$post_type}
	<input type="submit" class="search-submit" value="{$button_label}">
</form>
FORM;
	return $newform;
}

add_filter( "get_search_form", "philosophy_search_form" );

function before_cat_title1() {
	echo "<p>Before title1</p>";
}

add_action( "philosophy_before_category_title", "before_cat_title1" );

function before_cat_title2() {
	echo "<p>Before title2</p>";
}

add_action( "philosophy_before_category_title", "before_cat_title2", 8 );

function before_cat_title3() {
	echo "<p>Before title3</p>";
}

add_action( "philosophy_before_category_title", "before_cat_title3", 9 );


function after_cat_title() {
	echo "<p>After title</p>";
}

add_action( "philosophy_after_category_title", "after_cat_title" );

function after_cat_description() {
	echo "<p>After description</p>";
}

add_action( "philosophy_after_category_description", "after_cat_description" );

remove_action( "philosophy_before_category_title", "before_cat_title1" );
remove_action( "philosophy_before_category_title", "before_cat_title2", 8 );
remove_action( "philosophy_before_category_title", "before_cat_title3", 9 );
remove_action( "philosophy_after_category_title", "after_cat_title" );
remove_action( "philosophy_after_category_description", "after_cat_description" );

function begining_category_page( $category_title ) {

	if ( "SSC" == $category_title ) {
		$visit_count = get_option( "category_new" );
		$visit_count = $visit_count ? $visit_count : 0;
		$visit_count ++;
		update_option( "category_new", $visit_count );
	}
}

add_action( "philosophy_category_page", "begining_category_page" );

function capital_text( $text ) {
	return strtoupper( $text );
}

//add_filter("philosophy_text","capital_text");

function uppercase_text( $param1, $param2, $param3 ) {
	return ucwords( $param1 ) . " " . strtoupper( $param2 ) . " " . ucwords( $param3 );
}

add_filter( "philosophy_text", "uppercase_text", 10, 3 );

function pagination_mid_size( $size ) {
	return 5;
}

add_filter( "philosophy_pagination_mid_size", "pagination_mid_size" );

function philosophy_home_banner_class( $class_name ) {
	if ( is_home() ) {
		return $class_name;
	} else {
		return "";
	}
}

add_filter( "philosophy_home_banner_class", "philosophy_home_banner_class" );




function philosophy_cpt_slug_fix($post_link, $id){
	$p = get_post($id);
	if(is_object($p) && 'chapter'== get_post_type($id)){
		$parent_post_id = get_field('parent_book');
		$parent_post = get_post($parent_post_id);
		if($parent_post){
			$post_link = str_replace("%book%",$parent_post->post_name,$post_link);
		}
	}
	if(is_object($p) && 'book'== get_post_type($p)){
		$genre = wp_get_post_terms($p->ID,'genre');
		if(is_array($genre) && count($genre)>0){
			$slug = $genre[0]->slug;
			$post_link = str_replace("%genre%", $slug,$post_link);
		}else{
			$slug = "generic";
			$post_link = str_replace("%genre%", $slug,$post_link);
		}
	}
	return $post_link;
}
add_filter('post_type_link','philosophy_cpt_slug_fix',1,2);

function philosophy_footer_language_heading($title){
	if(is_post_type_archive('book') || is_tax('language')){
		$title = __('Languages','philosophy');
	}
	return $title;
}
add_filter('philosophy_footer_tag_heading','philosophy_footer_language_heading');

function philosophy_footer_language_terms($tags){
	if(is_post_type_archive('book') || is_tax('language')){
		$tags = get_terms(array(
			'taxonomy'=>'language',
			'hide_empty'=>false
		));
	}
	return $tags;
}
add_filter('philosophy_footer_tag_items','philosophy_footer_language_terms');



