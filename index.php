<?php get_header(); ?>
        
    <div class="container">
        <div class="row">
            <div class="col-md-10" style="min-height: 230px;">
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
                
                <ul class="pager">
                    <li class="previous"><?php next_posts_link( 'Older posts' ); ?></li>
                    <li class="next"><?php previous_posts_link( 'Newer posts' ); ?></li>
                </ul>
            </div>
            <div class="col-md-2">
                <?php get_sidebar(); ?>
            </div>
        </div>

<?php get_footer(); ?>
