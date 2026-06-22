<?php
/**
 * Template Part — Footer CTA strip
 *
 * @package Cvetanichin
 */
?>
<section class="cv-section cv-section--footer-cta" aria-labelledby="cv-fcta-heading">
  <div class="cv-container">
    <div class="cv-fcta-inner cv-reveal">

      <div class="cv-fcta-content">
        <p class="cv-eyebrow">Work together</p>
        <h2 id="cv-fcta-heading">
          Ready to move forward?
        </h2>
        <p>
          Whether you need strategic support for your civil society work or want to start building
          digital income &mdash; the next step is simple.
        </p>
      </div>

      <div class="cv-fcta-actions">
        <a href="<?php echo esc_url( home_url( '/cso-consultancy/' ) ); ?>" class="cv-btn cv-btn--outline">
          CSO Enquiry
        </a>
        <a href="https://cvetanichin.gumroad.com" target="_blank" rel="noopener noreferrer" class="cv-btn cv-btn--primary">
          Visit Digital Store &rarr;
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
