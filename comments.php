<?php
if(post_password_required()) {
    return;
}
?>

<!-- Comments anchor -->
<a name="comments"></a>

<?php if ( have_comments() ) : ?>
    <header class="page-header text-right">
        <h4 class="comments-title">
            <?php
            printf(
                _nx('One comment',
                    '%1$s comments',
                    get_comments_number(),
                    null,
                    '_THEME'
                ), 
                number_format_i18n(
                    get_comments_number()
                )
            );
            ?>
        </h4>
    </header>

    <ol class="comment-list media-list">
        <?php
        // Comments
        // see inc/Comments.php, inc/Partials/*.php
        wp_list_comments(array('callback' => 'Gitsta_ThemeComments::format', 'avatar_size' => 50));
        ?>
    </ol>

    <?php if((get_comment_pages_count() > 1) && (get_option('page_comments'))): ?>
    <ul class="pager">
        <li class="previous"><?php previous_comments_link('Older comments'); ?></li>
        <li class="next"><?php next_comments_link('Newer comments'); ?></li>
    </ul>
    <?php endif; // Comment navigation ?>

<?php endif; // have_comments() ?>

<hr>

<?php
// Comment form
if(comments_open()):
?>
<a name="respond"></a>
<div class="comment-body media" id="respond">
    <div class="pull-left" href="#">
        <?php
        // Show avatar for logged users
        
        global $current_user;
        get_currentuserinfo();
        
        echo get_avatar($current_user->user_email, 50); 
        ?>
    </div>

    <div class="media-body comment">
        <div class="media-body-wrap panel panel-default comment">
            <div class="panel-heading" style="padding-bottom: 0;">
                <ul class="nav nav-tabs" style="position: relative; top: 1px;">
                    <li class="active"><a href="#write" data-toggle="tab"><i class="fa fa-pencil"></i> Reply</a></li>
                    <?php
                    $gitsta_theme_options = get_option('gitsta_theme_options');
                    
                    // These tabs are hidden, if markdown support option is disabled
                    if(isset($gitsta_theme_options['comment_markdown_support']) && $gitsta_theme_options['comment_markdown_support'] == 1):
                    ?>
                    <li><a href="#preview" data-toggle="tab" class="preview-reply"><i class="fa fa-eye"></i> Preview</a></li>
                    <li><a href="#help" data-toggle="tab" class="preview-reply"><i class="fa fa-question"></i> Help</a></li>
                    <?php
                    endif;
                    ?>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="write" class="tab-pane active">
                        <?php
                        $gitsta_form_commenter  = wp_get_current_commenter();
                        $gitsta_form_req        = get_option('require_name_email');
                        $gitsta_form_aria_req   = ($req ? " aria-required='true'" : '');
                        
                        $gitsta_form_author = '<div class="row">
                                <div class="col-md-4">
                                    <input class="form-control" placeholder="Name" id="author" name="author" type="text" value="' . esc_attr($gitsta_form_commenter['comment_author']) . '" size="30"' . $gitsta_form_aria_req . ' />
                            </div>';

                        $gitsta_form_mail = '<div class="col-md-4">
                                <input class="form-control" placeholder="E-Mail" id="email" name="email" type="text" value="' . esc_attr($gitsta_form_commenter['comment_author_email']) . '" size="30"' . $gitsta_form_aria_req . ' />
                            </div>';

                        $gitsta_form_url = '<div class="col-md-4">
                                <input class="form-control" placeholder="URL" id="url" name="url" type="text" value="' . esc_attr($gitsta_form_commenter['comment_author_url']) . '" size="30" />
                            </div>
                        </div><!-- /row -->';

                        // Call the comments form
                        comment_form(array(
                            'title_reply'           => '</h3>',
                            'title_reply_to'        => '</h3><div class="alert alert-info">Replying to %s. '.cancel_comment_reply_link('Click here to cancel reply.').'</div>',
                            'cancel_reply_link'     => '<em></em>',
                            'label_submit'          => 'Post comment',
                            'fields'                => array(
                                'author' =>
                                $gitsta_form_author,
                                
                                'email' =>
                                $gitsta_form_mail,
                                
                                'url' =>
                                $gitsta_form_url
                            ),
                            'comment_field'         => '<br><p><textarea placeholder="Markdown enabled" id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                            'comment_notes_after'   => '',
                            'comment_notes_before'  => ''
                        ));
                        ?>
                    </div>
                    
                    <?php
                    // These tabs are hidden, if markdown support option is disabled
                    if(isset($gitsta_theme_options['comment_markdown_support']) && $gitsta_theme_options['comment_markdown_support'] == 1):
                    ?>
                    
                    <div id="preview" class="tab-pane">
                        <!-- Markdown preview tab -->
                        <div id="markdown-preview"></div>
                    </div>
                    
                    <div id="help" class="tab-pane">
                        <!-- Markdown help tab -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Markdown</th>
                                    <th style="width: 50%;">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>*text*</td>
                                    <td><i>text</i></td>
                                </tr>
                                <tr>
                                    <td>**text**</td>
                                    <td><b>text</b></td>
                                </tr>
                                <tr>
                                    <td>***text***</td>
                                    <td><i><b>text</b></i></td>
                                </tr>
                                <tr>
                                    <td>`code`</td>
                                    <td><code>code</code></td>
                                </tr>
                                <tr>
                                    <td>~~~<br>
                                    more code
                                    <br>~~~~</td>
                                    <td>
                                        <pre>
more code</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td>[Link](http://www.example.com)</td>
                                    <td><a href="http://www.example.com">Link</a></td>
                                </tr>
                                <tr>
                                    <td>* Listitem</td>
                                    <td><ul><li>Listitem</li></ul></td>
                                </tr>
                                <tr>
                                    <td>> Quote</td>
                                    <td><blockquote>Quote</blockquote></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php endif; // if markdown support for comments is enabled ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php endif; ?>