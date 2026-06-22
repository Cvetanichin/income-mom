<?php
/**
 * Template Name: Self-Improvement Page
 * Template Post Type: page
 *
 * Full-width Self-Improvement / Digital Products landing page — Domain 2.
 * Hot pink · blush · deep purple.
 * Loads selfimprovement.css domain theme automatically via functions.php.
 * Includes sticky widget sidebar (right) — toggle via Customizer.
 *
 * @package Cvetanichin
 */

get_header();

$show_sidebar   = (bool) get_theme_mod( 'cvetanichin_landing_sidebar', true );
$headline_style = get_theme_mod( 'cvetanichin_headline_style', 'soft-italic' );
?>

<?php if ( $headline_style === 'upright' ) : ?>
<style>h1 em, h2 em, h3 em { font-style: normal; }</style>
<?php elseif ( $headline_style === 'direct' ) : ?>
<style>
  h1, h2, h3 { font-family: var(--font-body) !important; font-weight: 500 !important; }
  h1 em, h2 em, h3 em { font-style: normal !important; font-weight: 600 !important; }
</style>
<?php endif; ?>

<div style="display:grid;grid-template-columns:<?php echo $show_sidebar ? '1fr 300px' : '1fr'; ?>;gap:0;align-items:start;">

  <!-- ─── PAGE CONTENT ──────────────────────────────────────────────── -->
  <div>

    <!-- HERO — split: accent left · blush right -->
    <section style="display:grid;grid-template-columns:1fr 1fr;min-height:88vh;">

      <div style="background:var(--surface-accent);padding:var(--section-pad-y) var(--section-pad-x);display:flex;flex-direction:column;justify-content:flex-end;gap:2rem;" class="cv-reveal">
        <p class="cv-eyebrow" style="color:rgba(253,248,249,0.7);font-size:var(--text-xs);">
          <?php echo esc_html( get_the_title() ?: 'The First Offer Kit' ); ?>
        </p>
        <h1 style="font-family:var(--font-display);font-size:var(--text-display);font-weight:300;line-height:1.0;letter-spacing:var(--tracking-tight);color:var(--surface-white);">
          Stop preparing.<br><em>Start earning.</em>
        </h1>
        <p style="font-size:var(--text-md);line-height:var(--leading-loose);color:rgba(253,248,249,0.7);max-width:360px;">
          You already have everything you need. What you are missing is a clear, simple path.
        </p>
        <div style="display:flex;flex-direction:column;gap:0.75rem;">
          <a href="#cta" class="cv-btn cv-btn--primary" style="align-self:flex-start;">Get instant access &rarr;</a>
          <span style="font-size:11px;letter-spacing:0.10em;color:rgba(253,248,249,0.7);">Delivered instantly as a PDF. No complicated setup.</span>
        </div>
      </div>

      <div style="background:var(--surface-subtle);padding:var(--section-pad-y) var(--section-pad-x);display:flex;flex-direction:column;justify-content:center;align-items:center;gap:2.5rem;" class="cv-reveal">
        <div style="width:100%;max-width:300px;aspect-ratio:3/4;background:var(--surface-muted);border:0.5px solid var(--border-emphasis);position:relative;overflow:hidden;">
          <?php
          $product_img_id = get_post_thumbnail_id();
          if ( $product_img_id ) {
              echo wp_get_attachment_image( $product_img_id, 'cv-portrait', false, [ 'style' => 'width:100%;height:100%;object-fit:cover;filter:sepia(5%) contrast(1.02);' ] );
          } else { ?>
          <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <span style="font-family:monospace;font-size:10px;color:var(--text-muted);text-align:center;line-height:1.8;">product cover<br>(portrait, warm light)</span>
          </div>
          <?php } ?>
        </div>
        <div style="text-align:center;border-top:0.5px solid var(--border-subtle);padding-top:1.5rem;width:100%;max-width:300px;">
          <p style="font-family:var(--font-display);font-size:48px;font-weight:300;line-height:1;color:var(--text-primary);">€37</p>
          <p style="font-size:var(--text-xs);font-weight:300;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-secondary);margin-top:8px;">One payment. Instant access.</p>
        </div>
      </div>

    </section>

    <!-- STATS STRIP — inverse -->
    <section style="background:var(--surface-inverse);padding:4rem var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:var(--section-gap);">
        <?php
        $stats = [
          [ '14', 'days',        'From zero to first product live' ],
          [ '4',  'sections',    'Clear, structured outputs' ],
          [ '€37','one payment', 'No subscription. No upsell.' ],
        ];
        $last = count( $stats ) - 1;
        foreach ( $stats as $i => $st ) : ?>
        <div style="display:flex;flex-direction:column;gap:0.5rem;<?php echo $i < $last ? 'padding-right:var(--section-gap);border-right:0.5px solid var(--border-inverse);' : ''; ?>" class="cv-reveal">
          <p style="font-family:var(--font-display);font-size:48px;font-weight:300;line-height:1;color:var(--accent-light);"><?php echo esc_html( $st[0] ); ?></p>
          <p style="font-size:var(--text-xs);font-weight:500;letter-spacing:var(--tracking-widest);text-transform:uppercase;color:rgba(253,248,249,0.4);"><?php echo esc_html( $st[1] ); ?></p>
          <p style="font-size:var(--text-base);line-height:var(--leading-relaxed);color:rgba(253,248,249,0.5);margin-top:0.5rem;"><?php echo esc_html( $st[2] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- WHAT YOU GET — base -->
    <section style="background:var(--surface-base);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:flex;flex-direction:column;gap:3.5rem;">
        <div style="display:flex;flex-direction:column;gap:1.25rem;" class="cv-reveal">
          <p class="cv-eyebrow cv-eyebrow--rose">What you get</p>
          <h2 style="max-width:500px;">Four outputs. Two weeks. One product <em>live.</em></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;">
          <?php
          $outputs = [
            [ '01', 'The Idea',    'A single validated product idea, chosen for speed and fit — not guessed.' ],
            [ '02', 'The Outline', 'A complete product structure, ready to hand to AI and begin writing.' ],
            [ '03', 'The Draft',   'Your full first product draft, written with AI guidance and reviewed.' ],
            [ '04', 'The Offer',   'A sales page and checkout flow. Your product, ready to sell.' ],
          ];
          foreach ( $outputs as $o ) : ?>
          <div style="display:flex;flex-direction:column;gap:1.25rem;padding:2rem;background:var(--surface-white);border:0.5px solid var(--border-subtle);transition:var(--transition-base);" class="cv-reveal" onmouseenter="this.style.transform='translateY(-3px)';this.style.boxShadow='var(--shadow-warm)';" onmouseleave="this.style.transform='';this.style.boxShadow='';">
            <div class="cv-marker"><div class="cv-marker__inner"></div></div>
            <p style="font-size:var(--text-xs);font-weight:500;letter-spacing:var(--tracking-widest);text-transform:uppercase;color:var(--text-muted);"><?php echo esc_html( $o[0] ); ?></p>
            <h3 style="font-size:var(--text-xl);"><?php echo esc_html( $o[1] ); ?></h3>
            <p style="font-size:var(--text-base);line-height:var(--leading-relaxed);color:var(--text-secondary);"><?php echo esc_html( $o[2] ); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- PULL QUOTE — accent -->
    <section style="background:var(--surface-accent);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-text-quote);margin:0 auto;display:flex;flex-direction:column;gap:2rem;" class="cv-reveal">
        <p style="font-family:var(--font-display);font-size:clamp(22px,2.5vw,32px);font-weight:300;font-style:italic;line-height:var(--leading-normal);color:var(--surface-white);">
          "I built this kit because I was the woman it is designed for. Skilled. Experienced. Skeptical of hype. Cautious with money. I needed a path, not a promise."
        </p>
        <p class="cv-eyebrow" style="color:rgba(253,248,249,0.6);">— Vaska Cvetanoska, Cvetanichin</p>
      </div>
    </section>

    <!-- CREATOR — subtle -->
    <section style="background:var(--surface-subtle);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:center;">

        <div style="position:relative;" class="cv-reveal cv-reveal--left">
          <div style="width:100%;max-width:420px;aspect-ratio:4/5;background:var(--surface-muted);border:0.5px solid var(--border-emphasis);overflow:hidden;position:relative;">
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
              <span style="font-family:monospace;font-size:10px;color:var(--text-muted);text-align:center;line-height:1.8;">creator portrait<br>(warm, natural light)</span>
            </div>
          </div>
          <div style="position:absolute;top:12px;left:12px;right:-12px;bottom:-12px;border:0.5px solid var(--border-strong);pointer-events:none;"></div>
        </div>

        <div style="display:flex;flex-direction:column;gap:1.75rem;" class="cv-reveal cv-reveal--right">
          <p class="cv-eyebrow cv-eyebrow--rose">The creator</p>
          <h2>Vaska Cvetanoska</h2>
          <p style="line-height:var(--leading-loose);color:var(--text-secondary);">A short personal paragraph here — not a CV, not a credentials list. One specific moment or turning point that explains why you built this product and who you built it for.</p>
          <p style="line-height:var(--leading-loose);color:var(--text-secondary);">Second paragraph: what it is like to work through this product. What is specific to your approach, not generic to the category.</p>
        </div>

      </div>
    </section>

    <!-- CTA BLOCK — muted -->
    <section id="cta" style="background:var(--surface-muted);padding:var(--section-pad-y) var(--section-pad-x);border-top:0.5px solid var(--border-subtle);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:center;">

        <h2 style="font-size:clamp(32px,4vw,52px);line-height:1.05;" class="cv-reveal">
          You already have everything you need. What you are missing is a clear, simple <em style="color:var(--text-accent);">path.</em>
        </h2>

        <div style="display:flex;flex-direction:column;gap:1.5rem;" class="cv-reveal">
          <div style="padding-bottom:1.5rem;border-bottom:0.5px solid var(--border-emphasis);">
            <p style="font-family:var(--font-display);font-size:48px;font-weight:300;line-height:1;color:var(--text-primary);">€37</p>
            <p style="font-size:var(--text-xs);letter-spacing:0.15em;text-transform:uppercase;color:var(--text-muted);margin-top:6px;">One payment. No subscription. No upsell.</p>
          </div>
          <?php if ( function_exists( 'woocommerce_template_single_add_to_cart' ) && get_theme_mod( 'cvetanichin_woo_product_id' ) ) :
            global $product;
            $product = wc_get_product( get_theme_mod( 'cvetanichin_woo_product_id' ) );
            woocommerce_template_single_add_to_cart();
          else : ?>
          <a href="#" class="cv-btn cv-btn--primary" style="width:100%;justify-content:center;">
            Get instant access &rarr;
          </a>
          <?php endif; ?>
          <div style="display:flex;flex-direction:column;gap:0.6rem;">
            <?php
            $bullets = [
              'Delivered instantly as a PDF. No complicated setup.',
              'One section per day. Product live within two weeks.',
              'Built for women rebuilding on their own terms.',
            ];
            foreach ( $bullets as $b ) : ?>
            <p style="font-size:var(--text-xs);letter-spacing:0.06em;color:var(--text-muted);display:flex;align-items:center;gap:8px;">
              <span style="display:inline-block;flex-shrink:0;width:6px;height:6px;border-radius:50%;border:0.5px solid var(--border-accent);"></span>
              <?php echo esc_html( $b ); ?>
            </p>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </section>

  </div><!-- /page content -->

  <!-- ─── SIDEBAR ───────────────────────────────────────────────────── -->
  <?php if ( $show_sidebar && is_active_sidebar( 'sidebar-selfimprovement' ) ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-selfimprovement' );
    get_sidebar();
  endif; ?>

</div>

<?php get_footer(); ?>
