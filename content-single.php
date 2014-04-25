<div id="post-<?php the_ID(); ?>" class="item <?php post_class(); ?>">
    <div name="meta">
        <p class="text-muted">
            <i class="fa fa-calendar"></i> <?php echo the_date(); ?>

            <i class="fa fa-folder-open" style="margin-left: 20px;"></i> 
            <?php
            echo get_the_category_list(', ');
            ?>

            <?php
            echo get_the_tag_list('<i class="fa fa-tags" style="margin-left: 20px;"></i> ',', ');
            ?>
            
            <span class="pull-right">
                 <?php edit_post_link('Edit'); ?> 
            </span>
        </p>
    </div>
    <div class="post-content">
        <?php 
        the_content();
        ?>
    </div>
</div>