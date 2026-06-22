<?php
/**
 * Cvetanichin — Default Page Template
 *
 * @package Cvetanichin
 */

get_header();

$sidebar_pos = get_theme_mod( 'cvetanichin_sidebar_position', 'right' );
$layout_cls  = 'left' === $sidebar_pos ? 'cv-layout--left-sidebar' : ( 'none' === $sidebar_pos ? 'cv-layout--full' : '' );
?>

<div class="cv-content-area <?php echo esc_attr( $layout_cls ); ?>">

  <?php if ( 'left' === $sidebar_pos ) : get_sidebar(); endif; ?>

  <article id="page-<?php the_ID(); ?>" <?php post_class( 'cv-page-content' ); ?>>

    <?php if ( has_post_thumbnail() ) :
      the_post_thumbnail( 'cv-hero', [ 'style' => 'width:100%;max-height:400px;object-fit:cover;display:block;' ] );
    endif; ?>

    <header class="cv-page-header" style="background:var(--surface-inverse);padding:3.5rem var(--section-pad-x);">
      <?php while ( have_posts() ) : the_post(); ?>
      <p class="cv-eyebrow cv-eyebrow--on-dark"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
      <h1 style="color:var(--text-inverse);margin-top:1rem;"><?php the_title(); ?></h1>
    </header>

    <div class="cv-entry-content" style="padding:3.5rem var(--section-pad-x);">
      <?php the_content(); ?>
      <?php wp_link_pages( [ 'before' => '<nav class="cv-page-links">', 'after' => '</nav>' ] ); ?>
    </div>

    <?php endwhile; ?>

  </article>

  <?php if ( 'right' === $sidebar_pos || '' === $layout_cls ) : get_sidebar(); endif; ?>

</div>

<?php get_footer();
