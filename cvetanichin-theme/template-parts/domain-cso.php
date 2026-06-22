<?php
/**
 * Template Part — Domain 1: CSO Consultancy
 *
 * @package Cvetanichin
 */
?>
<section class="cv-section cv-section--cso" id="cso-consultancy" aria-labelledby="cv-cso-heading">
  <div class="cv-container">

    <div class="cv-section-header cv-reveal">
      <p class="cv-eyebrow">Domain 01 &mdash; NGOs &middot; Foundations &middot; Donors</p>
      <h2 id="cv-cso-heading">Grant support. Donor compliance.<br>CSO development.</h2>
      <p class="cv-section-lead">
        Strategic services for civil society organisations, foundations, and international donors
        navigating grant cycles, compliance requirements, and institutional capacity.
      </p>
    </div>

    <div class="cv-cso-grid">

      <div class="cv-cso-card cv-reveal cv-reveal--delay-1">
        <div class="cv-cso-card__marker">01</div>
        <h3 class="cv-cso-card__title">Grant Support</h3>
        <p class="cv-cso-card__body">
          Proposal writing, budget narrative design, funder research, and application
          strategy across EU, bilateral, and philanthropic funding streams.
        </p>
      </div>

      <div class="cv-cso-card cv-reveal cv-reveal--delay-2">
        <div class="cv-cso-card__marker">02</div>
        <h3 class="cv-cso-card__title">Donor Compliance</h3>
        <p class="cv-cso-card__body">
          Reporting frameworks, audit preparation, financial tracking, and donor
          communication systems that keep your organisation accountable and fundable.
        </p>
      </div>

      <div class="cv-cso-card cv-reveal cv-reveal--delay-3">
        <div class="cv-cso-card__marker">03</div>
        <h3 class="cv-cso-card__title">CSO Capacity Building</h3>
        <p class="cv-cso-card__body">
          Governance strengthening, team development, strategic planning, and
          organisational systems that support sustainable institutional growth.
        </p>
      </div>

    </div>

    <div class="cv-section-cta cv-reveal">
      <a href="<?php echo esc_url( home_url( '/cso-consultancy/' ) ); ?>" class="cv-btn cv-btn--outline">
        Explore Consultancy Services &rarr;
      </a>
    </div>

  </div>
</section>

<style>
.cv-section--cso {
  background: var(--surface-base, #EDEAE5);
  padding: var(--section-pad-y) 0;
}

/* Override tokens for CSO domain within this section */
.cv-section--cso {
  --accent-primary:  #E2C044;
  --accent-deep:     #B89928;
  --accent-light:    #EDDA85;
  --text-primary:    #1E2019;
  --text-secondary:  #393E41;
  --text-muted:      #8A9298;
  --surface-base:    #EDEAE5;
  --surface-white:   #FAF9F6;
  --border-subtle:   rgba(226,192,68,0.15);
  --border-strong:   rgba(226,192,68,0.35);
}

.cv-section--cso .cv-eyebrow { color: var(--text-muted); }

.cv-section-header {
  max-width: 640px;
  margin-bottom: 4rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.cv-section-header h2 {
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 200;
  color: var(--text-primary, #1E2019);
  line-height: 1.1;
}

.cv-section-lead {
  font-size: var(--text-md);
  font-weight: var(--weight-light);
  line-height: var(--leading-relaxed);
  color: var(--text-secondary, #393E41);
  max-width: 520px;
  margin-bottom: 0;
}

.cv-cso-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5px;
  margin-bottom: 4rem;
}

.cv-cso-card {
  background: var(--surface-white, #FAF9F6);
  border: 0.5px solid var(--border-subtle, rgba(226,192,68,0.15));
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  transition: var(--transition-base);
}

.cv-cso-card:hover {
  border-color: var(--border-strong, rgba(226,192,68,0.35));
  box-shadow: var(--shadow-warm, 0 4px 24px rgba(180,153,40,0.10));
  transform: translateY(-3px);
}

.cv-cso-card__marker {
  font-family: var(--font-display);
  font-size: 11px;
  font-weight: 200;
  letter-spacing: 0.25em;
  color: var(--accent-primary, #E2C044);
}

.cv-cso-card__title {
  font-family: var(--font-display);
  font-size: var(--text-2xl);
  font-weight: 200;
  line-height: var(--leading-snug);
  color: var(--text-primary, #1E2019);
}

.cv-cso-card__body {
  font-size: var(--text-base);
  font-weight: var(--weight-light);
  line-height: var(--leading-loose);
  color: var(--text-secondary, #393E41);
  margin-bottom: 0;
}

.cv-section-cta { display: flex; }
.cv-section--cso .cv-btn--outline {
  color: var(--text-primary, #1E2019);
  border-color: rgba(226,192,68,0.45);
}
.cv-section--cso .cv-btn--outline:hover {
  background: var(--accent-primary, #E2C044);
  border-color: var(--accent-primary, #E2C044);
  color: #1E2019;
}

@media (max-width: 900px) { .cv-cso-grid { grid-template-columns: 1fr; gap: 1px; } }
</style>
