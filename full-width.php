<?php /*
Template Name: Full Width */
get_header(); ?>

    <div class="subhead">
        <div class="container">
            <h3><?php the_title(); ?></h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('content', 'page'); ?>

                    <?php
                    // Comments
                    if (comments_open() || '0' != get_comments_number()) {
                        comments_template();
                    }
                    ?>

                <?php endwhile; // end of the loop. ?>
            </div>
        </div>

<?php
get_footer(); ?>