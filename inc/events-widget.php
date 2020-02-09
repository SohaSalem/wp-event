<?php
// Register and load the widget
add_action('widgets_init', 'event_load_widget');

function event_load_widget() {
    register_widget('event_widget');
}

// Creating the widget 
class Event_Widget extends WP_Widget {

    function __construct() {
        parent::__construct('event_widget', __('Event Widget', 'wp-events'));
    }

    public function widget($args, $instance) {
        $title = __('Events', 'wp-events');
        $number = (!empty($instance['number']) ) ? absint($instance['number']) : 5;
        $sortby = (!empty($instance['sortby']) ) ? $instance['sortby'] : 'ID';

        $title = apply_filters('widget_title', $title);
        $order = 'ASC';

        if ($sortby == 'date') {
            $order = 'DESC';
        }
        $args_filter = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'orderby' => $sortby,
            'order' => $order,
            'posts_per_page' => $number
        );

        $events_query = new WP_Query($args_filter);
        if (!$events_query->have_posts()) {
            return;
        }
        echo $args['before_widget'];
        ?>
        <div class="widget-header">
            <h4 class="widgettitle"><?php echo $title ?></h4>
        </div>
        <?php
        include WPE_PLUGIN_FILE . '/templates/event-widget.php';
    }

    public function form($instance) {
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $sortby = isset($instance['sortby']) ? $instance['sortby'] : 'ID';
        ?>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'wp-events'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('sortby')); ?>"><?php _e('Sort Events by:', 'wp-events'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('sortby')); ?>" id="<?php echo esc_attr($this->get_field_id('sortby')); ?>" class="widefat">
                <option value="ID"<?php selected($sortby, 'ID'); ?>><?php _e('Event ID', 'wp-events'); ?></option>
                <option value="title"<?php selected($sortby, 'title'); ?>><?php _e('Event Title', 'wp-events'); ?></option>
                <option value="date"<?php selected($sortby, 'date'); ?>><?php _e('Event Date', 'wp-events'); ?></option>
                <option value="name"<?php selected($sortby, 'name'); ?>><?php _e('Event Slug', 'wp-events'); ?></option>
            </select>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['number'] = (!empty($new_instance['number']) ) ? strip_tags($new_instance['number']) : '';
        $instance['sortby'] = (!empty($new_instance['sortby']) ) ? strip_tags($new_instance['sortby']) : '';
        return $instance;
    }

}
