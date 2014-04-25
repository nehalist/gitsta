<div id="post-<?php the_ID(); ?>" class="item">
    <h3 style="margin-top: 0;">
        <a href="<?php the_permalink(); ?>" name="<?php the_ID(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h3>
    <div name="meta">
        <p class="text-muted">
            <i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>

            <i class="fa fa-folder-open" style="margin-left: 20px;"></i> 
            <?php
            echo get_the_category_list(', ');
            ?>

            <?php
            echo get_the_tag_list('<i class="fa fa-tags" style="margin-left: 20px;"></i> ',', ');
            ?>
            
            <?php
            if(comments_open()):
            ?>
            <i class="fa fa-comments" style="margin-left: 20px;"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number('No comments', '1 comment', '% comments'); ?></a>
            <?php
            endif;
            ?>
        </p>
    </div>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
</div>