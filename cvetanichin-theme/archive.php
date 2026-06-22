<?php
/**
 * Cvetanichin — Archive Template
 *
 * @package Cvetanichin
 */

get_header();

$sidebar_pos = get_theme_mod( 'cvetanichin_sidebar_position', 'right' );
$layout_cls  = 'left' === $sidebar_pos ? 'cv-layout--left-sidebar' : ( 'none' === $sidebar_pos ? 'cv-layout--full' : '' );
?>

<header class="cv-page-header" style="background:var(--surface-inverse);padding:4rem var(--section-pad-x);">
  <div class="cv-container">
    <?php the_archive_title( '<h1 style="color:var(--text-inverse);">', '</h1>' ); ?>
    <?php the_archive_description( '<p style="color:rgba(250,249,246,0.6);margin-top:1rem;max-width:480px;">', '</p>' ); ?>
  </div>
</header>

<div class="cv-content-area <?php echo esc_attr( $layout_cls ); ?>">

  <?php if ( 'left' === $sidebar_pos ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

  <div class="cv-content">
    <?php if ( have_posts() ) : ?>
    <div class="cv-posts-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem;">
      <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry cv-reveal' ); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
          <?php the_post_thumbnail( 'cv-card', [ 'style' => 'width:100%;height:180px;object-fit:cover;display:block;' ] ); ?>
        </a>
        <?php endif; ?>
        <div style="display:flex;flex-direction:column;gap:0.75rem;">
          <p class="cv-entry__meta"><?php echo esc_html( get_the_date() ); ?></p>
          <h2 class="cv-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <p class="cv-entry__excerpt"><?php the_excerpt(); ?></p>
          <a href="<?php the_permalink(); ?>" class="cv-btn cv-btn--ghost" style="align-self:flex-start;"><?php esc_html_e( 'Read more', 'cvetanichin' ); ?> &rarr;</a>
        </div>
      </article>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
    <?php else : ?>
    <p><?php esc_html_e( 'No posts found.', 'cvetanichin' ); ?></p>
    <?php endif; ?>
  </div>

  <?php if ( 'right' === $sidebar_pos || '' === $layout_cls ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

</div>

<?php get_footer();
