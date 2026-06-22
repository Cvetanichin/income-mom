<?php
/**
 * Template Name: Consultancy Page
 * Template Post Type: page
 *
 * Full-width CSO Consultancy landing page — Domain 1.
 * Ochre gold · warm stone · slate.
 * Loads consultancy.css domain theme automatically via functions.php.
 * Includes sticky widget sidebar (right) — toggle via Customizer.
 *
 * @package Cvetanichin
 */

get_header();

$show_sidebar   = (bool) get_theme_mod( 'cvetanichin_landing_sidebar', true );
$headline_style = get_theme_mod( 'cvetanichin_headline_style', 'soft-italic' );
$accent         = get_theme_mod( 'cvetanichin_accent_presence', 'expressive' );
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

    <!-- HERO — slate inverse -->
    <section style="background:var(--surface-inverse);padding:var(--section-pad-y) var(--section-pad-x);min-height:75vh;display:flex;align-items:flex-end;">
      <div style="max-width:var(--max-layout);margin:0 auto;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:flex-end;padding-bottom:1rem;">

        <div style="display:flex;flex-direction:column;gap:2rem;" class="cv-reveal">
          <p class="cv-eyebrow cv-eyebrow--on-dark" style="color:var(--accent-secondary-light, var(--accent-light));">CSO Consultancy</p>
          <h1 style="font-family:var(--font-display);font-size:var(--text-display);font-weight:300;line-height:1.0;letter-spacing:var(--tracking-tight);color:var(--text-inverse);">
            Strategic clarity<br>for organisations<br><em style="color:var(--accent-light);">ready to move.</em>
          </h1>
        </div>

        <div style="display:flex;flex-direction:column;gap:1.5rem;padding-left:var(--section-gap);border-left:0.5px solid var(--border-inverse);" class="cv-reveal" style="transition-delay:0.2s;">
          <p style="font-family:var(--font-body);font-size:var(--text-md);font-weight:300;line-height:var(--leading-loose);color:rgba(250,249,246,0.6);max-width:400px;">
            Fractional CSO services for organisations that need senior strategic leadership without a permanent hire. Clear scope. Direct engagement. Measurable outcomes.
          </p>
          <a href="<?php echo esc_url( get_theme_mod( 'cvetanichin_nav_cta_url', '#enquire' ) ); ?>" class="cv-btn cv-btn--primary" style="width:fit-content;">
            Enquire about availability &rarr;
          </a>
        </div>

      </div>
    </section>

    <!-- SERVICES — base surface -->
    <section style="background:var(--surface-base);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:flex;flex-direction:column;gap:3.5rem;">
        <div style="display:flex;flex-direction:column;gap:1.25rem;" class="cv-reveal">
          <p class="cv-eyebrow">Services</p>
          <h2 style="max-width:460px;">Three ways to work <em>together.</em></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;">

          <?php
          $services = [
            [ 'Fractional CSO',    'Ongoing strategic leadership', 'Embedded part-time presence in your leadership team. Strategy, decision support, and board-level communication.' ],
            [ 'Strategy Intensive','Focused three-day engagement',  'One question. One team. Three days to a decision and a plan. For organisations that need to move fast without moving wrong.' ],
            [ 'Advisory Retainer', 'Senior thinking, on call',      'Monthly retained access for questions, reviews, and critical thinking at decisive moments. No overhead of a full engagement.' ],
          ];
          foreach ( $services as $s ) : ?>
          <div style="display:flex;flex-direction:column;gap:1.5rem;padding:2.5rem;background:var(--surface-white);border:0.5px solid var(--border-subtle);transition:var(--transition-base);" class="cv-reveal" onmouseenter="this.style.transform='translateY(-3px)';this.style.borderColor='var(--border-emphasis)';this.style.boxShadow='var(--shadow-warm)'" onmouseleave="this.style.transform='';this.style.borderColor='var(--border-subtle)';this.style.boxShadow=''">
            <div class="cv-marker"><div class="cv-marker__inner"></div></div>
            <div style="display:flex;flex-direction:column;gap:0.75rem;">
              <p class="cv-eyebrow"><?php echo esc_html( $s[0] ); ?></p>
              <h3 style="font-size:24px;"><?php echo esc_html( $s[1] ); ?></h3>
              <p style="font-size:var(--text-base);line-height:var(--leading-relaxed);color:var(--text-secondary);"><?php echo esc_html( $s[2] ); ?></p>
            </div>
            <a href="<?php echo esc_url( get_theme_mod( 'cvetanichin_nav_cta_url', '#enquire' ) ); ?>" class="cv-btn cv-btn--ghost" style="align-self:flex-start;">Learn more &rarr;</a>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </section>

    <!-- APPROACH + INSET QUOTE — subtle surface -->
    <section style="background:var(--surface-subtle);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:center;">

        <div style="display:flex;flex-direction:column;gap:2rem;" class="cv-reveal cv-reveal--left">
          <p class="cv-eyebrow">Approach</p>
          <h2 style="font-size:clamp(24px,2.5vw,34px);">Strategy is only useful when it connects to what an organisation can actually do.</h2>
          <p style="font-size:var(--text-md);line-height:var(--leading-loose);color:var(--text-secondary);max-width:460px;">Every engagement starts with a diagnostic. Not a template — a conversation. What is the actual decision? What is blocking movement? What exists that is not being used?</p>
        </div>

        <div style="padding:2.5rem;background:var(--surface-white);border:0.5px solid var(--border-subtle);border-left:2px solid var(--accent-primary);display:flex;flex-direction:column;gap:1.5rem;" class="cv-reveal cv-reveal--right">
          <p style="font-family:var(--font-display);font-size:var(--text-xl);font-weight:300;font-style:italic;line-height:var(--leading-normal);color:var(--text-primary);">"The work is not to write the strategy. The work is to make the decision that makes the strategy possible."</p>
          <p class="cv-eyebrow" style="color:var(--text-accent);">— Vaska Cvetanoska</p>
        </div>

      </div>
    </section>

    <!-- ABOUT — base surface -->
    <section style="background:var(--surface-base);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:center;">

        <div style="display:flex;flex-direction:column;gap:1.75rem;" class="cv-reveal">
          <p class="cv-eyebrow">About</p>
          <h2>Vaska Cvetanoska</h2>
          <?php
          // Use About page content if linked, else placeholder
          $about_id = get_theme_mod( 'cvetanichin_about_page' );
          if ( $about_id ) {
              $about = get_post( $about_id );
              echo wp_kses_post( wpautop( wp_trim_words( $about->post_content, 60 ) ) );
          } else { ?>
          <p style="color:var(--text-secondary);line-height:var(--leading-loose);">Senior strategic leadership for organisations that need a Chief Strategy Officer without a permanent hire. Three engagement formats, one consistent approach: make the decision that makes the strategy possible.</p>
          <p style="color:var(--text-secondary);line-height:var(--leading-loose);">Direct. Evidence-led. Comfortable with complexity and committed to clarity.</p>
          <?php } ?>
          <a href="<?php echo esc_url( get_theme_mod( 'cvetanichin_nav_cta_url', '#enquire' ) ); ?>" class="cv-btn cv-btn--outline" style="align-self:flex-start;">Enquire about availability &rarr;</a>
        </div>

        <div style="position:relative;" class="cv-reveal cv-reveal--right">
          <div style="width:100%;max-width:440px;margin-left:auto;aspect-ratio:4/5;background:var(--surface-muted);border:0.5px solid var(--border-emphasis);overflow:hidden;position:relative;">
            <?php if ( has_post_thumbnail() ) :
              the_post_thumbnail( 'cv-portrait', [ 'style' => 'width:100%;height:100%;object-fit:cover;filter:sepia(5%) contrast(1.02);' ] );
            else : ?>
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
              <span style="font-family:monospace;font-size:10px;color:var(--text-muted);text-align:center;line-height:1.8;">consultant portrait<br>(natural, professional)</span>
            </div>
            <?php endif; ?>
          </div>
          <div style="position:absolute;top:12px;left:12px;right:-12px;bottom:-12px;border:0.5px solid var(--border-strong);pointer-events:none;"></div>
        </div>

      </div>
    </section>

    <!-- CTA — inverse -->
    <section id="enquire" style="background:var(--surface-inverse);padding:var(--section-pad-y) var(--section-pad-x);">
      <div style="max-width:var(--max-layout);margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:var(--section-gap);align-items:center;">
        <h2 style="font-size:clamp(32px,4vw,52px);line-height:1.05;color:var(--text-inverse);" class="cv-reveal">
          Serious about your next move? <em style="color:var(--accent-light);">Let's talk.</em>
        </h2>
        <div style="display:flex;flex-direction:column;gap:1.5rem;padding-left:var(--section-gap);border-left:0.5px solid var(--border-inverse);" class="cv-reveal">
          <p style="font-size:var(--text-md);line-height:var(--leading-loose);color:rgba(250,249,246,0.6);">Availability is limited. Engagements begin with a 30-minute diagnostic call — no commitment, no pitch.</p>
          <?php if ( function_exists( 'gravity_form' ) ) :
            gravity_form( get_theme_mod( 'cvetanichin_enquiry_form_id', 1 ), false, false, false, '', true, 1 );
          else : ?>
          <a href="mailto:<?php echo esc_html( antispambot( get_theme_mod( 'cvetanichin_email', 'hello@cvetanichin.com' ) ) ); ?>" class="cv-btn cv-btn--primary">
            Request a diagnostic call &rarr;
          </a>
          <span style="font-size:var(--text-xs);letter-spacing:0.10em;color:rgba(250,249,246,0.35);">Response within 48 hours.</span>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </div><!-- /page content -->

  <!-- ─── SIDEBAR ───────────────────────────────────────────────────── -->
  <?php if ( $show_sidebar && is_active_sidebar( 'sidebar-consultancy' ) ) :
    set_query_var( 'cvetanichin_sidebar_id', 'sidebar-consultancy' );
    get_sidebar();
  endif; ?>

</div>

<?php get_footer(); ?>
