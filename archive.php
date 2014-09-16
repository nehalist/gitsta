<?php get_header(); ?>
    <div class="subhead">
        <div class="container">
            <h3>
            <?php
            if (is_category()) {
                single_cat_title();
            }
            elseif (is_tag()) {
                single_tag_title();
            }
            elseif (is_author()) {
                printf(__('Author: %s', 'gitsta'), get_the_author());
            }
            elseif (is_day()) {
                printf(__('Day: %s', 'gitsta'), get_the_date());
            }
            elseif (is_month()) {
                printf(__('Month: %s', 'gitsta'), get_the_date('F Y'));
            }
            elseif (is_year()) {
                printf(__('Year: %s', 'gitsta'), get_the_date(_x('Y')));
            }
            else {
                echo __('Archives', 'gitsta');
            }
            ?>
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <?php if(have_posts()): ?>

                    <?php
                    // The loop!
                    while (have_posts()) : the_post();
                    ?>

                        <?php get_template_part('content'); ?>

                    <?php
                    endwhile; // End of the loop
                    ?>

                <?php else: ?>

                    <?php get_template_part('content', 'none'); ?>

                <?php endif; ?>
                
                <?php wp_link_pages(); ?>
                <ul class="pager">
                    <li class="previous"><?php next_posts_link( __('Older posts', 'gitsta') ); ?></li>
                    <li class="next"><?php previous_posts_link( __('Newer posts', 'gitsta') ); ?></li>
                </ul>
            </div>
            <div class="col-md-2">
                <?php get_sidebar(); ?>
            </div>
        </div>
        
<?php get_footer(); ?>
