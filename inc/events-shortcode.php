<?php

add_shortcode('events', 'event_shortcode');

function event_shortcode($atts) {
    $atts = shortcode_atts(array(
        'events_number' => 5,
        'events_order' => 'ID'
            ), $atts);

    $args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'orderby' => $atts['events_order'],
        'posts_per_page' => $atts['events_number'],
    );
    $events = '';
    $events_query = new WP_Query($args);
    if ($events_query->have_posts()) :
        $events .= '<div class="events-lists">';

        while ($events_query->have_posts()) : $events_query->the_post();
            $events .= '<div class="items">';
            $events .= '<a href="' . get_permalink() . '">';
            $events .= get_the_title();
            $events .= get_the_post_thumbnail();
            $events .= get_the_excerpt();
            $events .= get_post_meta(get_the_ID(), 'wpe_end_date', TRUE);
            $events .= '</a></div>';
        endwhile;
        wp_reset_postdata();
        $events .= '</div>';
    endif;
    return $events;
}
