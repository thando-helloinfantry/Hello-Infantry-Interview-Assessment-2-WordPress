<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <div class="site-header__inner">
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                    <?php bloginfo( 'name' ); ?>
                </a>
                <p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
            </div>

            <nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'hi-developer-theme' ); ?>">
                <?php
                // BUG #9: theme_location is 'primary' but the registered slug
                // in functions.php is 'primary_nav' — menu won't display
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => false,
                ) );
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="site-content">
