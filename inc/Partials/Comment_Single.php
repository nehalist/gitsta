<li id="comment-<?php comment_ID(); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>">
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
        <div class="pull-left">
            <?php
            // Print avatar
            if ($args['avatar_size'] > 0) {
                echo get_avatar($comment->comment_author_email, $args['avatar_size']);
            }
            ?>
        </div>

        <div class="media-body comment">
            <div class="media-body-wrap panel panel-default <?= (($comment->comment_approved == 0) ? 'panel-warning' : ''); ?> comment">
                <div class="panel-heading">
                    <b><?= $comment->comment_author; ?></b>
                    
                    <?php
                    if($comment->comment_author_url != ""):
                    ?>
                    <a href="<?= $comment->comment_author_url; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?= $comment->comment_author_url; ?>"><i class="fa fa-home"></i></a>
                    <?php
                    endif;
                    ?>
                    
                    <span class="text-muted"><small><?= ThemeComments::timeElapsedString($comment->comment_date); ?></small></span>

                    <span class="pull-right">
                        <?= edit_comment_link('Edit', '', ' /'); ?>
                        <?= get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply'))); ?>
                    </span>

                    <?php if ($comment->comment_approved == 0) : ?>
                        <p class="pull-right text-muted"><?php _e('Your comment is awaiting moderation.', '_tk'); ?> </p>
                    <?php endif; ?>
                </div>

                <div class="comment-content panel-body">
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>

    </article>
</li>