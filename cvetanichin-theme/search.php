<?php
/**
 * Cvetanichin — Search Results Template
 *
 * @package Cvetanichin
 */

get_header();
$sidebar_pos = get_theme_mod( 'cvetanichin_sidebar_position', 'right' );
$layout_cls  = 'left' === $sidebar_pos ? 'cv-layout--left-sidebar' : ( 'none' === $sidebar_pos ? 'cv-layout--full' : '' );
?>

<header class="cv-page-header" style="background:var(--surface-inverse);padding:4rem var(--section-pad-x);">
  <div class="cv-container">
    <h1 style="color:var(--text-inverse);"><?php printf( esc_html__( 'Search: %s', 'cvetanichin' ), '<em>' . get_search_query() . '</em>' ); ?></h1>
    <p style="color:rgba(250,249,246,0.5);margin-top:0.75rem;"><?php printf( esc_html__( '%d results found', 'cvetanichin' ), (int) $wp_query->found_posts ); ?></p>
  </div>
</header>

<div class="cv-content-area <?php echo esc_attr( $layout_cls ); ?>">

  <?php if ( 'left' === $sidebar_pos ) : get_sidebar(); endif; ?>

  <div class="cv-content">
    <?php if ( have_posts() ) : ?>
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
      <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry cv-reveal' ); ?>>
        <p class="cv-entry__meta"><?php echo esc_html( get_the_date() ); ?></p>
        <h2 class="cv-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="cv-entry__excerpt"><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="cv-btn cv-btn--ghost" style="align-self:flex-start;"><?php esc_html_e( 'Read more', 'cvetanichin' ); ?> &rarr;</a>
      </article>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
    <?php else : ?>
    <p><?php esc_html_e( 'No results found. Try a different search term.', 'cvetanichin' ); ?></p>
    <?php get_search_form(); ?>
    <?php endif; ?>
  </div>

  <?php if ( 'right' === $sidebar_pos || '' === $layout_cls ) : get_sidebar(); endif; ?>

</div>

<?php get_footer();
