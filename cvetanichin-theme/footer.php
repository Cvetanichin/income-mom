<?php
/**
 * Cvetanichin — Footer Template
 *
 * @package Cvetanichin
 */

$footer_cols = absint( get_theme_mod( 'cvetanichin_footer_cols', 3 ) );
?>

</main><!-- #cv-main -->

<footer class="cv-footer" role="contentinfo">

  <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
  <div class="cv-footer__widgets" style="grid-template-columns: repeat(<?php echo esc_attr( $footer_cols ); ?>, 1fr);">

    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
    <div class="cv-footer__col">
      <?php dynamic_sidebar( 'footer-1' ); ?>
    </div>
    <?php endif; ?>

    <?php if ( $footer_cols >= 2 && is_active_sidebar( 'footer-2' ) ) : ?>
    <div class="cv-footer__col">
      <?php dynamic_sidebar( 'footer-2' ); ?>
    </div>
    <?php endif; ?>

    <?php if ( $footer_cols >= 3 && is_active_sidebar( 'footer-3' ) ) : ?>
    <div class="cv-footer__col">
      <?php dynamic_sidebar( 'footer-3' ); ?>
    </div>
    <?php endif; ?>

  </div>
  <?php endif; ?>

  <div class="cv-footer__bar">
    <span class="cv-footer__brand"><?php bloginfo( 'name' ); ?></span>

    <nav aria-label="<?php esc_attr_e( 'Footer Navigation', 'cvetanichin' ); ?>">
      <?php wp_nav_menu( [
        'theme_location' => 'footer',
        'container'      => false,
        'menu_class'     => 'cv-footer__menu',
        'fallback_cb'    => false,
      ] ); ?>
    </nav>

    <span class="cv-footer__copy">
      &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
      <?php esc_html_e( 'All rights reserved.', 'cvetanichin' ); ?>
    </span>
  </div>

</footer>

</div><!-- .cv-site-wrap -->

<?php wp_footer(); ?>
</body>
</html>
