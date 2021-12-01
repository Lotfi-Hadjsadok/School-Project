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
        register_rest_route('university/v1', 'courses_faculty', array(
            'methods' => 'GET',
            'callback' => array(CourseApis::class, 'search_courses_faculties')
        ));
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
            'posts_per_page' => $data['page_limit'],
            'paged' => $data['page'],
            's' => sanitize_text_field($data['query']),
            'p' => sanitize_text_field($data['id']),
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

    // PAR FACULTY
    function search_courses_faculties($data)
    {
        $course = new CourseApis();
        $courses = new WP_Query(array(
            'post_type' => ['course'],
            'post_status' => 'publish',
            'posts_per_page' => $data['page_limit'],
            'paged' => $data['page'],
            's' => sanitize_text_field($data['query']),
            'p' => sanitize_text_field($data['id']),
            'tax_query' => array(
                array(
                    'taxonomy' => 'faculty',
                    'field' => 'slug',
                    'terms' => array($data['faculty'])
                )
            )
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
