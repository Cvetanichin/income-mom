<?php
/**
 * Cvetanichin — 404 Template
 *
 * @package Cvetanichin
 */

get_header(); ?>

<div class="cv-content-area cv-layout--full" style="min-height:60vh;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:2rem;padding:5rem var(--section-pad-x);text-align:center;">
  <p class="cv-eyebrow">404</p>
  <h1 style="font-size:var(--text-4xl);"><?php esc_html_e( 'Page not found.', 'cvetanichin' ); ?></h1>
  <p style="color:var(--text-secondary);max-width:420px;"><?php esc_html_e( 'The page you are looking for does not exist or has moved. Return to the homepage.', 'cvetanichin' ); ?></p>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv-btn cv-btn--primary">
    <?php esc_html_e( 'Back to home', 'cvetanichin' ); ?> &rarr;
  </a>
</div>

<?php get_footer();
