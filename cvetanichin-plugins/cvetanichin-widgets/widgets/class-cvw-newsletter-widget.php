<?php
/**
 * Cvetanichin Newsletter Widget — email opt-in form.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_newsletter', __( 'Cvetanichin — Newsletter', 'cvetanichin-widgets' ), [
            'description' => __( 'Email opt-in form. Integrates with Mailchimp via form action URL or WP forms plugin shortcode.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--newsletter',
        ] );
    }

    public function widget( $args, $instance ) {
        $headline  = $instance['headline']  ?? 'Stay close.';
        $subtext   = $instance['subtext']   ?? 'Occasional essays and new product announcements. No noise.';
        $btn_label = $instance['btn_label'] ?? 'Subscribe';
        $action    = $instance['action']    ?? '#';
        $shortcode = $instance['shortcode'] ?? '';

        echo wp_kses_post( $args['before_widget'] );
        ?>
        <div style="display:flex;flex-direction:column;gap:1rem;">
          <?php if ( $headline ) : ?>
          <p style="font-family:var(--font-display);font-size:21px;font-weight:300;line-height:1.2;color:var(--text-primary);"><?php echo esc_html( $headline ); ?></p>
          <?php endif; ?>
          <?php if ( $subtext ) : ?>
          <p style="font-size:13px;line-height:1.75;color:var(--text-secondary);"><?php echo esc_html( $subtext ); ?></p>
          <?php endif; ?>

          <?php if ( $shortcode ) :
            echo do_shortcode( wp_kses_post( $shortcode ) );
          else : ?>
          <form method="post" action="<?php echo esc_url( $action ); ?>" style="display:flex;flex-direction:column;gap:0.75rem;">
            <?php wp_nonce_field( 'cvw_newsletter', 'cvw_nl_nonce' ); ?>
            <input type="email" name="EMAIL" placeholder="you@example.com" required
              style="width:100%;padding:12px 14px;background:var(--surface-base);border:0.5px solid var(--border-emphasis);color:var(--text-primary);font-family:var(--font-body);font-size:13px;outline:none;transition:all 0.25s ease;"
              onfocus="this.style.borderColor='var(--accent-primary)'" onblur="this.style.borderColor='var(--border-emphasis)'">
            <button type="submit"
              style="width:100%;padding:12px 20px;background:var(--accent-primary);border:none;color:var(--accent-fg,var(--surface-white));font-family:var(--font-body);font-size:11px;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;cursor:pointer;transition:all 0.25s ease;"
              onmouseover="this.style.background='var(--accent-deep)'" onmouseout="this.style.background='var(--accent-primary)'">
              <?php echo esc_html( $btn_label ); ?> &rarr;
            </button>
          </form>
          <?php endif; ?>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        foreach ( [
            'headline'  => [ 'Headline', 'Stay close.' ],
            'subtext'   => [ 'Subtext', 'Occasional essays and new product announcements.' ],
            'btn_label' => [ 'Button label', 'Subscribe' ],
            'action'    => [ 'Form action URL (or leave # for shortcode)', '#' ],
            'shortcode' => [ 'Shortcode (overrides built-in form if set)', '' ],
        ] as $key => [ $lbl, $default ] ) :
        $val = $instance[ $key ] ?? $default;
        ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $lbl ); ?>:</label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $val ); ?>">
        </p>
        <?php endforeach;
    }

    public function update( $new, $old ) {
        return [
            'headline'  => sanitize_text_field( $new['headline']  ?? '' ),
            'subtext'   => sanitize_textarea_field( $new['subtext'] ?? '' ),
            'btn_label' => sanitize_text_field( $new['btn_label'] ?? 'Subscribe' ),
            'action'    => esc_url_raw( $new['action'] ?? '#' ),
            'shortcode' => sanitize_text_field( $new['shortcode'] ?? '' ),
        ];
    }
}
