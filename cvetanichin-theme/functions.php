<?php
/**
 * Cvetanichin Theme Functions
 *
 * @package Cvetanichin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// ─────────────────────────────────────────────────────────────────────────
// Constants
// ─────────────────────────────────────────────────────────────────────────
define( 'CVETANICHIN_VERSION', '1.0.0' );
define( 'CVETANICHIN_DIR', get_template_directory() );
define( 'CVETANICHIN_URI', get_template_directory_uri() );

// ─────────────────────────────────────────────────────────────────────────
// Theme Setup
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_setup() {
    load_theme_textdomain( 'cvetanichin', CVETANICHIN_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'html5', [
        'comment-list', 'comment-form', 'search-form',
        'gallery', 'caption', 'style', 'script',
    ] );

    // Image sizes
    add_image_size( 'cv-hero',    1920, 800, true );
    add_image_size( 'cv-card',    800,  600, true );
    add_image_size( 'cv-thumb',   400,  300, true );
    add_image_size( 'cv-portrait', 440, 550, true );

    // Navigation menus
    register_nav_menus( [
        'primary' => __( 'Primary Menu',  'cvetanichin' ),
        'footer'  => __( 'Footer Menu',   'cvetanichin' ),
        'social'  => __( 'Social Links',  'cvetanichin' ),
    ] );
}
add_action( 'after_setup_theme', 'cvetanichin_setup' );

// ─────────────────────────────────────────────────────────────────────────
// Content Width
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_content_width() {
    $GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'cvetanichin_content_width', 0 );

// ─────────────────────────────────────────────────────────────────────────
// Enqueue Scripts & Styles
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_scripts() {

    // Google Fonts — Fraunces + Outfit
    wp_enqueue_style(
        'cvetanichin-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,200..400;1,9..144,200..400&family=Outfit:wght@300;400;500;600&display=swap',
        [],
        null
    );

    // Design tokens
    wp_enqueue_style( 'cvetanichin-tokens', CVETANICHIN_URI . '/assets/css/tokens.css', [ 'cvetanichin-fonts' ], CVETANICHIN_VERSION );

    // Domain theme — set via Customizer or page template
    $active_domain = get_theme_mod( 'cvetanichin_active_domain', 'selfimprovement' );
    wp_enqueue_style( 'cvetanichin-domain', CVETANICHIN_URI . '/assets/css/' . sanitize_key( $active_domain ) . '.css', [ 'cvetanichin-tokens' ], CVETANICHIN_VERSION );

    // Main stylesheet (style.css)
    wp_enqueue_style( 'cvetanichin-style', get_stylesheet_uri(), [ 'cvetanichin-domain' ], CVETANICHIN_VERSION );

    // Main JS
    wp_enqueue_script( 'cvetanichin-main', CVETANICHIN_URI . '/assets/js/main.js', [], CVETANICHIN_VERSION, true );

    // Pass data to JS
    wp_localize_script( 'cvetanichin-main', 'cvetanichinData', [
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'nonce'      => wp_create_nonce( 'cvetanichin-nonce' ),
        'themeUri'   => CVETANICHIN_URI,
        'domain'     => $active_domain,
    ] );

    // Comment reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'cvetanichin_scripts' );

// ─────────────────────────────────────────────────────────────────────────
// Register Sidebars / Widget Areas
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_sidebars() {

    $shared = [
        'before_widget' => '<div id="%1\$s" class="widget %2\$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Primary Sidebar', 'cvetanichin' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar — shown on standard pages and posts.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Consultancy Page Sidebar', 'cvetanichin' ),
        'id'            => 'sidebar-consultancy',
        'description'   => __( 'Sidebar shown on the Consultancy landing page template.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Self-Improvement Page Sidebar', 'cvetanichin' ),
        'id'            => 'sidebar-selfimprovement',
        'description'   => __( 'Sidebar shown on the Self-Improvement landing page template.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Blog Sidebar', 'cvetanichin' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Sidebar shown on blog index and single post pages.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Footer — Column 1', 'cvetanichin' ),
        'id'            => 'footer-1',
        'description'   => __( 'First footer widget column.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Footer — Column 2', 'cvetanichin' ),
        'id'            => 'footer-2',
        'description'   => __( 'Second footer widget column.', 'cvetanichin' ),
    ] ) );

    register_sidebar( array_merge( $shared, [
        'name'          => __( 'Footer — Column 3', 'cvetanichin' ),
        'id'            => 'footer-3',
        'description'   => __( 'Third footer widget column.', 'cvetanichin' ),
    ] ) );
}
add_action( 'widgets_init', 'cvetanichin_sidebars' );

// ─────────────────────────────────────────────────────────────────────────
// Template: load correct domain theme CSS per page template
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_load_page_domain_css() {
    if ( is_page_template( 'page-consultancy.php' ) ) {
        wp_dequeue_style( 'cvetanichin-domain' );
        wp_enqueue_style( 'cvetanichin-domain', CVETANICHIN_URI . '/assets/css/consultancy.css', [ 'cvetanichin-tokens' ], CVETANICHIN_VERSION );
    } elseif ( is_page_template( 'page-selfimprovement.php' ) ) {
        wp_dequeue_style( 'cvetanichin-domain' );
        wp_enqueue_style( 'cvetanichin-domain', CVETANICHIN_URI . '/assets/css/selfimprovement.css', [ 'cvetanichin-tokens' ], CVETANICHIN_VERSION );
    } elseif ( is_page_template( 'page-templates/template-console.php' ) ) {
        wp_enqueue_style( 'cvetanichin-console', CVETANICHIN_URI . '/assets/css/console.css', [ 'cvetanichin-tokens' ], CVETANICHIN_VERSION );
        wp_enqueue_script( 'cvetanichin-console', CVETANICHIN_URI . '/assets/js/console.js', [], CVETANICHIN_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'cvetanichin_load_page_domain_css', 20 );

// ─────────────────────────────────────────────────────────────────────────
// Vas Digital Console — redirect to console after login
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_login_redirect( $redirect_to, $request, $user ) {
    if ( $user && ! is_wp_error( $user ) ) {
        return home_url( '/vas-digital-console/' );
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'cvetanichin_login_redirect', 10, 3 );

// ─────────────────────────────────────────────────────────────────────────
// Customizer
// ─────────────────────────────────────────────────────────────────────────
require CVETANICHIN_DIR . '/inc/customizer.php';

// ─────────────────────────────────────────────────────────────────────────
// Helper: render a page section marker
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_marker() {
    return '<div class="cv-marker"><div class="cv-marker__inner"></div></div>';
}

// ─────────────────────────────────────────────────────────────────────────
// Nav walker — clean menu markup
// ─────────────────────────────────────────────────────────────────────────
class Cvetanichin_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="cv-nav__submenu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes  = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'cv-nav__item';
        if ( in_array( 'current-menu-item', $classes, true ) ) {
            $classes[] = 'cv-nav__item--active';
        }
        $class_str = implode( ' ', array_filter( array_unique( $classes ) ) );
        $url       = esc_url( $item->url );
        $title     = apply_filters( 'the_title', $item->title, $item->ID );
        $output   .= "<li class=\"$class_str\"><a href=\"$url\">$title</a>";
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

// ─────────────────────────────────────────────────────────────────────────
// Excerpt length
// ─────────────────────────────────────────────────────────────────────────
function cvetanichin_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'cvetanichin_excerpt_length' );

function cvetanichin_excerpt_more( $more ) {
    return '&thinsp;—';
}
add_filter( 'excerpt_more', 'cvetanichin_excerpt_more' );

// ─────────────────────────────────────────────────────────────────────────
// Load plugin file if active
// ─────────────────────────────────────────────────────────────────────────
if ( file_exists( WP_PLUGIN_DIR . '/cvetanichin-widgets/cvetanichin-widgets.php' ) ) {
    // Plugin handles its own loading; theme just registers the widget areas above.
}
