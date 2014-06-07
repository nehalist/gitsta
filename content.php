<div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
    <h2 style="margin-top: 0;">
        <a href="<?php the_permalink(); ?>" name="<?php the_ID(); ?>" rel="bookmark" class="post-title"><?php the_title(); ?></a>
    </h2>
    <div name="meta">
        <p class="text-muted">
            <i class="fa fa-calendar"></i>
            <?php
            if(trim(get_the_title()) != "") {
                echo get_the_date();
            } else {
                echo '<a href="'. get_the_permalink() .'" name="'. get_the_ID() .'" rel="bookmark">'. get_the_date() .'</a>';
            }
            ?>

            <i class="fa fa-folder-open" style="margin-left: 20px;"></i> 
            <?php
            echo get_the_category_list(', ');
            ?>

            <?php
            if(comments_open()):
            ?>
            <i class="fa fa-comments" style="margin-left: 20px;"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number('No comments', '1 comment', '% comments'); ?></a>
            <?php
            endif;
            ?>

            <?php
            echo get_the_tag_list('<i class="fa fa-tags" style="margin-left: 20px;"></i> ',', ');
            ?>
        </p>
    </div>
    <div class="post-content">
        <?php
        if(has_post_thumbnail()) {
            the_post_thumbnail();
        }
        
        the_content(); ?>
    </div>
</div>