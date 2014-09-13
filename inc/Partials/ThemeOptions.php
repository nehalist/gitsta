<?php
if ( ! isset( $_REQUEST['settings-updated'] ) ) {
    $_REQUEST['settings-updated'] = false;
}
?>

<div class="wrap"> 
    <h2>Gitsta Options</h2>
    
    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
    <div class="updated fade">
        <p><strong>Saved!</strong></p>
    </div>
    <?php endif; ?>

    <form method="post" action="options.php">
        <?php settings_fields('gitsta_options'); ?>

        <table class="wp-list-table widefat pages">
            <tr class="alternate">
                <td colspan="2"><h3>General</h3></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Favicon URL</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[favicon_url]" type="text" name="gitsta_theme_options[favicon_url]" value="<?php echo stripslashes(get_gitsta_theme_option('favicon_url')); ?>" style="width: 40%;"></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Comment Markdown Support</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[comment_markdown_support]" type="checkbox" name="gitsta_theme_options[comment_markdown_support]" value="1" <?php checked(true, get_gitsta_theme_option('comment_markdown_support')); ?> ></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Gitsta Native Shortcodes</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[gitsta_native_shortcodes]" type="checkbox" name="gitsta_theme_options[gitsta_native_shortcodes]" value="1" <?php checked(true, get_gitsta_theme_option('gitsta_native_shortcodes')); ?> ></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Blog description on frontpage</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[frontpage_blog_descr]" type="checkbox" name="gitsta_theme_options[frontpage_blog_descr]" value="1" <?php checked(true, get_gitsta_theme_option('frontpage_blog_descr')); ?> ></td>
            </tr>
            <tr>
                <td></td>
                <td><?php submit_button(); ?></td>
            </tr>
            
            <tr class="alternate">
                <td colspan="2"><h3>Error 404 Page</h3></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Title</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[error_404_title]" type="text" name="gitsta_theme_options[error_404_title]" value="<?php echo stripslashes(get_gitsta_theme_option('error_404_title')); ?>" style="width: 40%;"></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Content</th>
                <td style="width: 75%;">
                    <?php
                    wp_editor(__(get_gitsta_theme_option('error_404_content')), 'terms_wp_content', array(
                        'textarea_name' => 'gitsta_theme_options[error_404_content]',
                        'textarea_rows' => 14,
                        'teeny'         => true
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><?php submit_button(); ?></td>
            </tr>
        </table>
    </form>
</div>