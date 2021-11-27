<?php

/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School
 * @since 1.0.0
 */

require_once(dirname(__FILE__) . '/vendor/autoload.php');

use Inc\Course;
use Inc\CourseApis;

/**
 * Define Constants
 */
define('CHILD_THEME_SCHOOL_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_style('school-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SCHOOL_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);
add_action('init', array(Course::class, 'create_post_type'));
add_filter('manage_course_posts_columns', array(Course::class, 'add_custom_column'));
add_action('manage_course_posts_custom_column',  array(Course::class, 'custom_column_data'), 10, 2);
add_action('after_setup_theme', array(Course::class, 'custom_image_thumbnail'));
add_action('wp_enqueue_scripts', 'link_font_awesome');
function link_font_awesome()
{
	wp_enqueue_script('main-js', get_stylesheet_directory_uri(__FILE__) . '/build/index.js', array('jquery'), '1.0.0', true);
	wp_enqueue_style('fontawsome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css');
}
add_action('rest_api_init', array(CourseApis::class, 'courses_custom_rest'));
add_action('do_meta_boxes', 'ast_remove_plugin_metaboxes');
function ast_remove_plugin_metaboxes()
{
	remove_meta_box('astra_settings_meta_box', '', 'side'); // Remove Astra Settings
}
add_shortcode('faculties', array(Course::class, 'show_faculties'));
add_shortcode('modules', array(Course::class, 'show_modules'));
add_shortcode('search', array(Course::class, 'search_results'));
