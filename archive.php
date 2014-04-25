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
                printf('Author: %s', get_the_author());
            }
            
            elseif (is_day()) {
                printf('Day: %s', get_the_date());
            }
                
            elseif (is_month()) {
                printf('Month: %s', get_the_date('F Y'));
            }
            
            elseif (is_year()) {
                printf('Year: %s', get_the_date(_x('Y')));
            }

            else {
                echo 'Archives';
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
            </div>
            <div class="col-md-2">
                <?php get_sidebar(); ?>
            </div>
        </div>
        
<?php get_footer(); ?>
