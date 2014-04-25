<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= get_bloginfo('name'); ?><?php wp_title(); ?></title>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        
        <!-- Bootstrap and Font Awesome -->
        <link href="<?php get_template_directory_uri(); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php get_template_directory_uri(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Theme style -->
        <link href="<?php get_template_directory_uri(); ?>" rel="stylesheet">
        
        <?php
        if(is_singular()) {
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
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><?php get_bloginfo('name'); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    // Navigation
                    $args = array(
                        'depth'         => 0,
                        'container'     => false,
                        'menu_class'    => 'nav navbar-nav',
                        'walker'        => new Bootstrap_Walker_Nav_Menu()
                    );

                    wp_nav_menu($args);
                    
                    // see searchform.php
                    get_search_form();
                    ?>
                    <div class="btn-group pull-right">
                        <?php
                        // Dropdown for anonymous users
                        if( ! current_user_can('level_0')):
                        ?>
                        <a href="#" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Anonymous <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php home_url(); ?>/wp-login.php" href="#login">Login</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php home_url(); ?>/wp-register.php">Register</a></li>
                            <li><a href="<?php home_url(); ?>/wp-login.php?action=lostpassword">Lost password</a></li>
                        </ul>
                        
                        <?php
                        // Dropdown for logged users
                        else:
                            global $current_user;
                        ?>
                        <a href="#" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $current_user->user_login; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php home_url(); ?>/wp-admin/">Dashboard</a></li>

                            <?php
                            // A link for gust, if installed
                            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                            if(current_user_can('publish_posts') && is_plugin_active('gust/gust.php')):
                            ?>
                            <li><a href="<?php home_url(); ?>/gust">Gust</a></li>
                            <?php
                            endif;
                            ?>

                            <li><a href="<?php home_url(); ?>/wp-admin/profile.php">Edit profile</a></li>
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