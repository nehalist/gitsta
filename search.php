<?php get_header(); ?>

    <div class="subhead">
        <div class="container">
            <h3>Results for: <em><?= get_search_query(); ?></em></h3>
        </div>
    </div>
    <div class="container">
	<div class="row">
            <div class="col-md-10">
                <?php if ( have_posts() ) : ?>

                    <?php while(have_posts()): the_post(); ?>

                        <?php
                        get_template_part('content');
                        ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <?php get_template_part('content', 'none'); ?>

                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <div class="bs-docs-sidebar with-subhead">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>

<?php get_footer(); ?>
