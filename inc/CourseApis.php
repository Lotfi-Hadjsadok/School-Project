<?php

namespace Inc;

use \WP_Query;

class CourseApis
{
    static function courses_custom_rest()
    {
        register_rest_route('university/v1', 'courses', array(
            'methods' => 'GET',
            'callback' => array(CourseApis::class, 'search_courses')
        ));
        register_rest_route('university/v1', 'search', array(
            'methods' => 'GET',
            'callback' => array(CourseApis::class, 'search_results')
        ));
    }
    function search_results($data)
    {
        $courses = new WP_Query(array(
            'post_type' => ['course'],
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'paged' => $data['page'],
            's' => sanitize_text_field($data['query']),
            'p' => sanitize_text_field($data['id'])
        ));
        $data = [];
        while ($courses->have_posts()) {
            $courses->the_post();

            array_push($data, array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'module' => get_the_terms(0, 'module')[0],
                'type' => get_the_terms(0, 'type')[0],
                'faculty' => get_the_terms(0, 'faculty')[0],
                'description' => get_the_content(),
                'post_link' => get_the_permalink(),
                'status' => get_post_status(),
                'youtube_link' => get_field('course_video_url'),
                'course_rar' => get_field('course_rar')
            ));
        }
    }
    function get_the_course_term($taxonomy)
    {
        return array_merge((array)get_the_terms(0, $taxonomy)[0], ['permalink' => get_term_link(get_the_terms(0, $taxonomy)[0], $taxonomy)]);
    }
    function search_courses($data)
    {
        $course = new CourseApis();
        $courses = new WP_Query(array(
            'post_type' => ['course'],
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'paged' => $data['page'],
            's' => sanitize_text_field($data['query']),
            'p' => sanitize_text_field($data['id'])
        ));

        $results = [];
        while ($courses->have_posts()) {
            $courses->the_post();
            array_push($results, array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'module' => $course->get_the_course_term('module'),
                'type' => $course->get_the_course_term('type'),
                'faculty' => $course->get_the_course_term('faculty'),
                'description' => get_the_content(),
                'post_link' => get_the_permalink(),
                'status' => get_post_status(),
                'youtube_link' => get_field('course_video_url'),
                'course_rar' => get_field('course_rar')
            ));
        }
        return $results;
    }
}
