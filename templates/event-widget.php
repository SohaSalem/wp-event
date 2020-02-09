
<ul class="events-lists">
    <?php
    while ($events_query->have_posts()) : $events_query->the_post();
        ?>
    <li class="items">
            <a href="<?php echo get_permalink(); ?>">
                <?php echo get_the_title(); ?>
                <span><?php echo get_the_excerpt(); ?></span>
                <span> <?php echo get_post_meta(get_the_ID(), 'wpe_start_date', TRUE); ?></span>
                <?php echo get_the_post_thumbnail(); ?>
            </a></li>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</ul>

