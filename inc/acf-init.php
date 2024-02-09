<?php
/*
* Include ACF
*/
class Efy_ACF_Integration {
    protected $acf_path;
    protected $acf_url;

    public function __construct($acf_path, $acf_url) {
        $this->acf_path = $acf_path;
        $this->acf_url = $acf_url;
    }

    public function initialize() {
        if (!class_exists('ACF')) {
            // Set ACF settings URL
            add_filter('acf/settings/url', array($this, 'acf_settings_url'));

            // Include the ACF plugin.
            include_once($this->acf_path . 'acf.php');

            // Hide the ACF admin menu item.
            //add_filter('acf/settings/show_admin', '__return_false');
        }
    }

    public function acf_settings_url($url) {
        return $this->acf_url;
    }
}


class Efy_ACF_Field_Importer {
    private $json_file;

    public function __construct($json_file) {
        $this->json_file = $json_file;
        add_action('after_setup_theme', array($this, 'import_field_groups_from_json'));
    }

    public function import_field_groups_from_json() {
        if (function_exists('acf_add_local_field_group') && file_exists($this->json_file)) {
            $json_data = file_get_contents($this->json_file);
            $field_group = json_decode($json_data, true);
            if (is_array($field_group)) {
                acf_add_local_field_group($field_group);
            }
        }
    }
}
