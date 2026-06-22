<?php
/**
 * Cvetanichin — Sidebar Template
 *
 * @package Cvetanichin
 */

$sidebar_id = get_query_var( 'cvetanichin_sidebar_id', 'sidebar-1' );
if ( ! is_active_sidebar( $sidebar_id ) ) return;
?>
<aside class="cv-sidebar" id="cv-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'cvetanichin' ); ?>">
  <?php dynamic_sidebar( $sidebar_id ); ?>
</aside>
