<?php
/**
 * Hello Infantry Developer Theme — functions.php
 *
 * Theme setup, custom post types, and asset enqueueing.
 */

// ─── Theme Setup ────────────────────────────────────────────────────────────

function hi_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Register navigation menus
    // BUG #9: The menu location slug here doesn't match what's used in header.php
    register_nav_menus( array(
        'primary_nav' => __( 'Primary Menu', 'hi-developer-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'hi_theme_setup' );

// ─── Enqueue Styles ─────────────────────────────────────────────────────────

function hi_enqueue_assets() {
    // Enqueue the main theme stylesheet (style.css in theme root)
    wp_enqueue_style(
        'hi-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // BUG #8: Wrong dependency handle — 'hi-base-style' doesn't exist
    // This causes main.css to not load because WP won't enqueue a style
    // whose dependency hasn't been registered
    wp_enqueue_style(
        'hi-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'hi-base-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'hi_enqueue_assets' );

// ─── Custom Post Type: Projects ─────────────────────────────────────────────

function hi_register_project_cpt() {
    $labels = array(
        'name'               => __( 'Projects', 'hi-developer-theme' ),
        'singular_name'      => __( 'Project', 'hi-developer-theme' ),
        'add_new'            => __( 'Add New Project', 'hi-developer-theme' ),
        'add_new_item'       => __( 'Add New Project', 'hi-developer-theme' ),
        'edit_item'          => __( 'Edit Project', 'hi-developer-theme' ),
        'new_item'           => __( 'New Project', 'hi-developer-theme' ),
        'view_item'          => __( 'View Project', 'hi-developer-theme' ),
        'search_items'       => __( 'Search Projects', 'hi-developer-theme' ),
        'not_found'          => __( 'No projects found', 'hi-developer-theme' ),
        'not_found_in_trash' => __( 'No projects found in Trash', 'hi-developer-theme' ),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'projects' ),
        // BUG #10: has_archive is false — the archive-project.php template
        // will never be used, so /projects/ shows "Nothing found"
        'has_archive'  => false,
    );

    register_post_type( 'project', $args );
}
add_action( 'init', 'hi_register_project_cpt' );

// ─── ACF JSON Save/Load ────────────────────────────────────────────────────

// BUG #7: The save path is wrong — missing the acf-json directory name
// This means ACF can't save/sync field groups to the theme's acf-json folder
function hi_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf';
    return $path;
}
add_filter( 'acf/settings/save_json', 'hi_acf_json_save_point' );

function hi_acf_json_load_point( $paths ) {
    unset( $paths[0] );
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter( 'acf/settings/load_json', 'hi_acf_json_load_point' );
