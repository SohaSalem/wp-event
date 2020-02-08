<?php

if (!class_exists('WP_EVENT_CPT')) {

    class WP_EVENT_CPT {

        public function __construct() {
            add_action('init', array($this, 'wp_event_cpt'));
            add_action('admin_enqueue_scripts', array($this, 'wp_event_enqueue_scripts'));
            add_action('add_meta_boxes', array($this, 'wp_event_register_meta_boxes'));
            add_action('save_post', array($this, 'wp_event_save_metadata'), 10, 3);
        }

        public function wp_event_cpt() {
            // Register Custom Post Type
            $labels = array(
                'name' => _x('Events', 'Post Type General Name', 'wp-events'),
                'singular_name' => _x('Event', 'Post Type Singular Name', 'wp-events'),
                'menu_name' => __('Events', 'wp-events'),
                'name_admin_bar' => __('Event', 'wp-events'),
                'archives' => __('Item Archives', 'wp-events'),
                'attributes' => __('Item Attributes', 'wp-events'),
                'parent_item_colon' => __('Parent Item:', 'wp-events'),
                'all_items' => __('All Events', 'wp-events'),
                'add_new_item' => __('Add New Event', 'wp-events'),
                'add_new' => __('Add New', 'wp-events'),
                'new_item' => __('New Event', 'wp-events'),
                'edit_item' => __('Edit Event', 'wp-events'),
                'update_item' => __('Update Event', 'wp-events'),
                'view_item' => __('View Event', 'wp-events'),
                'view_items' => __('View Events', 'wp-events'),
                'search_items' => __('Search Event', 'wp-events'),
                'not_found' => __('Not found', 'wp-events'),
                'not_found_in_trash' => __('Not found in Trash', 'wp-events'),
                'featured_image' => __('Featured Image', 'wp-events'),
                'set_featured_image' => __('Set featured image', 'wp-events'),
                'remove_featured_image' => __('Remove featured image', 'wp-events'),
                'use_featured_image' => __('Use as featured image', 'wp-events'),
                'insert_into_item' => __('Insert into item', 'wp-events'),
                'uploaded_to_this_item' => __('Uploaded to this item', 'wp-events'),
                'items_list' => __('Items list', 'wp-events'),
                'items_list_navigation' => __('Items list navigation', 'wp-events'),
                'filter_items_list' => __('Filter items list', 'wp-events'),
            );

            $args = array(
                'label' => __('Event', 'wp-events'),
                'description' => __('Event Description', 'wp-events'),
                'labels' => $labels,
                'supports' => array('title', 'editor', 'thumbnail','excerpt'),
                'taxonomies' => array('category', 'places'),
                'hierarchical' => false,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'capability_type' => 'page',
            );
            register_post_type('event', $args);
        }

        public function wp_event_enqueue_scripts() {
            global $post_type;
            if ($post_type != 'event')
                return;

            wp_enqueue_style('wp-event-jquery-ui-style', WPE_PLUGIN_URL . '/assets/css/jquery-ui/jquery-ui.min.css');

            wp_enqueue_script('wp-event-settings', WPE_PLUGIN_URL . 'assets/js/admin/wp-event-settings-script.js', array('jquery', 'jquery-ui-datepicker'));
        }

        public function wp_event_register_meta_boxes() {
            add_meta_box('wp-event-settings', __('Event Settings', 'wp-events'), array($this, 'wp_event_metadata'), 'event');
        }

        public function wp_event_metadata($post) {
            $post_id = $post->ID;
            $start_date = get_post_meta($post_id, 'wpe_start_date', true);
            $end_date = get_post_meta($post_id, 'wpe_end_date', true);

            require_once WPE_PLUGIN_FILE . '/inc/wp-event-metadata.php';
        }

        public function wp_event_save_metadata($event_id, $post, $update) {
            // Only set for post_type = post!
            if ('event' !== $post->post_type) {
                return;
            }
            $events_meta = array(
                'wpe_start_date',
                'wpe_end_date',
            );
            foreach ($events_meta as $event_meta) {
                if (isset($_POST[$event_meta]) && '' !== $_POST[$event_meta]) {
                    update_post_meta($event_id, $event_meta, $_POST[$event_meta]);
                }
            }
            return $event_id;
        }

    }

}


new WP_EVENT_CPT();
