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
        <?php $gitsta_options = get_option('gitsta_theme_options'); ?>

        <table class="wp-list-table widefat pages">
            <tr class="alternate">
                <td colspan="2"><h3>Global</h3></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Comment Markdown Support</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[comment_markdown_support]" type="checkbox" name="gitsta_theme_options[comment_markdown_support]" value="1" <?php echo (isset($gitsta_options['comment_markdown_support']) && $gitsta_options['comment_markdown_support'] == 1 ? 'checked' : ''); ?> /></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Gitsta Native Shortcodes</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[gitsta_native_shortcodes]" type="checkbox" name="gitsta_theme_options[gitsta_native_shortcodes]" value="1" <?php echo (isset($gitsta_options['gitsta_native_shortcodes']) && $gitsta_options['gitsta_native_shortcodes'] == 1 ? 'checked' : ''); ?> /></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 25%;">Blog description on frontpage</th>
                <td style="width: 75%;"><input id="gitsta_theme_options[frontpage_blog_descr]" type="checkbox" name="gitsta_theme_options[frontpage_blog_descr]" value="1" <?php echo (isset($gitsta_options['frontpage_blog_descr']) && $gitsta_options['frontpage_blog_descr'] == 1 ? 'checked' : ''); ?> /></td>
            </tr>
            <tr>
                <td></td>
                <td><?php submit_button(); ?></td>
            </tr>
        </table>
    </form>
</div>