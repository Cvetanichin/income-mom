<?php
/**
 * Cvetanichin — Fallback Index Template
 *
 * @package Cvetanichin
 */

get_header();

$sidebar_pos = get_theme_mod( 'cvetanichin_sidebar_position', 'right' );
$layout_cls  = 'right' === $sidebar_pos ? '' : ( 'left' === $sidebar_pos ? 'cv-layout--left-sidebar' : 'cv-layout--full' );
?>

<div class="cv-content-area <?php echo esc_attr( $layout_cls ); ?>">

  <?php if ( 'left' === $sidebar_pos ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

  <div class="cv-content">

    <?php if ( have_posts() ) : ?>

      <header class="cv-page-header">
        <?php if ( is_home() && ! is_front_page() ) : ?>
          <h1><?php single_post_title(); ?></h1>
        <?php elseif ( is_archive() ) : ?>
          <?php the_archive_title( '<h1>', '</h1>' ); ?>
          <?php the_archive_description( '<p class="cv-archive-desc">', '</p>' ); ?>
        <?php elseif ( is_search() ) : ?>
          <h1><?php printf( esc_html__( 'Search: %s', 'cvetanichin' ), '<em>' . get_search_query() . '</em>' ); ?></h1>
        <?php else : ?>
          <h1><?php esc_html_e( 'Latest', 'cvetanichin' ); ?></h1>
        <?php endif; ?>
      </header>

      <div class="cv-posts-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.5rem;margin-top:2.5rem;">
        <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry cv-reveal' ); ?>>
          <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" class="cv-entry__thumb" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail( 'cv-card', [ 'style' => 'width:100%;height:200px;object-fit:cover;display:block;' ] ); ?>
          </a>
          <?php endif; ?>
          <div class="cv-entry__body" style="display:flex;flex-direction:column;gap:0.75rem;">
            <p class="cv-entry__meta">
              <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
              <?php $cats = get_the_category(); if ( $cats ) echo ' &mdash; ' . esc_html( $cats[0]->name ); ?>
            </p>
            <h2 class="cv-entry__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="cv-entry__excerpt"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="cv-btn cv-btn--ghost" style="align-self:flex-start;">
              <?php esc_html_e( 'Read more', 'cvetanichin' ); ?> &rarr;
            </a>
          </div>
        </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination( [
        'prev_text' => '&larr; ' . __( 'Previous', 'cvetanichin' ),
        'next_text' => __( 'Next', 'cvetanichin' ) . ' &rarr;',
        'class'     => 'cv-pagination',
      ] ); ?>

    <?php else : ?>
      <p class="cv-no-results"><?php esc_html_e( 'No posts found.', 'cvetanichin' ); ?></p>
    <?php endif; ?>

  </div><!-- .cv-content -->

  <?php if ( 'right' === $sidebar_pos || '' === $layout_cls ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

</div><!-- .cv-content-area -->

<?php get_footer();
