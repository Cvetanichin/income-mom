<?php
/**
 * Template Name: Vas Digital Console
 * Template Post Type: page
 *
 * Private dashboard — only accessible to logged-in users.
 * Embeds the full Creative Life Space app inline.
 *
 * @package Cvetanichin
 */

// Guard: redirect to login if not authenticated
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

// Read the dashboard HTML
$dashboard_file = get_template_directory() . '/assets/console/dashboard.html';
$dashboard_html = file_exists( $dashboard_file ) ? file_get_contents( $dashboard_file ) : '';

// Extract body content from the dashboard HTML
if ( preg_match( '/<body[^>]*>([\s\S]*?)<\/body>/i', $dashboard_html, $m ) ) {
    $body_content = $m[1];
} else {
    $body_content = $dashboard_html;
}

// Extract head styles + links (fonts, CSS) from the dashboard
$head_extras = '';
if ( preg_match_all( '/<link[^>]+>/i', $dashboard_html, $links ) ) {
    $head_extras .= implode( "\n  ", $links[0] );
}
if ( preg_match( '/<style>([\s\S]*?)<\/style>/i', $dashboard_html, $styles ) ) {
    $head_extras .= "\n  <style>" . $styles[1] . "</style>";
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vas Digital Console &mdash; <?php bloginfo( 'name' ); ?></title>
  <?php echo $head_extras; ?>
  <style>
    /* Console exit bar */
    .console-exit-bar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 9999;
      background: rgba(12,11,9,0.95);
      border-top: 1px solid rgba(184,149,100,0.18);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8px 28px;
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      font-weight: 400;
      letter-spacing: 0.15em;
      text-transform: uppercase;
    }
    .console-exit-bar__brand {
      color: rgba(184,149,100,0.5);
    }
    .console-exit-bar a {
      color: rgba(240,234,224,0.4);
      text-decoration: none;
      transition: color 0.2s;
    }
    .console-exit-bar a:hover { color: rgba(240,234,224,0.85); }
    .console-exit-bar__user {
      color: rgba(184,149,100,0.65);
    }
    /* Extra body padding for the exit bar */
    body { padding-bottom: 40px !important; }
  </style>
  <?php wp_head(); ?>
</head>
<body class="console-dashboard">

  <!-- Exit / home bar -->
  <div class="console-exit-bar" role="navigation" aria-label="Console navigation">
    <span class="console-exit-bar__brand">Vas Digital Console</span>
    <span class="console-exit-bar__user">
      <?php echo esc_html( wp_get_current_user()->display_name ); ?>
    </span>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Back to site</a>
  </div>

  <?php echo $body_content; ?>

  <?php wp_footer(); ?>
</body>
</html>
