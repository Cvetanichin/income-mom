<?php
/**
 * Template Part — Hero
 * Landing page hero: portrait + brand headline + dual-domain CTAs
 *
 * @package Cvetanichin
 */
?>
<section class="cv-hero" aria-labelledby="cv-hero-heading">
  <div class="cv-hero__inner cv-container">

    <div class="cv-hero__content">
      <p class="cv-eyebrow cv-eyebrow--on-dark cv-reveal">The AI Enthusiast</p>

      <h1 id="cv-hero-heading" class="cv-hero__name cv-reveal cv-reveal--delay-1">
        CVETANICHIN
      </h1>

      <p class="cv-hero__tagline cv-reveal cv-reveal--delay-2">
        Bridging civil society and digital self-sufficiency.<br>
        Strategic consultancy for NGOs &amp; donors. Digital products for purposeful income.
      </p>

      <div class="cv-hero__actions cv-reveal cv-reveal--delay-3">
        <a href="<?php echo esc_url( home_url( '/cso-consultancy/' ) ); ?>" class="cv-btn cv-btn--outline-inverse">
          CSO Consultancy &rarr;
        </a>
        <a href="<?php echo esc_url( home_url( '/digital-workspace/' ) ); ?>" class="cv-btn cv-btn--ghost-inverse">
          Digital Workspace &rarr;
        </a>
      </div>
    </div>

    <div class="cv-hero__portrait cv-reveal cv-reveal--right">
      <div class="cv-hero__portrait-frame">
        <div class="cv-hero__portrait-shadow"></div>
        <img
          src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ai-persona.png' ); ?>"
          alt="Vaska Cvetanoska — Cvetanichin"
          width="440"
          height="550"
          loading="eager"
        />
      </div>
    </div>

  </div>
</section>

<style>
.cv-hero {
  background: var(--surface-inverse);
  min-height: 100vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
}

.cv-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 60% 80% at 70% 50%, rgba(229,83,129,0.06) 0%, transparent 70%),
    radial-gradient(ellipse 40% 60% at 20% 80%, rgba(226,192,68,0.04) 0%, transparent 60%);
  pointer-events: none;
}

.cv-hero__inner {
  display: grid;
  grid-template-columns: 1fr 420px;
  gap: 5rem;
  align-items: center;
  padding-top: 6rem;
  padding-bottom: 6rem;
}

.cv-hero__content {
  display: flex;
  flex-direction: column;
  gap: 1.75rem;
  max-width: 540px;
}

.cv-hero__name {
  font-family: var(--font-display);
  font-size: clamp(52px, 6.5vw, 88px);
  font-weight: 200;
  line-height: 0.95;
  letter-spacing: -0.01em;
  color: var(--text-inverse);
}

.cv-hero__tagline {
  font-family: var(--font-body);
  font-size: var(--text-md);
  font-weight: var(--weight-light);
  line-height: var(--leading-relaxed);
  color: rgba(253,248,249,0.55);
  max-width: 420px;
  margin-bottom: 0;
}

.cv-hero__actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.cv-btn--outline-inverse {
  background: transparent;
  color: var(--text-inverse);
  border: 0.5px solid rgba(253,248,249,0.45);
  padding: 14px 28px;
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-wider);
  text-transform: uppercase;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: var(--transition-base);
}
.cv-btn--outline-inverse:hover {
  background: var(--accent-primary);
  border-color: var(--accent-primary);
  color: var(--surface-white);
}

.cv-btn--ghost-inverse {
  background: transparent;
  color: rgba(253,248,249,0.45);
  border: 0.5px solid rgba(253,248,249,0.15);
  padding: 14px 28px;
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-wider);
  text-transform: uppercase;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: var(--transition-base);
}
.cv-btn--ghost-inverse:hover {
  color: var(--text-inverse);
  border-color: rgba(253,248,249,0.35);
}

/* Portrait */
.cv-hero__portrait {
  display: flex;
  justify-content: center;
  align-items: center;
}

.cv-hero__portrait-frame {
  position: relative;
  width: 100%;
  max-width: 380px;
}

.cv-hero__portrait-shadow {
  position: absolute;
  top: 12px;
  left: 12px;
  right: -12px;
  bottom: -12px;
  border: 0.5px solid var(--border-strong);
  pointer-events: none;
  z-index: 0;
}

.cv-hero__portrait-frame img {
  display: block;
  width: 100%;
  aspect-ratio: 4/5;
  object-fit: cover;
  object-position: center top;
  border: 0.5px solid rgba(253,248,249,0.18);
  position: relative;
  z-index: 1;
}

/* Reveal delay helpers */
.cv-reveal--delay-1 { transition-delay: 0.1s; }
.cv-reveal--delay-2 { transition-delay: 0.2s; }
.cv-reveal--delay-3 { transition-delay: 0.3s; }

@media (max-width: 900px) {
  .cv-hero__inner {
    grid-template-columns: 1fr;
    text-align: center;
    gap: 3rem;
    padding-top: 5rem;
    padding-bottom: 4rem;
  }
  .cv-hero__content { max-width: 100%; align-items: center; }
  .cv-hero__tagline { max-width: 500px; }
  .cv-hero__portrait { order: -1; }
  .cv-hero__portrait-frame { max-width: 240px; }
}
</style>
