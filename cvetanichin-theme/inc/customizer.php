<?php
/**
 * Cvetanichin Theme Customizer
 *
 * @package Cvetanichin
 */

defined( 'ABSPATH' ) || exit;

function cvetanichin_customize_register( WP_Customize_Manager $wp_customize ) {

    // ── Panel: Brand & Domain ──────────────────────────────────────────
    $wp_customize->add_panel( 'cvetanichin_brand', [
        'title'    => __( 'Cvetanichin Brand', 'cvetanichin' ),
        'priority' => 30,
    ] );

    // Section: Domain
    $wp_customize->add_section( 'cvetanichin_domain', [
        'title'       => __( 'Active Domain', 'cvetanichin' ),
        'panel'       => 'cvetanichin_brand',
        'description' => __( 'Choose which Cvetanichin domain theme is active site-wide. Individual page templates (Consultancy / Self-Improvement) always load their own theme regardless of this setting.', 'cvetanichin' ),
        'priority'    => 10,
    ] );

    $wp_customize->add_setting( 'cvetanichin_active_domain', [
        'default'           => 'selfimprovement',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ] );

    $wp_customize->add_control( 'cvetanichin_active_domain', [
        'label'   => __( 'Default domain theme', 'cvetanichin' ),
        'section' => 'cvetanichin_domain',
        'type'    => 'radio',
        'choices' => [
            'selfimprovement' => __( 'Self-Improvement (B2C) — hot pink · blush · deep purple', 'cvetanichin' ),
            'consultancy'     => __( 'CSO Consultancy (B2B) — ochre gold · warm stone · slate', 'cvetanichin' ),
        ],
    ] );

    // Section: Identity
    $wp_customize->add_section( 'cvetanichin_identity', [
        'title'    => __( 'Brand Identity', 'cvetanichin' ),
        'panel'    => 'cvetanichin_brand',
        'priority' => 20,
    ] );

    // Tagline override
    $wp_customize->add_setting( 'cvetanichin_tagline', [
        'default'           => 'Strategic clarity. Digital independence.',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    $wp_customize->add_control( 'cvetanichin_tagline', [
        'label'   => __( 'Hero tagline (used on standard pages)', 'cvetanichin' ),
        'section' => 'cvetanichin_identity',
        'type'    => 'text',
    ] );

    // CTA label
    $wp_customize->add_setting( 'cvetanichin_nav_cta_label', [
        'default'           => 'Enquire',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    $wp_customize->add_control( 'cvetanichin_nav_cta_label', [
        'label'   => __( 'Nav CTA button label', 'cvetanichin' ),
        'section' => 'cvetanichin_identity',
        'type'    => 'text',
    ] );

    // CTA URL
    $wp_customize->add_setting( 'cvetanichin_nav_cta_url', [
        'default'           => '#enquire',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ] );

    $wp_customize->add_control( 'cvetanichin_nav_cta_url', [
        'label'   => __( 'Nav CTA URL', 'cvetanichin' ),
        'section' => 'cvetanichin_identity',
        'type'    => 'url',
    ] );

    // Section: Layout
    $wp_customize->add_section( 'cvetanichin_layout', [
        'title'    => __( 'Layout', 'cvetanichin' ),
        'panel'    => 'cvetanichin_brand',
        'priority' => 30,
    ] );

    $wp_customize->add_setting( 'cvetanichin_sidebar_position', [
        'default'           => 'right',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ] );

    $wp_customize->add_control( 'cvetanichin_sidebar_position', [
        'label'   => __( 'Sidebar position (standard pages)', 'cvetanichin' ),
        'section' => 'cvetanichin_layout',
        'type'    => 'radio',
        'choices' => [
            'right' => __( 'Right', 'cvetanichin' ),
            'left'  => __( 'Left', 'cvetanichin' ),
            'none'  => __( 'None (full width)', 'cvetanichin' ),
        ],
    ] );

    // Landing-page sidebar toggle
    $wp_customize->add_setting( 'cvetanichin_landing_sidebar', [
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ] );

    $wp_customize->add_control( 'cvetanichin_landing_sidebar', [
        'label'   => __( 'Show sidebar on Consultancy & Self-Improvement page templates', 'cvetanichin' ),
        'section' => 'cvetanichin_layout',
        'type'    => 'checkbox',
    ] );

    // Footer columns
    $wp_customize->add_setting( 'cvetanichin_footer_cols', [
        'default'           => 3,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ] );

    $wp_customize->add_control( 'cvetanichin_footer_cols', [
        'label'   => __( 'Footer widget columns', 'cvetanichin' ),
        'section' => 'cvetanichin_layout',
        'type'    => 'select',
        'choices' => [ 1 => 1, 2 => 2, 3 => 3 ],
    ] );

    // Section: Typography
    $wp_customize->add_section( 'cvetanichin_type', [
        'title'    => __( 'Typography', 'cvetanichin' ),
        'panel'    => 'cvetanichin_brand',
        'priority' => 40,
    ] );

    $wp_customize->add_setting( 'cvetanichin_headline_style', [
        'default'           => 'soft-italic',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_key',
    ] );

    $wp_customize->add_control( 'cvetanichin_headline_style', [
        'label'   => __( 'Headline style', 'cvetanichin' ),
        'section' => 'cvetanichin_type',
        'type'    => 'radio',
        'choices' => [
            'soft-italic' => __( 'Soft italic (Fraunces italic emphasis)', 'cvetanichin' ),
            'upright'     => __( 'Upright (no italic)', 'cvetanichin' ),
            'direct'      => __( 'Direct (Outfit sans-serif bold)', 'cvetanichin' ),
        ],
    ] );

    // Section: Accent
    $wp_customize->add_section( 'cvetanichin_accent', [
        'title'    => __( 'Accent Presence', 'cvetanichin' ),
        'panel'    => 'cvetanichin_brand',
        'priority' => 50,
    ] );

    $wp_customize->add_setting( 'cvetanichin_accent_presence', [
        'default'           => 'expressive',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ] );

    $wp_customize->add_control( 'cvetanichin_accent_presence', [
        'label'   => __( 'Accent presence', 'cvetanichin' ),
        'section' => 'cvetanichin_accent',
        'type'    => 'radio',
        'choices' => [
            'expressive' => __( 'Expressive — full brand accent colour', 'cvetanichin' ),
            'restrained' => __( 'Restrained — secondary teal / mauve', 'cvetanichin' ),
            'editorial'  => __( 'Editorial — near-monochrome slate', 'cvetanichin' ),
        ],
    ] );
}
add_action( 'customize_register', 'cvetanichin_customize_register' );

/**
 * Binds JS handlers to make Customizer preview reload changes asynchronously.
 */
function cvetanichin_customize_preview_js() {
    wp_enqueue_script(
        'cvetanichin-customizer',
        CVETANICHIN_URI . '/assets/js/customizer.js',
        [ 'customize-preview' ],
        CVETANICHIN_VERSION,
        true
    );
}
add_action( 'customize_preview_init', 'cvetanichin_customize_preview_js' );
