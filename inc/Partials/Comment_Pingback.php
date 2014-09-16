<li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
    <div class="pull-left text-center" style="width: 55px; height: 50px; line-height: 50px;">
        <span class="text-muted">
            <i class="fa fa-retweet fa-2x"></i>
        </span>
    </div>

    <div class="media-body" style="line-height: 40px; padding-left: 10px;">
        <div class="media-body-wrap">
            <b><?php echo $comment->comment_author; ?></b>

            <?php
            if($comment->comment_author_url != ""):
            ?>
            <a href="<?php echo $comment->comment_author_url; ?>" target="_blank"><i class="fa fa-home"></i></a>
            <?php
            endif;
            ?>

            <span class="text-muted"><small><?php echo Gitsta_ThemeComments::timeElapsedString($comment->comment_date); ?></small></span>

            <span class="pull-right">
                <?php echo edit_comment_link('<i class="fa fa-edit"></i> ' . __('Edit', 'gitsta')); ?>
            </span>
        </div>
    </div>
</li>