<?php
/**
 * Template Part — Footer CTA strip
 *
 * @package Cvetanichin
 */

$post_id = get_the_ID();
$eyebrow = get_post_meta( $post_id, 'footer_cta_eyebrow', true ) ?: 'Work together';
$headline = get_post_meta( $post_id, 'footer_cta_headline', true ) ?: 'Ready to move forward?';
$paragraph = get_post_meta( $post_id, 'footer_cta_paragraph', true ) ?: 'Whether you need strategic support for your civil society work or want to start building digital income — the next step is simple.';
$link1_label = get_post_meta( $post_id, 'footer_cta_link1_label', true ) ?: 'CSO Enquiry';
$link1_url = get_post_meta( $post_id, 'footer_cta_link1_url', true ) ?: home_url( '/cso-consultancy/' );
$link2_label = get_post_meta( $post_id, 'footer_cta_link2_label', true ) ?: 'Visit Digital Store →';
$link2_url = get_post_meta( $post_id, 'footer_cta_link2_url', true ) ?: 'https://cvetanichin.gumroad.com';
?>
<section class="cv-section cv-section--footer-cta" aria-labelledby="cv-fcta-heading">
  <div class="cv-container">
    <div class="cv-fcta-inner cv-reveal">

      <div class="cv-fcta-content">
        <p class="cv-eyebrow" data-meta-key="footer_cta_eyebrow" data-field-type="text"><?php echo esc_html( $eyebrow ); ?></p>
        <h2 id="cv-fcta-heading" data-meta-key="footer_cta_headline" data-field-type="text">
          <?php echo wp_kses_post( $headline ); ?>
        </h2>
        <p data-meta-key="footer_cta_paragraph" data-field-type="textarea">
          <?php echo wp_kses_post( $paragraph ); ?>
        </p>
      </div>

      <div class="cv-fcta-actions">
        <a href="<?php echo esc_url( $link1_url ); ?>" class="cv-btn cv-btn--outline">
          <?php echo esc_html( $link1_label ); ?>
        </a>
        <a href="<?php echo esc_url( $link2_url ); ?>" target="_blank" rel="noopener noreferrer" class="cv-btn cv-btn--primary">
          <?php echo esc_html( $link2_label ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<style>
.cv-section--footer-cta {
  background: var(--surface-muted, #EDE5E6);
  padding: 4rem 0;
  border-top: 0.5px solid var(--border-subtle);
}

.cv-fcta-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 3rem;
}

.cv-fcta-content {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  max-width: 480px;
}

.cv-fcta-content h2 {
  font-size: clamp(24px, 3vw, 36px);
  font-weight: 200;
  line-height: 1.1;
  color: var(--text-primary);
}

.cv-fcta-content p {
  font-size: var(--text-base);
  font-weight: var(--weight-light);
  line-height: var(--leading-loose);
  color: var(--text-secondary);
  margin-bottom: 0;
}

.cv-fcta-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-shrink: 0;
  flex-wrap: wrap;
}

@media (max-width: 768px) {
  .cv-fcta-inner { flex-direction: column; align-items: flex-start; }
  .cv-fcta-actions { width: 100%; }
}
</style>
