<?php
class Efy_Register_Custom_Endpoint {
    // Properties
    private $post_type;
    private $acf_fields;

    // Constructor
    public function __construct($post_type, $acf_fields = array()) {
        $this->post_type = $post_type;
        $this->acf_fields = $acf_fields;
        add_action('rest_api_init', array($this, 'register_endpoints'));
    }

    // Method to register REST API endpoints
    public function register_endpoints() {
        register_rest_route('efy/v1', '/' . $this->post_type, array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array($this, 'get_all_items'),
            'permission_callback' => '__return_true'
        ));

        register_rest_route('efy/v1', '/' . $this->post_type . '/(?P<id>\d+)', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array($this, 'get_single_item'),
            'permission_callback' => '__return_true'
        ));
        register_rest_route('efy/v1', '/' . $this->post_type . '/(?P<slug>[a-zA-Z0-9-_]+)', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array($this, 'get_single_item_by_slug'),
            'permission_callback' => '__return_true'
        ));
    }

    // Method to retrieve a list of all items
    public function get_all_items($request) {
        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => -1, // Retrieve all items
            'post_status' => 'publish', // Only retrieve published items
        );

        $items = get_posts($args);

        $formatted_items = array();
        foreach ($items as $item) {
            $formatted_item = $this->format_item($item);
            $formatted_items[] = $formatted_item;
        }

        return rest_ensure_response($formatted_items);
    }

    // Method to retrieve a single item by ID
    public function get_single_item($request) {
        $id = $request['id'];
        $item = get_post($id);

        if (!$item || $item->post_type !== $this->post_type || $item->post_status !== 'publish') {
            return new WP_Error('not_found', 'Item not found', array('status' => 404));
        }

        $formatted_item = $this->format_item($item);
        return rest_ensure_response($formatted_item);
    }

      // Method to retrieve a single item by slug
      public function get_single_item_by_slug($request) {
        $slug = $request['slug'];
        $item = get_page_by_path($slug, OBJECT, $this->post_type);

        if (!$item || $item->post_type !== $this->post_type || $item->post_status !== 'publish') {
            return new WP_Error('not_found', 'Item not found', array('status' => 404));
        }

        $formatted_item = $this->format_item($item);
        return rest_ensure_response($formatted_item);
    }

    // Method to format item data
    private function format_item($item) {
        $formatted_item = array(
            'id' => $item->ID,
            'title' => wp_kses_post($item->post_title),
            'slug' => wp_kses_post($item->post_name),
            'content' => wp_kses_post(apply_filters('the_content', $item->post_content)),
        );

        // Add ACF fields if provided
        foreach ($this->acf_fields as $acf_field) {
            $field_value = get_field($acf_field, $item->ID);
            $formatted_item[$acf_field] = is_array($field_value) ? array_map('wp_kses_post', $field_value) : wp_kses_post($field_value);
        }

        // Add thumbnail URLs
        foreach (array('full', 'medium', 'thumbnail') as $size) {
            $formatted_item['thumbnail'][$size] = esc_url(get_the_post_thumbnail_url($item->ID, $size));
        }

        return $formatted_item;
    }
}