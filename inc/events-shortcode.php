<?php

add_shortcode('events', 'event_shortcode');

function event_shortcode($atts) {
    $atts = shortcode_atts(array(
        'events_number' => 5,
        'events_order' => 'ID'
            ), $atts);

    $order = 'ASC';

    if ($atts['events_order'] == 'date') {
        $order = 'DESC';
    }
    $args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'orderby' => $atts['events_order'],
        'order' => $order,
        'posts_per_page' => $atts['events_number'],
    );
    $events = '';
    $events_query = new WP_Query($args);
    if ($events_query->have_posts()) :
        $events .= '<ul class="events-lists">';
        while ($events_query->have_posts()) : $events_query->the_post();
            $events .= '<li class="items">';
            $events .= '<a href="' . get_permalink() . '">';
            $events .= get_the_title();
            $events .= '<span>' . get_post_meta(get_the_ID(), 'wpe_start_date', TRUE) . '</span>';
            $events .= get_the_post_thumbnail();
            $events .= get_the_excerpt();
            $events .= '</a></li>';
        endwhile;
        wp_reset_postdata();
        $events .= '</ul>';
    endif;
    return $events;
}
