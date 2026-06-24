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

    // Metabox CSS
    if ( is_admin() ) {
        wp_enqueue_style( 'cvetanichin-metabox', CVETANICHIN_URI . '/assets/css/metabox.css', [], CVETANICHIN_VERSION );
    }

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
// META BOX FRAMEWORK — Custom ACF Pro-like Functionality
// ─────────────────────────────────────────────────────────────────────────

function cvetanichin_register_page_meta_boxes() {
    $pages = [ 'front-page', 'page-consultancy', 'page-selfimprovement' ];

    foreach ( $pages as $page ) {
        add_meta_box(
            'cvetanichin_' . $page . '_fields',
            __( 'Edit Page Content', 'cvetanichin' ),
            'cvetanichin_render_' . $page . '_metabox',
            'page',
            'normal',
            'high'
        );
    }

    add_meta_box(
        'cvetanichin_console_fields',
        __( 'Vas Digital Console Settings', 'cvetanichin' ),
        'cvetanichin_render_console_metabox',
        'page',
        'normal',
        'high'
    );

    add_meta_box(
        'cvetanichin_page_widgets',
        __( 'Page Side Widgets', 'cvetanichin' ),
        'cvetanichin_render_template_widgets_metabox',
        'page',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'cvetanichin_register_page_meta_boxes' );

function cvetanichin_render_front_page_metabox( $post ) {
    wp_nonce_field( 'cvetanichin_save_meta', 'cvetanichin_nonce' );
    ?>
    <div class="cvetanichin-metabox">
        <h3><?php esc_html_e( 'Hero Section', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'hero_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'hero_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'hero_tagline', __( 'Tagline Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'image', 'hero_portrait', __( 'Portrait Image', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'hero_cta1_label', __( 'CTA 1 Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'hero_cta1_url', __( 'CTA 1 URL', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'hero_cta2_label', __( 'CTA 2 Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'hero_cta2_url', __( 'CTA 2 URL', 'cvetanichin' ), $post->ID ); ?>

        <h3><?php esc_html_e( 'CSO Domain Section', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'domain_cso_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'domain_cso_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'domain_cso_lead', __( 'Lead Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_repeater_services( 'domain_cso_services', __( 'Service Cards (Max 3)', 'cvetanichin' ), $post->ID, 3 ); ?>

        <h3><?php esc_html_e( 'Self-Improvement Domain Section', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'domain_workspace_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'domain_workspace_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'domain_workspace_paragraph', __( 'Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_repeater_stats( 'domain_workspace_stats', __( 'Stats (Max 3)', 'cvetanichin' ), $post->ID, 3 ); ?>

        <h3><?php esc_html_e( 'Products Section', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_repeater_products( 'products', __( 'Products (Max 3)', 'cvetanichin' ), $post->ID, 3 ); ?>

        <h3><?php esc_html_e( 'Footer CTA Section', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'footer_cta_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'footer_cta_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'footer_cta_paragraph', __( 'Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'footer_cta_link1_label', __( 'Link 1 Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'footer_cta_link1_url', __( 'Link 1 URL', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'footer_cta_link2_label', __( 'Link 2 Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'footer_cta_link2_url', __( 'Link 2 URL', 'cvetanichin' ), $post->ID ); ?>
    </div>
    <?php
}

function cvetanichin_render_page_consultancy_metabox( $post ) {
    wp_nonce_field( 'cvetanichin_save_meta', 'cvetanichin_nonce' );
    ?>
    <div class="cvetanichin-metabox">
        <h3><?php esc_html_e( 'Page Content', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'consultancy_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'consultancy_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'consultancy_intro', __( 'Introduction Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_repeater_services( 'consultancy_services', __( 'Services (Max 3)', 'cvetanichin' ), $post->ID, 3 ); ?>
        <?php cvetanichin_field( 'textarea', 'consultancy_approach', __( 'Approach Section', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'consultancy_about', __( 'About Section', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'consultancy_cta_label', __( 'CTA Button Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'consultancy_cta_url', __( 'CTA Button URL', 'cvetanichin' ), $post->ID ); ?>
    </div>
    <?php
}

function cvetanichin_render_page_selfimprovement_metabox( $post ) {
    wp_nonce_field( 'cvetanichin_save_meta', 'cvetanichin_nonce' );
    ?>
    <div class="cvetanichin-metabox">
        <h3><?php esc_html_e( 'Page Content', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'selfimprovement_eyebrow', __( 'Eyebrow Text', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'selfimprovement_headline', __( 'Headline', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'selfimprovement_intro', __( 'Introduction Paragraph', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_repeater_stats( 'selfimprovement_stats', __( 'Stats (Max 3)', 'cvetanichin' ), $post->ID, 3 ); ?>
        <?php cvetanichin_repeater_features( 'selfimprovement_features', __( 'Features (Max 4)', 'cvetanichin' ), $post->ID, 4 ); ?>
        <?php cvetanichin_field( 'textarea', 'selfimprovement_quote', __( 'Testimonial Quote', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'selfimprovement_creator_bio', __( 'Creator Bio', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'selfimprovement_cta_label', __( 'CTA Button Label', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'selfimprovement_cta_url', __( 'CTA Button URL', 'cvetanichin' ), $post->ID ); ?>
    </div>
    <?php
}

function cvetanichin_render_console_metabox( $post ) {
    wp_nonce_field( 'cvetanichin_save_meta', 'cvetanichin_nonce' );
    ?>
    <div class="cvetanichin-metabox">
        <h3><?php esc_html_e( 'Vas Digital Console', 'cvetanichin' ); ?></h3>
        <?php cvetanichin_field( 'text', 'console_title', __( 'Page Title', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'textarea', 'console_description', __( 'Page Description', 'cvetanichin' ), $post->ID ); ?>
        <?php cvetanichin_field( 'text', 'console_features', __( 'Features (comma-separated)', 'cvetanichin' ), $post->ID ); ?>
    </div>
    <?php
}

function cvetanichin_render_template_widgets_metabox( $post ) {
    wp_nonce_field( 'cvetanichin_save_meta', 'cvetanichin_nonce' );
    $widgets = get_post_meta( $post->ID, '_page_widgets', true );
    $widgets = is_array( $widgets ) ? $widgets : [];
    ?>
    <div id="cvetanichin-widgets-container" class="cvetanichin-widgets">
        <p><?php esc_html_e( 'Add and manage widgets for this page sidebar.', 'cvetanichin' ); ?></p>
        <div id="cvetanichin-widgets-list">
            <?php
            foreach ( $widgets as $i => $w ) {
                cvetanichin_render_widget_row( $i, $w );
            }
            ?>
        </div>
        <button type="button" id="cvetanichin-add-widget" class="button"><?php esc_html_e( '+ Add Widget', 'cvetanichin' ); ?></button>
        <input type="hidden" id="cvetanichin-widgets-data" name="_page_widgets_json" value="<?php echo esc_attr( wp_json_encode( $widgets ) ); ?>" />
    </div>
    <script>
    ( function() {
        const container = document.getElementById( 'cvetanichin-widgets-list' );
        const dataInput = document.getElementById( 'cvetanichin-widgets-data' );
        const addBtn = document.getElementById( 'cvetanichin-add-widget' );

        function syncData() {
            const widgets = [];
            container.querySelectorAll( '[data-widget-index]' ).forEach( el => {
                const idx = el.dataset.widgetIndex;
                const type = el.querySelector( '[name*="widget_type"]' ).value;
                const options = {};
                el.querySelectorAll( '[name*="widget_option_"]' ).forEach( opt => {
                    const key = opt.name.split( '_' ).pop();
                    options[ key ] = opt.value;
                } );
                widgets.push( { type, options } );
            } );
            dataInput.value = JSON.stringify( widgets );
        }

        addBtn.addEventListener( 'click', function( e ) {
            e.preventDefault();
            const idx = container.children.length;
            const row = document.createElement( 'div' );
            row.innerHTML = `<div data-widget-index="${idx}" class="cvetanichin-widget-row" style="border:1px solid #ddd;padding:10px;margin:5px 0;">
                <select name="widget_type_${idx}"><option value="cta">CTA</option><option value="bio">Bio</option><option value="stat">Stat</option><option value="newsletter">Newsletter</option></select>
                <input type="text" name="widget_option_title_${idx}" placeholder="Title" style="width:100%;margin-top:5px;" />
                <button type="button" class="button button-small" onclick="this.parentElement.remove();syncData();">Remove</button>
            </div>`;
            container.appendChild( row.firstElementChild );
            row.firstElementChild.querySelector( 'select' ).addEventListener( 'change', syncData );
            row.firstElementChild.querySelectorAll( 'input' ).forEach( el => el.addEventListener( 'input', syncData ) );
            syncData();
        } );

        container.querySelectorAll( 'select, input' ).forEach( el => el.addEventListener( 'change', syncData ) );
        container.querySelectorAll( 'input' ).forEach( el => el.addEventListener( 'input', syncData ) );
    } )();
    </script>
    <?php
}

function cvetanichin_render_widget_row( $index, $widget ) {
    $type = isset( $widget['type'] ) ? $widget['type'] : 'cta';
    $opts = isset( $widget['options'] ) ? $widget['options'] : [];
    ?>
    <div data-widget-index="<?php echo esc_attr( $index ); ?>" class="cvetanichin-widget-row" style="border:1px solid #ddd;padding:10px;margin:5px 0;">
        <select name="widget_type_<?php echo esc_attr( $index ); ?>">
            <option value="cta" <?php selected( $type, 'cta' ); ?>>CTA</option>
            <option value="bio" <?php selected( $type, 'bio' ); ?>>Bio</option>
            <option value="stat" <?php selected( $type, 'stat' ); ?>>Stat</option>
            <option value="newsletter" <?php selected( $type, 'newsletter' ); ?>>Newsletter</option>
        </select>
        <input type="text" name="widget_option_title_<?php echo esc_attr( $index ); ?>" placeholder="Title" value="<?php echo esc_attr( $opts['title'] ?? '' ); ?>" style="width:100%;margin-top:5px;" />
        <button type="button" class="button button-small" onclick="this.parentElement.remove();">Remove</button>
    </div>
    <?php
}

function cvetanichin_save_page_meta( $post_id ) {
    if ( ! isset( $_POST['cvetanichin_nonce'] ) || ! wp_verify_nonce( $_POST['cvetanichin_nonce'], 'cvetanichin_save_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $post = get_post( $post_id );
    if ( ! $post || $post->post_type !== 'page' ) {
        return;
    }

    // Sanitize all text/url fields
    $fields = [
        'hero_eyebrow', 'hero_headline', 'hero_tagline', 'hero_portrait',
        'hero_cta1_label', 'hero_cta1_url', 'hero_cta2_label', 'hero_cta2_url',
        'domain_cso_eyebrow', 'domain_cso_headline', 'domain_cso_lead',
        'domain_workspace_eyebrow', 'domain_workspace_headline', 'domain_workspace_paragraph',
        'console_title', 'console_description', 'console_features',
        'footer_cta_eyebrow', 'footer_cta_headline', 'footer_cta_paragraph',
        'footer_cta_link1_label', 'footer_cta_link1_url', 'footer_cta_link2_label', 'footer_cta_link2_url',
        'consultancy_eyebrow', 'consultancy_headline', 'consultancy_intro', 'consultancy_approach', 'consultancy_about',
        'consultancy_cta_label', 'consultancy_cta_url',
        'selfimprovement_eyebrow', 'selfimprovement_headline', 'selfimprovement_intro', 'selfimprovement_quote', 'selfimprovement_creator_bio',
        'selfimprovement_cta_label', 'selfimprovement_cta_url',
    ];

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $value = sanitize_text_field( $_POST[ $field ] );
            update_post_meta( $post_id, $field, $value );
        }
    }

    // Save repeaters as JSON
    if ( isset( $_POST['_page_widgets_json'] ) ) {
        $widgets = json_decode( stripslashes( $_POST['_page_widgets_json'] ), true );
        update_post_meta( $post_id, '_page_widgets', is_array( $widgets ) ? $widgets : [] );
    }

    // Save repeater arrays
    $repeater_fields = [
        'domain_cso_services' => [ 'title', 'description', 'image' ],
        'domain_workspace_stats' => [ 'value', 'label', 'description' ],
        'products' => [ 'name', 'description', 'price', 'gumroad_url', 'image' ],
        'consultancy_services' => [ 'title', 'description', 'image' ],
        'selfimprovement_stats' => [ 'value', 'label', 'description' ],
        'selfimprovement_features' => [ 'title', 'description', 'image' ],
    ];

    foreach ( $repeater_fields as $field => $subfields ) {
        $repeater_data = [];
        if ( isset( $_POST[ $field . '_count' ] ) ) {
            $count = (int) $_POST[ $field . '_count' ];
            for ( $i = 0; $i < $count; $i++ ) {
                $row = [];
                foreach ( $subfields as $sub ) {
                    $key = $field . '_' . $i . '_' . $sub;
                    $row[ $sub ] = isset( $_POST[ $key ] ) ? sanitize_text_field( $_POST[ $key ] ) : '';
                }
                $repeater_data[] = $row;
            }
        }
        update_post_meta( $post_id, $field, $repeater_data );
    }
}
add_action( 'save_post', 'cvetanichin_save_page_meta' );

// Field rendering helpers
function cvetanichin_field( $type, $key, $label, $post_id ) {
    $value = get_post_meta( $post_id, $key, true );
    ?>
    <div class="cvetanichin-field" style="margin-bottom:15px;">
        <label for="<?php echo esc_attr( $key ); ?>">
            <strong><?php echo esc_html( $label ); ?></strong>
        </label>
        <?php
        if ( $type === 'text' ) {
            ?>
            <input type="text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" style="width:100%;padding:8px;margin-top:5px;" />
            <?php
        } elseif ( $type === 'textarea' ) {
            ?>
            <textarea id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" rows="4" style="width:100%;padding:8px;margin-top:5px;font-family:monospace;"><?php echo esc_textarea( $value ); ?></textarea>
            <?php
        } elseif ( $type === 'image' ) {
            ?>
            <div style="margin-top:5px;">
                <input type="hidden" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" />
                <button type="button" class="button cvetanichin-media-btn" data-field="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Upload Image', 'cvetanichin' ); ?></button>
                <?php if ( $value ) { ?>
                    <img src="<?php echo esc_url( $value ); ?>" alt="<?php echo esc_attr( $label ); ?>" style="max-width:200px;margin-top:10px;display:block;" />
                <?php } ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}

function cvetanichin_repeater_services( $key, $label, $post_id, $max = 3 ) {
    $data = get_post_meta( $post_id, $key, true );
    $data = is_array( $data ) ? $data : [];
    ?>
    <div class="cvetanichin-repeater" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;">
        <strong><?php echo esc_html( $label ); ?></strong>
        <div class="cvetanichin-repeater-items">
            <?php
            for ( $i = 0; $i < min( count( $data ) + 1, $max + 1 ); $i++ ) {
                $item = isset( $data[ $i ] ) ? $data[ $i ] : [];
                ?>
                <div class="cvetanichin-repeater-item" style="border-top:1px solid #eee;padding:10px;margin-top:10px;">
                    <input type="hidden" name="<?php echo esc_attr( $key . '_' . $i . '_count' ); ?>" value="<?php echo esc_attr( $i ); ?>" />
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_title' ); ?>" placeholder="Title" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <textarea name="<?php echo esc_attr( $key . '_' . $i . '_description' ); ?>" placeholder="Description" rows="3" style="width:100%;padding:5px;margin-bottom:5px;font-family:monospace;"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
                    <input type="hidden" name="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>" />
                    <button type="button" class="button button-small cvetanichin-media-btn" data-field="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>"><?php esc_html_e( 'Upload Image', 'cvetanichin' ); ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        <input type="hidden" name="<?php echo esc_attr( $key . '_count' ); ?>" value="<?php echo esc_attr( count( $data ) ); ?>" />
    </div>
    <?php
}

function cvetanichin_repeater_stats( $key, $label, $post_id, $max = 3 ) {
    $data = get_post_meta( $post_id, $key, true );
    $data = is_array( $data ) ? $data : [];
    ?>
    <div class="cvetanichin-repeater" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;">
        <strong><?php echo esc_html( $label ); ?></strong>
        <div class="cvetanichin-repeater-items">
            <?php
            for ( $i = 0; $i < min( count( $data ) + 1, $max + 1 ); $i++ ) {
                $item = isset( $data[ $i ] ) ? $data[ $i ] : [];
                ?>
                <div class="cvetanichin-repeater-item" style="border-top:1px solid #eee;padding:10px;margin-top:10px;">
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_value' ); ?>" placeholder="Value" value="<?php echo esc_attr( $item['value'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_label' ); ?>" placeholder="Label" value="<?php echo esc_attr( $item['label'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <textarea name="<?php echo esc_attr( $key . '_' . $i . '_description' ); ?>" placeholder="Description" rows="2" style="width:100%;padding:5px;font-family:monospace;"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
                </div>
                <?php
            }
            ?>
        </div>
        <input type="hidden" name="<?php echo esc_attr( $key . '_count' ); ?>" value="<?php echo esc_attr( count( $data ) ); ?>" />
    </div>
    <?php
}

function cvetanichin_repeater_products( $key, $label, $post_id, $max = 3 ) {
    $data = get_post_meta( $post_id, $key, true );
    $data = is_array( $data ) ? $data : [];
    ?>
    <div class="cvetanichin-repeater" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;">
        <strong><?php echo esc_html( $label ); ?></strong>
        <div class="cvetanichin-repeater-items">
            <?php
            for ( $i = 0; $i < min( count( $data ) + 1, $max + 1 ); $i++ ) {
                $item = isset( $data[ $i ] ) ? $data[ $i ] : [];
                ?>
                <div class="cvetanichin-repeater-item" style="border-top:1px solid #eee;padding:10px;margin-top:10px;">
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_name' ); ?>" placeholder="Product Name" value="<?php echo esc_attr( $item['name'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <textarea name="<?php echo esc_attr( $key . '_' . $i . '_description' ); ?>" placeholder="Description" rows="2" style="width:100%;padding:5px;margin-bottom:5px;font-family:monospace;"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_price' ); ?>" placeholder="Price (e.g., €79)" value="<?php echo esc_attr( $item['price'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_gumroad_url' ); ?>" placeholder="Gumroad URL" value="<?php echo esc_attr( $item['gumroad_url'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <input type="hidden" name="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>" />
                    <button type="button" class="button button-small cvetanichin-media-btn" data-field="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>"><?php esc_html_e( 'Upload Image', 'cvetanichin' ); ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        <input type="hidden" name="<?php echo esc_attr( $key . '_count' ); ?>" value="<?php echo esc_attr( count( $data ) ); ?>" />
    </div>
    <?php
}

function cvetanichin_repeater_features( $key, $label, $post_id, $max = 4 ) {
    $data = get_post_meta( $post_id, $key, true );
    $data = is_array( $data ) ? $data : [];
    ?>
    <div class="cvetanichin-repeater" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;">
        <strong><?php echo esc_html( $label ); ?></strong>
        <div class="cvetanichin-repeater-items">
            <?php
            for ( $i = 0; $i < min( count( $data ) + 1, $max + 1 ); $i++ ) {
                $item = isset( $data[ $i ] ) ? $data[ $i ] : [];
                ?>
                <div class="cvetanichin-repeater-item" style="border-top:1px solid #eee;padding:10px;margin-top:10px;">
                    <input type="text" name="<?php echo esc_attr( $key . '_' . $i . '_title' ); ?>" placeholder="Feature Title" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>" style="width:100%;padding:5px;margin-bottom:5px;" />
                    <textarea name="<?php echo esc_attr( $key . '_' . $i . '_description' ); ?>" placeholder="Description" rows="2" style="width:100%;padding:5px;margin-bottom:5px;font-family:monospace;"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
                    <input type="hidden" name="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>" />
                    <button type="button" class="button button-small cvetanichin-media-btn" data-field="<?php echo esc_attr( $key . '_' . $i . '_image' ); ?>"><?php esc_html_e( 'Upload Icon', 'cvetanichin' ); ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        <input type="hidden" name="<?php echo esc_attr( $key . '_count' ); ?>" value="<?php echo esc_attr( count( $data ) ); ?>" />
    </div>
    <?php
}

// Media uploader — enqueue and handle
function cvetanichin_enqueue_media_uploader() {
    if ( ! is_admin() ) {
        return;
    }

    if ( ! get_current_screen() || get_current_screen()->base !== 'post' ) {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script(
        'cvetanichin-media-uploader',
        CVETANICHIN_URI . '/assets/js/media-uploader.js',
        [ 'jquery', 'media-upload', 'media-views' ],
        CVETANICHIN_VERSION,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'cvetanichin_enqueue_media_uploader' );

// Helper: Get Gumroad link
function cvetanichin_get_gumroad_link( $url ) {
    if ( empty( $url ) ) {
        return '';
    }
    if ( strpos( $url, 'http' ) === 0 ) {
        return $url;
    }
    return 'https://cvetanichin.gumroad.com/l/' . sanitize_key( $url );
}

// Helper: Render page widgets
function cvetanichin_render_page_widgets( $post_id ) {
    $widgets = get_post_meta( $post_id, '_page_widgets', true );
    if ( ! is_array( $widgets ) || empty( $widgets ) ) {
        return;
    }

    foreach ( $widgets as $widget ) {
        if ( ! isset( $widget['type'], $widget['options'] ) ) {
            continue;
        }
        echo cvetanichin_get_widget_output( $widget['type'], $widget['options'] );
    }
}

// Helper: Get widget output
function cvetanichin_get_widget_output( $type, $options = [] ) {
    $output = '';
    switch ( $type ) {
        case 'cta':
            $output = '<div class="widget widget-cta"><h3>' . esc_html( $options['title'] ?? 'Call to Action' ) . '</h3></div>';
            break;
        case 'bio':
            $output = '<div class="widget widget-bio"><p>' . esc_html( $options['title'] ?? 'Bio' ) . '</p></div>';
            break;
        case 'stat':
            $output = '<div class="widget widget-stat"><strong>' . esc_html( $options['title'] ?? '0' ) . '</strong></div>';
            break;
        case 'newsletter':
            $output = '<div class="widget widget-newsletter"><h4>' . esc_html( $options['title'] ?? 'Newsletter' ) . '</h4></div>';
            break;
    }
    return apply_filters( 'cvetanichin_widget_output', $output, $type, $options );
}

// ─────────────────────────────────────────────────────────────────────────
// Load plugin file if active
// ─────────────────────────────────────────────────────────────────────────
if ( file_exists( WP_PLUGIN_DIR . '/cvetanichin-widgets/cvetanichin-widgets.php' ) ) {
    // Plugin handles its own loading; theme just registers the widget areas above.
}
