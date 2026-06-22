<?php
/**
 * Cvetanichin — Single Post Template
 *
 * @package Cvetanichin
 */

get_header();

$sidebar_pos = get_theme_mod( 'cvetanichin_sidebar_position', 'right' );
$layout_cls  = 'left' === $sidebar_pos ? 'cv-layout--left-sidebar' : ( 'none' === $sidebar_pos ? 'cv-layout--full' : '' );
?>

<div class="cv-content-area <?php echo esc_attr( $layout_cls ); ?>">

  <?php if ( 'left' === $sidebar_pos ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

  <div class="cv-content">
    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <header class="cv-post-header" style="padding:3.5rem 0 2.5rem;border-bottom:0.5px solid var(--border-subtle);margin-bottom:2.5rem;">
        <?php $cats = get_the_category(); if ( $cats ) : ?>
        <p class="cv-eyebrow cv-eyebrow--rose" style="margin-bottom:1rem;"><?php echo esc_html( $cats[0]->name ); ?></p>
        <?php endif; ?>
        <h1 style="font-size:var(--text-4xl);max-width:720px;"><?php the_title(); ?></h1>
        <p style="margin-top:1.25rem;font-size:var(--text-sm);letter-spacing:0.12em;color:var(--text-muted);">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
          &nbsp;&mdash;&nbsp;
          <?php echo esc_html( get_the_author() ); ?>
          &nbsp;&mdash;&nbsp;
          <?php printf( esc_html( _n( '%s min read', '%s min read', ceil( str_word_count( get_the_content() ) / 200 ), 'cvetanichin' ) ), ceil( str_word_count( get_the_content() ) / 200 ) ); ?>
        </p>
      </header>

      <?php if ( has_post_thumbnail() ) : ?>
      <div style="margin-bottom:2.5rem;">
        <?php the_post_thumbnail( 'cv-hero', [ 'style' => 'width:100%;max-height:480px;object-fit:cover;display:block;' ] ); ?>
      </div>
      <?php endif; ?>

      <div class="cv-entry-content" style="max-width:720px;">
        <?php the_content(); ?>
        <?php wp_link_pages( [ 'before' => '<nav class="cv-page-links" style="margin-top:2rem;">', 'after' => '</nav>' ] ); ?>
      </div>

      <footer class="cv-post-footer" style="margin-top:3rem;padding-top:2rem;border-top:0.5px solid var(--border-subtle);">
        <?php the_tags( '<p style="font-size:var(--text-xs);letter-spacing:0.12em;color:var(--text-muted);">' . __( 'Tags: ', 'cvetanichin' ), ', ', '</p>' ); ?>
        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        if ( $prev || $next ) :
        ?>
        <nav class="cv-post-nav" style="display:flex;justify-content:space-between;gap:2rem;margin-top:2rem;" aria-label="<?php esc_attr_e( 'Post navigation', 'cvetanichin' ); ?>">
          <?php if ( $prev ) : ?>
          <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="cv-btn cv-btn--ghost" rel="prev">
            &larr; <?php echo esc_html( get_the_title( $prev ) ); ?>
          </a>
          <?php endif; ?>
          <?php if ( $next ) : ?>
          <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="cv-btn cv-btn--ghost" rel="next" style="margin-left:auto;">
            <?php echo esc_html( get_the_title( $next ) ); ?> &rarr;
          </a>
          <?php endif; ?>
        </nav>
        <?php endif; ?>
      </footer>

    </article>

    <?php if ( comments_open() || get_comments_number() ) : ?>
    <div style="margin-top:3rem;">
      <?php comments_template(); ?>
    </div>
    <?php endif; ?>

    <?php endwhile; ?>
  </div>

  <?php if ( 'right' === $sidebar_pos || '' === $layout_cls ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-blog' );
    get_sidebar();
  endif; ?>

</div>

<?php get_footer();
