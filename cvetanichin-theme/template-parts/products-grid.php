<?php
/**
 * Template Part — Products Grid
 * Gumroad product cards + Creative Life Space teaser
 *
 * @package Cvetanichin
 */
?>
<section class="cv-section cv-section--products" id="products" aria-labelledby="cv-products-heading">
  <div class="cv-container">

    <div class="cv-section-header cv-reveal">
      <p class="cv-eyebrow">Digital Products</p>
      <h2 id="cv-products-heading">Available now on Gumroad</h2>
    </div>

    <div class="cv-products-grid">

      <!-- Product 1: Clarity-to-Action Operating System -->
      <article class="cv-product-card cv-reveal cv-reveal--delay-1">
        <div class="cv-product-card__accent"></div>
        <div class="cv-product-card__image">
          <img
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gumroad-cover.png' ); ?>"
            alt="Clarity-to-Action Operating System product cover"
            loading="lazy"
            width="800"
            height="450"
          />
        </div>
        <div class="cv-product-card__body">
          <p class="cv-eyebrow">Workbook &middot; 52 pages &middot; Fillable PDF</p>
          <h3 class="cv-product-card__title">Clarity-to-Action<br>Operating System</h3>
          <p class="cv-product-card__desc">
            A 4-stage system that turns honest self-reflection into a results-based 90-day plan.
            Life audit, energy diagnosis, values clarification, and a structured action framework.
          </p>
          <div class="cv-product-card__footer">
            <span class="cv-product-card__price">&euro;79</span>
            <a href="https://cvetanichin.gumroad.com/l/clarity-to-action"
               class="cv-btn cv-btn--primary"
               target="_blank"
               rel="noopener noreferrer">
              Buy on Gumroad &rarr;
            </a>
          </div>
        </div>
      </article>

      <!-- Product 2: AI Income Starter Kit -->
      <article class="cv-product-card cv-reveal cv-reveal--delay-2">
        <div class="cv-product-card__accent"></div>
        <div class="cv-product-card__image">
          <img
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/the-signature-workbook.png' ); ?>"
            alt="AI Income Starter Kit product cover"
            loading="lazy"
            width="1024"
            height="1024"
          />
        </div>
        <div class="cv-product-card__body">
          <p class="cv-eyebrow">Guide &middot; Instant Download &middot; PDF</p>
          <h3 class="cv-product-card__title">AI Income<br>Starter Kit</h3>
          <p class="cv-product-card__desc">
            Everything you need to build and launch your first digital product.
            Offer clarity, section drafting, sales copy, and a step-by-step launch framework.
          </p>
          <div class="cv-product-card__footer">
            <span class="cv-product-card__price">&mdash;</span>
            <a href="https://cvetanichin.gumroad.com/l/ai-income-starter-kit"
               class="cv-btn cv-btn--primary"
               target="_blank"
               rel="noopener noreferrer">
              Buy on Gumroad &rarr;
            </a>
          </div>
        </div>
      </article>

      <!-- Product 3: Creative Life Space (coming soon) -->
      <article class="cv-product-card cv-product-card--soon cv-reveal cv-reveal--delay-3">
        <div class="cv-product-card__accent cv-product-card__accent--muted"></div>
        <div class="cv-product-card__image cv-product-card__image--placeholder">
          <div class="cv-product-placeholder">
            <span>VAS</span>
            <span>CONSOLE</span>
          </div>
        </div>
        <div class="cv-product-card__body">
          <div class="cv-product-soon-badge">Coming Soon</div>
          <h3 class="cv-product-card__title">Vaska&rsquo;s Creative<br>Life Space</h3>
          <p class="cv-product-card__desc">
            A personal dashboard for reflection, planning, and creative focus.
            Daily rituals, moodboards, coaching prompts, and family moments &mdash; in one quiet space.
          </p>
          <div class="cv-product-card__footer">
            <span class="cv-product-card__price cv-product-card__price--muted">WordPress Plugin</span>
          </div>
        </div>
      </article>

    </div>

  </div>
</section>

<style>
.cv-section--products {
  background: var(--surface-white, #FDF8F9);
  padding: var(--section-pad-y) 0;
}

.cv-section--products .cv-section-header {
  margin-bottom: 3.5rem;
}

.cv-products-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5px;
}

.cv-product-card {
  background: var(--surface-white, #FDF8F9);
  border: 0.5px solid var(--border-subtle);
  display: flex;
  flex-direction: column;
  transition: var(--transition-base);
  position: relative;
  overflow: hidden;
}

.cv-product-card:hover {
  box-shadow: var(--shadow-warm);
  transform: translateY(-3px);
  border-color: var(--border-emphasis);
}

.cv-product-card--soon { opacity: 0.75; }
.cv-product-card--soon:hover { transform: none; box-shadow: none; }

.cv-product-card__accent {
  height: 3px;
  background: var(--accent-primary, #E55381);
  flex-shrink: 0;
}

.cv-product-card__accent--muted {
  background: var(--border-subtle);
}

.cv-product-card__image {
  width: 100%;
  aspect-ratio: 16/9;
  overflow: hidden;
  flex-shrink: 0;
}

.cv-product-card__image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: var(--transition-base);
}

.cv-product-card:hover .cv-product-card__image img {
  transform: scale(1.02);
}

.cv-product-card__image--placeholder {
  background: var(--surface-inverse, #190828);
  display: flex;
  align-items: center;
  justify-content: center;
}

.cv-product-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
  font-family: var(--font-display);
  font-weight: 200;
  letter-spacing: 0.2em;
  color: rgba(253,248,249,0.25);
  font-size: clamp(18px, 2.5vw, 28px);
}

.cv-product-card__body {
  padding: 2rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  flex: 1;
}

.cv-product-card__title {
  font-family: var(--font-display);
  font-size: var(--text-2xl);
  font-weight: 200;
  line-height: var(--leading-snug);
  color: var(--text-primary);
}

.cv-product-card__desc {
  font-size: var(--text-base);
  font-weight: var(--weight-light);
  line-height: var(--leading-loose);
  color: var(--text-secondary);
  margin-bottom: 0;
  flex: 1;
}

.cv-product-card__footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  margin-top: auto;
  padding-top: 1.25rem;
  border-top: 0.5px solid var(--border-subtle);
}

.cv-product-card__price {
  font-family: var(--font-display);
  font-size: var(--text-3xl);
  font-weight: 200;
  letter-spacing: -0.02em;
  color: var(--text-primary);
}

.cv-product-card__price--muted {
  font-family: var(--font-body);
  font-size: var(--text-xs);
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-widest);
  text-transform: uppercase;
  color: var(--text-muted);
}

.cv-product-soon-badge {
  display: inline-flex;
  align-items: center;
  padding: 4px 10px;
  font-family: var(--font-body);
  font-size: 9px;
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-widest);
  text-transform: uppercase;
  border: 0.5px solid var(--border-subtle);
  color: var(--text-muted);
  align-self: flex-start;
}

@media (max-width: 900px) { .cv-products-grid { grid-template-columns: 1fr; } }
@media (min-width: 600px) and (max-width: 900px) { .cv-products-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
