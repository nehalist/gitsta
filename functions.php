<?php
require_once 'inc/BootstrapNavMenuWalker.php';
require_once 'inc/Comments.php';

/*
|----------------------------------------------------------
| Actions
|----------------------------------------------------------
*/
// Bootstrap menu walker
// by Johnny Megahan <http://johnmegahan.me/>
add_action('after_setup_theme', 'bootstrap_setup');


/*
|----------------------------------------------------------
| Sidebar
|----------------------------------------------------------
|
| Sidebar is hidden on mobile devices
|
*/
if(function_exists('register_sidebar')) {
    register_sidebar(array(
        'before_widget' => '<div id="%1$s" class="widget hidden-xs">',
        'after_widget'  => '</div>'
    ));
}



/*
|----------------------------------------------------------
| Filters
|----------------------------------------------------------
*/
// Hides admin bar
add_filter('show_admin_bar', '__return_false');

// Add some css classes to images
add_filter('the_content', function($content) {
    $pattern        = "/<img(.*?)class=\"(?!wp-smiley)(.*?)\"(.*?)>/i";
    $replacement    = '<img$1class="$2 img-thumbnail img-responsive"$3>';
    $content        = preg_replace($pattern, $replacement, $content);
    return $content;
});

// Adds some css classes to avatars
add_filter('get_avatar', function($avatar) {
    $avatar = str_replace("class='avatar",
                          "class='avatar media-object img-rounded",
                          $avatar);
    return $avatar;
});

// Add css class to tags
add_filter('the_tags', function($tag) {
    $tag = str_replace('rel="tag">',
                       'rel="tag" class="label label-primary">',
                       $tag);
    
    return $tag;
});


/*
|----------------------------------------------------------
| Theme options
|----------------------------------------------------------
*/
add_action('admin_init', function() {
    register_setting('gitsta_options', 'gitsta_theme_options', function($input) {
        return $input;
    });
});
add_action('admin_menu', function() {
    add_theme_page('Gitsta', 'Gitsta', 'edit_theme_options', 'gitsta-option', function() {
        include 'inc/Partials/ThemeOptions.php';
    });
});

