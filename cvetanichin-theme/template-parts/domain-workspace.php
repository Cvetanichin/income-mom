<?php
/**
 * Template Part — Domain 2: Self-Improvement Workspace intro
 *
 * @package Cvetanichin
 */

$post_id = get_the_ID();
$eyebrow = get_post_meta( $post_id, 'domain_workspace_eyebrow', true ) ?: 'Domain 02 — Digital Products for Income';
$headline = get_post_meta( $post_id, 'domain_workspace_headline', true ) ?: 'Build your first income stream.<br>On your own terms.';
$paragraph = get_post_meta( $post_id, 'domain_workspace_paragraph', true ) ?: 'Structured digital products for people who are ready to turn knowledge into income without the hype, hustle, or guesswork. Everything is practical, downloadable, and built around honest self-reflection and clear next steps.';
$stats = get_post_meta( $post_id, 'domain_workspace_stats', true ) ?: [];

// Default stats if none exist
if ( empty( $stats ) ) {
    $stats = [
        [ 'value' => '2', 'label' => 'Products available now', 'description' => '' ],
        [ 'value' => '€79', 'label' => 'Flagship system — instant download', 'description' => '' ],
        [ 'value' => '52', 'label' => 'Pages — structured, fillable, focused', 'description' => '' ]
    ];
}
?>
<section class="cv-section cv-section--workspace" id="digital-workspace" aria-labelledby="cv-ws-heading">
  <div class="cv-container">

    <div class="cv-ws-grid cv-reveal">
      <div class="cv-ws-content">
        <p class="cv-eyebrow cv-eyebrow--rose"><?php echo wp_kses_post( $eyebrow ); ?></p>
        <h2 id="cv-ws-heading"><?php echo wp_kses_post( $headline ); ?></h2>
        <p>
          <?php echo wp_kses_post( $paragraph ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/digital-workspace/' ) ); ?>" class="cv-btn cv-btn--primary">
          See All Products &rarr;
        </a>
      </div>

      <div class="cv-ws-stats">
        <?php
        foreach ( $stats as $i => $stat ) {
            $delay = $i + 1;
            ?>
            <div class="cv-ws-stat cv-reveal cv-reveal--delay-<?php echo esc_attr( $delay ); ?>">
              <span class="cv-ws-stat__number"><?php echo esc_html( $stat['value'] ?? '' ); ?></span>
              <span class="cv-ws-stat__label"><?php echo wp_kses_post( $stat['label'] ?? '' ); ?></span>
            </div>
            <?php
        }
        ?>
      </div>
    </div>

  </div>
</section>

<style>
.cv-section--workspace {
  background: var(--surface-inverse, #190828);
  padding: var(--section-pad-y) 0;
}

.cv-section--workspace .cv-eyebrow--rose { color: var(--color-pink, #E55381); }

.cv-ws-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--section-gap);
  align-items: center;
}

.cv-ws-content {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.cv-ws-content h2 {
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 200;
  color: var(--text-inverse, #FDF8F9);
  line-height: 1.1;
}

.cv-ws-content p {
  font-size: var(--text-md);
  font-weight: var(--weight-light);
  line-height: var(--leading-loose);
  color: rgba(253,248,249,0.55);
  max-width: 420px;
  margin-bottom: 0;
}

.cv-ws-stats {
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
  padding-left: 3rem;
  border-left: 0.5px solid rgba(253,248,249,0.10);
}

.cv-ws-stat {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

.cv-ws-stat__number {
  font-family: var(--font-display);
  font-size: clamp(32px, 4vw, 52px);
  font-weight: 200;
  line-height: 1;
  letter-spacing: -0.02em;
  color: var(--color-pink, #E55381);
}

.cv-ws-stat__label {
  font-family: var(--font-body);
  font-size: var(--text-xs);
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-widest);
  text-transform: uppercase;
  color: rgba(253,248,249,0.35);
}

@media (max-width: 768px) {
  .cv-ws-grid { grid-template-columns: 1fr; gap: 3rem; }
  .cv-ws-stats { padding-left: 0; border-left: none; border-top: 0.5px solid rgba(253,248,249,0.10); padding-top: 2.5rem; flex-direction: row; flex-wrap: wrap; gap: 2rem; }
}
</style>
