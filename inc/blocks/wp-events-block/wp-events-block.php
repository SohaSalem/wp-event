<?php

add_action('enqueue_block_editor_assets', 'wp_events_block');

function wp_events_block() {

    wp_enqueue_script(
            'wp-events', plugins_url('index.js', __FILE__), array('wp-blocks', 'wp-element', 'wp-components', 'wp-editor')
    );
}

register_block_type('wp-events-gutenberg/wp-events-block', array(
    'render_callback' => 'wp_events_block_callback'
));

function wp_events_block_callback($attributes) {
    if ($attributes['number_events'] == '')
        $attributes['number_events'] = 5;

    if ($attributes['order_by'] == '')
        $attributes['order_by'] = 'ID';


    $order = 'ASC';

    if ($attributes['order_by'] == 'date') {
        $order = 'DESC';
    }

    $args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'orderby' => $attributes['order_by'],
        'order' => $order,
        'posts_per_page' => $attributes['number_events'],
    );
    $events = '';

    $events_query = new WP_Query($args);
    if ($events_query->have_posts()) :
        $events = '<ul class="event-items">';
        while ($events_query->have_posts()) : $events_query->the_post();
            $events .= '<li class="items">';
            $events .= '<a href="' . get_permalink() . '">';
            $events .= get_the_title();
            $events .= get_the_post_thumbnail();
            $events .= get_the_excerpt();
            $events .= '<br><span>' . get_post_meta(get_the_ID(), 'wpe_start_date', TRUE) . '</span>';
            $events .= '</a></li>';
        endwhile;
        $events .= '</ul>';
        return $events;
    endif;
}
