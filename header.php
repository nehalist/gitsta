<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title(); ?></title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        
        <!-- Theme style -->
        <link href="<?php echo bloginfo('stylesheet_url'); ?>" rel="stylesheet">
        
        <?php
        if(get_gitsta_theme_option('favicon_url') != ''):
        ?>
        <link rel="shortcut icon" href="<?php echo get_gitsta_theme_option('favicon_url'); ?>" type="image/x-icon">
        <?php
        endif;
        ?>
        
        <?php
        if(is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        wp_head();
        ?>
    </head>

    <body <?php body_class(); ?>>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!-- Nav button for small resolutions -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    <?php
                    // Navigation
                    $gitsta_nav_args = array(
                        'theme_location' => 'top-bar',
                        'menu'           => 'primary',
                        'container'      => false,
                        'menu_class'     => 'nav navbar-nav',
                        'walker'         => new wp_bootstrap_navwalker(),
                        'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
                    );

                    wp_nav_menu($gitsta_nav_args);
                    
                    // see searchform.php
                    get_search_form();
                    ?>
                    <div class="btn-group pull-right">
                        <?php
                        // Dropdown for anonymous users
                        if( ! is_user_logged_in()):
                        ?>
                        <a href="#" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Anonymous <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo wp_login_url(); ?>" href="#login">Login</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo wp_login_url(get_permalink()); ?>">Register</a></li>
                            <li><a href="<?php echo wp_lostpassword_url(); ?>">Lost password</a></li>
                        </ul>
                        
                        <?php
                        // Dropdown for logged users
                        else:
                            global $current_user;
                        ?>
                        <a href="#" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $current_user->user_login; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo admin_url(); ?>">Dashboard</a></li>

                            <?php
                            // A link for gust, if installed
                            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                            if(current_user_can('publish_posts') && is_plugin_active('gust/gust.php')):
                            ?>
                            <li><a href="<?php echo esc_url(home_url('/gust')); ?>">Gust</a></li>
                            <?php
                            endif;
                            ?>

                            <li><a href="<?php echo home_url(); ?>/wp-admin/profile.php">Edit profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo wp_logout_url('index.php'); ?>">Sign Out</a></li>
                        </ul>
                        <?php
                        endif; // End of dropdown for logged users
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Anchor for "Back to top"-Link -->
        <a name="top"></a>
        <?php
        if(is_front_page() && (get_gitsta_theme_option('frontpage_blog_descr') == 1)):
        ?>
        <div class="subhead">
            <div class="container">
                <h3><?php echo bloginfo('description'); ?></h3>
            </div>
        </div>
        <?php 
        endif;
        ?>
