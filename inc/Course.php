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
            'rewrite' => array(
                'slug' => 'course',
                'with_front' => false
            ),
            'taxonomies' => array('post_tag', 'module'),
            'labels' => array(
                'name' => 'Course',
                'add_new' => 'Add Course',
                'add_new_item' => 'Add New Course'

            )
        ));
        register_taxonomy('module', 'course', array(
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Modules',
                'add_new' => 'Add Modules',
                'add_new_item' => 'Add New Module'

            )
        ));
        register_taxonomy('faculty', 'course', array(
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Faculties',
                'add_new' => 'Add faculty',
                'add_new_item' => 'Add New faculty'

            )
        ));
        register_taxonomy('type', 'course', array(
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Type',
                'add_new' => 'Add type',
                'add_new_item' => 'Add New type'

            )
        ));
    }
    static function show_faculties()
    {
        $terms = get_terms(array(
            'taxonomy' => 'faculty',
            'hide_empty' => false,
        ));
        echo '<div class="container__faculties">';
        foreach ($terms as $term) {
?>
            <a href="<?php echo get_term_link($term, 'faculty') ?>">
                <div class="card__faculty">
                    <p><?php echo $term->name ?></p>
                </div>
            </a>
        <?php
        }
        echo '</div>';
    }
    static function show_modules()
    {
        $terms = get_terms(array(
            'taxonomy' => 'module',
            'hide_empty' => false,
        ));
        echo '<div class="container__modules">';

        foreach ($terms as $term) {
        ?>
            <a href="<?php echo get_term_link($term, 'module') ?>">
                <div class="card__module">
                    <p><?php echo $term->name ?></p>
                </div>
            </a>
            <?php
            var_dump(dirname(__FILE__));
        }
        echo '</div>';
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
