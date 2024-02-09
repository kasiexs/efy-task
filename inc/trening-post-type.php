<?php
/*
Register Custom Post Type for Trening
*/
if ( ! function_exists( 'efy_trening_post_type' ) ) {

    add_action( 'init', 'efy_trening_post_type' );
    function efy_trening_post_type()
    {
        $labels = array(
            'name' => __('Trening', 'efy-theme'),
            'singular_name' => __('Trening', 'efy-theme'),
            'add_new' => __('Dodaj nowy', 'efy-theme'),
            'add_new_item' => __('Dodaj nowy trening', 'efy-theme'),
            'edit_item' => __('Edytuj trening', 'efy-theme'),
            'new_item' => __('Nowy trening', 'efy-theme'),
            'view_item' => __('Zobacz trening', 'efy-theme'),
            'search_items' => __('Szukaj', 'efy-theme'),
            'not_found' => __('Nie znaleziono', 'efy-theme'),
            'not_found_in_trash' => __('Nie znaleziono w koszu', 'efy-theme')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicy_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'trening'),
            'show_in_rest' => true,
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'template' => [['core/freeform']],
            'template_lock' => 'all',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => array('title', 'editor', 'thumbnail'),
        );
        register_post_type('trening', $args);
    }
}

