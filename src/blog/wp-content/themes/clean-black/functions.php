<?php

if ( ! isset( $content_width ) ) $content_width = 640;

if ( ! function_exists( 'cleanblack_theme_setup' ) ) :
function cleanblack_theme_setup() {
load_theme_textdomain( 'cleanblack', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 960,
	'height'                 => 150,
	'flex-height'            => false,
	'flex-width'             => false,
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
		'primary' => __( 'cleanblack Primary Menu', 'cleanblack' )
	) );
}
endif;
add_action('after_setup_theme', 'cleanblack_theme_setup');

function cleanblack_widgets_init() {
			register_sidebar(array('name'=>'Sidebar Top',
					   'before_title' => '<div class="headingred">',
					   'after_title' => '</div>')
			);
	
}
add_action( 'widgets_init', 'cleanblack_widgets_init' );

function cleanblack_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$cleanblack_title = $title . get_bloginfo( 'name' );
	$cleanblack_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$cleanblack_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';

	return $cleanblack_title;
}
add_filter( 'wp_title', 'cleanblack_wp_title' );

function cleanblack_remove_shortcode($content) {
  if ( is_home() || is_archive() || is_search()) {
    $content = strip_shortcodes( $content );
  }
  return $content;
}
add_filter('the_content', 'cleanblack_remove_shortcode');

function cleanblack_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]>', $content);
    $content = strip_tags($content);

   if (strlen(isset($_GET['p'])) > 0) {
     echo "<p>";
	 echo $content;
	 echo "[...]";
	 echo "</p>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
     $content = substr($content, 0, $espacio);
     echo $content; 
	 echo "[...]";
   }
   else {
     echo $content;
	 echo "[...]";
	}
}

include 'theme-options.php';
function cleanblack_scripts() {
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'cleanblack_scripts' );

function cleanblack_get_options($atts) {
	$options_array = get_option("cleanblack_options");	
  	return esc_attr($options_array[$atts]);
}
?>