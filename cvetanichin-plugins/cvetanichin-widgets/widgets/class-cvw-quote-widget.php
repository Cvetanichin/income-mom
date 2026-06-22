<?php
/**
 * Cvetanichin Pull Quote Widget.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Quote_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_quote', __( 'Cvetanichin — Pull Quote', 'cvetanichin-widgets' ), [
            'description' => __( 'A calm, italic serif quote — accent, plain, or inset variant.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--quote',
        ] );
    }

    public function widget( $args, $instance ) {
        $quote       = $instance['quote']       ?? '';
        $attribution = $instance['attribution'] ?? '';
        $variant     = $instance['variant']     ?? 'inset';

        if ( ! $quote ) return;

        $is_accent  = 'accent'  === $variant;
        $is_inset   = 'inset'   === $variant;

        $bg = $is_accent ? 'var(--surface-accent)' : 'var(--surface-white)';
        $tc = $is_accent ? 'var(--surface-white)'  : 'var(--text-primary)';
        $border = $is_inset ? 'border-left:2px solid var(--accent-primary);' : '';
        $pl     = $is_inset ? 'padding-left:1.25rem;' : '';

        echo wp_kses_post( $args['before_widget'] );
        ?>
        <div style="background:<?php echo esc_attr( $bg ); ?>;padding:1.5rem;<?php echo esc_attr( $border . $pl ); ?>display:flex;flex-direction:column;gap:1rem;">
          <p style="font-family:var(--font-display);font-size:18px;font-weight:300;font-style:italic;line-height:1.6;color:<?php echo esc_attr( $tc ); ?>;">"<?php echo esc_html( $quote ); ?>"</p>
          <?php if ( $attribution ) : ?>
          <p style="font-size:10px;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;color:<?php echo $is_accent ? 'rgba(253,248,249,0.55)' : 'var(--text-accent)'; ?>;"><?php echo esc_html( $attribution ); ?></p>
          <?php endif; ?>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        $quote       = $instance['quote']       ?? '';
        $attribution = $instance['attribution'] ?? '';
        $variant     = $instance['variant']     ?? 'inset';
        ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>"><?php esc_html_e( 'Quote text:', 'cvetanichin-widgets' ); ?></label>
          <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quote' ) ); ?>" rows="4"><?php echo esc_textarea( $quote ); ?></textarea>
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'attribution' ) ); ?>"><?php esc_html_e( 'Attribution:', 'cvetanichin-widgets' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'attribution' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'attribution' ) ); ?>" type="text" value="<?php echo esc_attr( $attribution ); ?>">
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'variant' ) ); ?>"><?php esc_html_e( 'Style variant:', 'cvetanichin-widgets' ); ?></label>
          <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'variant' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'variant' ) ); ?>">
            <?php foreach ( [ 'inset' => 'Inset (accent border)', 'plain' => 'Plain (white bg)', 'accent' => 'Accent (brand fill)' ] as $v => $l ) : ?>
            <option value="<?php echo esc_attr( $v ); ?>" <?php selected( $variant, $v ); ?>><?php echo esc_html( $l ); ?></option>
            <?php endforeach; ?>
          </select>
        </p>
        <?php
    }

    public function update( $new, $old ) {
        return [
            'quote'       => sanitize_textarea_field( $new['quote'] ?? '' ),
            'attribution' => sanitize_text_field( $new['attribution'] ?? '' ),
            'variant'     => in_array( $new['variant'] ?? '', [ 'inset', 'plain', 'accent' ], true ) ? $new['variant'] : 'inset',
        ];
    }
}
