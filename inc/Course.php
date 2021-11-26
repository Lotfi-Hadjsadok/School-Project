<?php

namespace Inc;

class Course
{
    static function create_post_type()
    {
        register_post_type('course', array(
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'editor', 'thumbnail'
            ),
            'menu_icon' => 'dashicons-welcome-learn-more',
            'capability_type' => 'course',
            'map_meta_cap' => true,
            'labels' => array(
                'name' => 'Course',
                'add_new' => 'Add Course',
                'add_new_item' => 'Add New Course'

            )
        ));
        register_post_type('school-level', array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array(
                'slug' => 'level'
            ),
            'supports' => array(
                'title', 'editor', 'thumbnail'
            ),
            'menu_icon' => 'dashicons-awards',
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'labels' => array(
                'name' => 'School Year',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New'

            )
        ));
    }
    static function add_custom_column($columns)
    {

        $columns['author'] = __('Author');
        $columns['categories'] = __('Categories');
        $columns['status'] = __('Status');
        return $columns;
    }
    static function custom_image_thumbnail()
    {
        add_image_size('course-image', 500, 500, true);
    }
    static function custom_column_data($columns, $post_id)
    {

        $post = get_post($post_id);
        if ($post->post_type == 'course') {
            switch ($columns) {
                case 'status':
?>
                    <p style="background-color: <?php

                                                switch ($post->post_status) {
                                                    case 'pending':
                                                        echo '#DE9310';
                                                        break;
                                                    case 'publish';
                                                        echo '#00B455';
                                                        break;
                                                    case 'trash';
                                                        echo '#DD3301';
                                                        break;
                                                }
                                                ?>;" class='course_column_status'><?php echo $post->post_status ?></p>
                    <?php
                    ?>
                    <style>
                        .course_column_status {
                            width: fit-content;
                            padding: 8px;
                            border-radius: 8px;
                            color: white !important;
                        }
                    </style>
<?php
                    break;
            }
        }
    }
}
