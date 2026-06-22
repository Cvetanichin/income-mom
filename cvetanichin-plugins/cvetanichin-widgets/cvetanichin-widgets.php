<?php
/**
 * Plugin Name:       Cvetanichin Widgets
 * Plugin URI:        https://cvetanichin.com
 * Description:       Custom widget set for the Cvetanichin WordPress theme. Includes CTA, Bio, Stat, Newsletter, Recent Posts, and Product Card widgets — all styled to the Cvetanichin design system.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      8.1
 * Author:            Vaska Cvetanoska
 * Author URI:        https://cvetanichin.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cvetanichin-widgets
 */

defined( 'ABSPATH' ) || exit;

define( 'CVW_VERSION', '1.0.0' );
define( 'CVW_DIR', plugin_dir_path( __FILE__ ) );
define( 'CVW_URI', plugin_dir_url( __FILE__ ) );

// Load all widget classes
foreach ( glob( CVW_DIR . 'widgets/class-*.php' ) as $file ) {
    require_once $file;
}

// Register all widgets
function cvw_register_widgets() {
    register_widget( 'CVW_CTA_Widget' );
    register_widget( 'CVW_Bio_Widget' );
    register_widget( 'CVW_Stat_Widget' );
    register_widget( 'CVW_Newsletter_Widget' );
    register_widget( 'CVW_Recent_Posts_Widget' );
    register_widget( 'CVW_Product_Card_Widget' );
    register_widget( 'CVW_Quote_Widget' );
}
add_action( 'widgets_init', 'cvw_register_widgets' );

// Enqueue widget styles
function cvw_enqueue_styles() {
    wp_enqueue_style( 'cvw-widgets', CVW_URI . 'assets/widgets.css', [], CVW_VERSION );
}
add_action( 'wp_enqueue_scripts', 'cvw_enqueue_styles' );
