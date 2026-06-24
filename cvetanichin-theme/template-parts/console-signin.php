<?php
/**
 * Template Part — Vas Digital Console sign-in panel
 *
 * @package Cvetanichin
 */

$post_id = get_the_ID();
$console_title = get_post_meta( $post_id, 'console_title', true ) ?: 'Vas Digital Console';
$console_desc = get_post_meta( $post_id, 'console_description', true ) ?: 'Your personal creative life space — daily reflection, planning rituals, coaching prompts, and quiet focus. Built for Vaska.';
$console_features = get_post_meta( $post_id, 'console_features', true ) ?: 'Moodboard · Planning · Journal · Coach · Celestial';

// Parse features from comma/dot-separated string
$feature_list = array_map( 'trim', preg_split( '/[·,]/', $console_features ) );
$feature_list = array_filter( $feature_list );
?>
<section class="cv-section cv-section--console" id="vas-digital-console" aria-labelledby="cv-console-heading">
  <div class="cv-container">

    <div class="cv-console-panel cv-reveal">

      <div class="cv-console-panel__inner">

        <div class="cv-console-eyebrow">
          <span class="cv-console-dot"></span>
          <p class="cv-eyebrow cv-eyebrow--on-dark">Private Access</p>
        </div>

        <h2 id="cv-console-heading" class="cv-console-title" data-meta-key="console_title" data-field-type="text">
          <?php echo esc_html( $console_title ); ?>
        </h2>

        <p class="cv-console-desc" data-meta-key="console_description" data-field-type="textarea">
          <?php echo wp_kses_post( $console_desc ); ?>
        </p>

        <div class="cv-console-features">
          <?php
          foreach ( $feature_list as $i => $feature ) {
              if ( $i > 0 ) {
                  echo '<span>&middot;</span>';
              }
              echo '<span>' . esc_html( $feature ) . '</span>';
          }
          ?>
        </div>

        <?php if ( is_user_logged_in() ) : ?>
          <a href="<?php echo esc_url( home_url( '/vas-digital-console/' ) ); ?>"
             class="cv-console-btn cv-console-btn--enter">
            Enter Console &rarr;
          </a>
        <?php else : ?>
          <a href="<?php echo esc_url( wp_login_url( home_url( '/vas-digital-console/' ) ) ); ?>"
             class="cv-console-btn cv-console-btn--signin">
            Sign In to Console &rarr;
          </a>
          <p class="cv-console-note">Access restricted to Vaska.</p>
        <?php endif; ?>

      </div>

    </div>

  </div>
</section>

<style>
.cv-section--console {
  background: var(--surface-inverse, #190828);
  padding: var(--section-pad-y) 0;
  border-top: 0.5px solid rgba(253,248,249,0.07);
}

.cv-console-panel {
  max-width: 520px;
  margin: 0 auto;
  border: 0.5px solid rgba(226,192,68,0.35);
  position: relative;
}

.cv-console-panel::before {
  content: '';
  position: absolute;
  top: 10px;
  left: 10px;
  right: -10px;
  bottom: -10px;
  border: 0.5px solid rgba(226,192,68,0.12);
  pointer-events: none;
}

.cv-console-panel__inner {
  padding: 3rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  align-items: flex-start;
  background: rgba(255,255,255,0.02);
}

.cv-console-eyebrow {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.cv-console-dot {
  width: 6px;
  height: 6px;
  background: #E2C044;
  border-radius: 50%;
  animation: cv-pulse 2.5s ease-in-out infinite;
}

@keyframes cv-pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.3; }
}

.cv-console-title {
  font-family: var(--font-display);
  font-size: clamp(26px, 3.5vw, 38px);
  font-weight: 200;
  letter-spacing: -0.01em;
  color: var(--text-inverse, #FDF8F9);
  line-height: 1.1;
}

.cv-console-desc {
  font-size: var(--text-md);
  font-weight: var(--weight-light);
  line-height: var(--leading-relaxed);
  color: rgba(253,248,249,0.45);
  max-width: 380px;
  margin-bottom: 0;
}

.cv-console-features {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex-wrap: wrap;
  font-family: var(--font-body);
  font-size: 9px;
  font-weight: var(--weight-medium);
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(253,248,249,0.25);
}

.cv-console-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 14px 28px;
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: var(--weight-medium);
  letter-spacing: var(--tracking-wider);
  text-transform: uppercase;
  text-decoration: none;
  transition: var(--transition-base);
  border: none;
  cursor: pointer;
}

.cv-console-btn--enter {
  background: #E2C044;
  color: #1E2019;
}
.cv-console-btn--enter:hover { background: #B89928; color: #1E2019; }

.cv-console-btn--signin {
  background: #E55381;
  color: #FDF8F9;
}
.cv-console-btn--signin:hover { background: #C23368; color: #FDF8F9; }

.cv-console-note {
  font-family: var(--font-body);
  font-size: 10px;
  font-weight: var(--weight-light);
  letter-spacing: 0.1em;
  color: rgba(253,248,249,0.2);
  margin-bottom: 0;
  margin-top: -0.5rem;
}

@media (max-width: 600px) {
  .cv-console-panel__inner { padding: 2rem; }
  .cv-console-panel::before { display: none; }
}
</style>
