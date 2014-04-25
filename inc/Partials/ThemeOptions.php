<?php
if ( ! isset( $_REQUEST['settings-updated'] ) ) {
    $_REQUEST['settings-updated'] = false; 
}
?>

<div class="wrap"> 
    <?php screen_icon(); ?><h2>Gitsta Options</h2>
    
    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
    <div class="updated fade">
            <p><strong>Saved!</strong></p>
    </div>
    <?php endif; ?>

  <form method="post" action="options.php">
        <?php settings_fields('gitsta_options'); ?>
        <?php $options = get_option('gitsta_theme_options'); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">Comment Markdown Support</th>
                <td><input id="gitsta_theme_options[comment_markdown_support]" type="checkbox" name="gitsta_theme_options[comment_markdown_support]" value="1" <?php echo (isset($options['comment_markdown_support']) && $options['comment_markdown_support'] == 1 ? 'checked' : ''); ?> /></td>
            </tr>  
        </table>

        <!-- submit -->
        <?php submit_button(); ?>
    </form>
</div>