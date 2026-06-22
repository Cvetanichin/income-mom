<?php
/**
 * Cvetanichin — Header Template
 *
 * @package Cvetanichin
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="cv-site-wrap">

<nav class="cv-nav" id="cv-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'cvetanichin' ); ?>">
  <div class="cv-nav__inner">

    <!-- Wordmark -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv-nav__logo" rel="home">
      <?php bloginfo( 'name' ); ?>
    </a>

    <!-- Primary menu -->
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
    <ul class="cv-nav__menu" role="list">
      <?php wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'walker'         => new Cvetanichin_Nav_Walker(),
        'fallback_cb'    => false,
      ] ); ?>
    </ul>
    <?php endif; ?>

    <!-- Nav CTA -->
    <a href="<?php echo esc_url( get_theme_mod( 'cvetanichin_nav_cta_url', '#enquire' ) ); ?>"
       class="cv-nav__cta"
       aria-label="<?php echo esc_attr( get_theme_mod( 'cvetanichin_nav_cta_label', 'Enquire' ) ); ?>">
      <?php echo esc_html( get_theme_mod( 'cvetanichin_nav_cta_label', 'Enquire' ) ); ?> &rarr;
    </a>

    <!-- Vas Digital Console -->
    <a href="<?php echo is_user_logged_in() ? esc_url( home_url( '/vas-digital-console/' ) ) : esc_url( wp_login_url( home_url( '/vas-digital-console/' ) ) ); ?>"
       class="cv-nav__console">
      <?php echo is_user_logged_in() ? 'Console' : 'Sign In'; ?>
    </a>

    <!-- Mobile hamburger -->
    <button class="cv-nav__toggle" id="cv-nav-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation', 'cvetanichin' ); ?>" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

  </div>
</nav>

<main class="cv-main" id="cv-main">
