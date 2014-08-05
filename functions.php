<?php
require_once 'inc/BootstrapNavMenuWalker.php';
require_once 'inc/Comments.php';

// Bootstrap menu walker
// by @johnmegahan <http://johnmegahan.me/>
add_action('after_setup_theme', 'gitsta_bootstrap_setup');

// TGM Plugin Activation <http://tgmpluginactivation.com/>
// Thanks to @EmilUzelac
require_once 'inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', function() {
    $plugins = array(
        array(
            'name'      => 'WP-Markdown',
            'slug'      => 'wp-markdown',
            'required'  => false,
        ),
        array(
            'name'      => 'Gust',
            'slug'      => 'gust',
            'required'  => false
        )
    );
    
    tgmpa($plugins);
});


/*
|----------------------------------------------------------
| Gitsta Theme Setup
|----------------------------------------------------------
*/
add_action('after_setup_theme', function() {
    // Content width - required by WordPress
    global $content_width;
    if( ! isset($content_width)) {
        $content_width = 945;
    }
    
    // Theme support
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');

    // Title hook
    add_action('wp_title', function($title) {
        return get_bloginfo('name') . $title;
    });
    
    // Scripts and styles used by the theme
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.css');
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/vendor/font-awesome/css/font-awesome.css');
        wp_enqueue_style('octicons', get_template_directory_uri() . '/vendor/octicons/css/octicons.css');

        wp_enqueue_script('jquery');
        wp_enqueue_script('require-js', get_template_directory_uri() . '/vendor/require.js');
        wp_enqueue_script('gitsta-main-js', get_template_directory_uri() . '/js/main.js');
        
        wp_localize_script('gitsta-main-js', 'theme', array('template_directory_uri' => get_template_directory_uri()));
    });
    
    
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
    // CSS Style for reply link
    add_filter('comment_reply_link', function($link) {
        $link = str_replace("class='comment-reply-link'", "class='comment-reply-link btn btn-default btn-xs' data-scroll='true'", $link);
        return $link;
    });
    
    // CSS Style for edit comment link
    add_filter('edit_comment_link', function($link) {
        $link = str_replace('class="comment-edit-link"', "class='comment-edit-link btn btn-default btn-xs'", $link);
        return $link;
    });
    
    // CSS Style for edit post link
    add_filter('edit_post_link', function($link) {
        $link = str_replace('class="post-edit-link"', "class='post-edit-link btn btn-info btn-xs'", $link);
        return $link;
    });
    
    // Hide admin bar
    add_filter('show_admin_bar', '__return_false');

    // Add some css classes to images
    add_filter('the_content', function($content) {
        $pattern        = "/<img(.*?)class=\"(?!wp-smiley)(.*?)\"(.*?)>/i";
        $replacement    = '<img$1class="$2 img-thumbnail img-responsive"$3>';
        $content        = preg_replace($pattern, $replacement, $content);
        return $content;
    });
    
    // Add bootstrap css classes to tables
    add_filter('the_content', function($content) {
        $pattern        = "/<table(.*?)>/i";
        $replacement    = '<table $1 class="table table-bordered table-striped">';
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
    
    // Code tags
    add_filter('the_content', function($content) {
        $pattern        = "/<pre(.*?)>/i";
        $replacement    = '<div class="code-box"><div class="code-title"><i class="fa fa-code"></i> <div class="pull-right"><a href="#" class="btn btn-default btn-xs toggle-code" data-toggle="tooltip" title="Toggle code"><i class="fa fa-toggle-up"></i></a></div></div><pre $1>';
        $content        = preg_replace($pattern, $replacement, $content);
       
        $pattern        = "/<\/pre>/";
        $replacement    = '</pre></div>';
        $content        = preg_replace($pattern, $replacement, $content);
        
        return $content;
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
    
    
    /*
    |----------------------------------------------------------
    | Shortcodes
    |----------------------------------------------------------
    */
    $gitsta_theme_options = get_option('gitsta_theme_options');
    if(isset($gitsta_theme_options['gitsta_native_shortcodes']) && $gitsta_theme_options['gitsta_native_shortcodes'] == 1) {
        include 'inc/Shortcodes.php';
    }
    
    
    /*
    |----------------------------------------------------------
    | Custom wp_link_pages function
    |----------------------------------------------------------
    */
    function gitsta_wp_link_pages($args = '') {
        $defaults = array(
            'before'           => '',
            'after'            => '',
            'prev_and_next'    => true,
            'nextpagelink'     => '&raquo;',
            'prevpagelink'     => '&laquo;',
            'echo'             => true
        );
        
        $r = wp_parse_args($args, $defaults);
        extract($r, EXTR_SKIP);
        
        global $page, $numpages, $multipage, $more;
        
        $output = '';
        if($multipage) {
            $output .= $before . '<ul class="pagination">';
            
            // Attach prev link
            $i = ($page - 1);
            if(($i > 0) && $prev_and_next) {
                $output .= '<li>' . _wp_link_page($i) . $nextpagelink . '</a></li>';
            }
            
            // Attach page numbers
            for($i = 1; $i <= $numpages; $i++) {
                $link = '';
                if($i == $page) {
                    $link .= '<li class="active"><a href="#">' . $i . '</li>';
                } else {
                    $link .= '<li>' . _wp_link_page($i) . $i . '</a></li>';
                }
                
                $link    = apply_filters('wp_link_pages_link', $link, $i);
                $output .= $link;
            }
            
            // Attach next link
            $i = ($page + 1);
            if(($i <= $numpages) && $prev_and_next) {
                $output .= '<li>' . _wp_link_page($i) . $prevpagelink . '</a></li>';
            }
            
            $output .= '</ul>' . $after;
        }
        
        $output = apply_filters('wp_link_pages', $output, $args);
        if($echo) {
            echo $output;
        }
    }
});