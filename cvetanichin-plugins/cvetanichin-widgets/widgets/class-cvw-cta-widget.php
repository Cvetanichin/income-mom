<?php
/**
 * Cvetanichin CTA Widget
 * A styled call-to-action block for sidebars.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_CTA_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'cvw_cta',
            __( 'Cvetanichin — CTA', 'cvetanichin-widgets' ),
            [
                'description' => __( 'A styled call-to-action block with headline, body text and button.', 'cvetanichin-widgets' ),
                'classname'   => 'cvw-widget cvw-widget--cta',
            ]
        );
    }

    public function widget( $args, $instance ) {
        $title       = ! empty( $instance['title'] )       ? $instance['title']       : '';
        $body        = ! empty( $instance['body'] )        ? $instance['body']        : '';
        $btn_label   = ! empty( $instance['btn_label'] )   ? $instance['btn_label']   : 'Enquire';
        $btn_url     = ! empty( $instance['btn_url'] )     ? $instance['btn_url']     : '#';
        $style       = ! empty( $instance['style'] )       ? $instance['style']       : 'accent';

        $bg = 'accent' === $style ? 'var(--surface-accent)' : ( 'inverse' === $style ? 'var(--surface-inverse)' : 'var(--surface-white)' );
        $tc = ( 'plain' === $style ) ? 'var(--text-primary)' : 'var(--text-inverse)';

        echo wp_kses_post( $args['before_widget'] );
        ?>
        <div style="background:<?php echo esc_attr( $bg ); ?>;padding:1.75rem;display:flex;flex-direction:column;gap:1.25rem;">
          <?php if ( $title ) : ?>
          <h3 style="font-family:var(--font-display);font-size:21px;font-weight:300;line-height:1.2;color:<?php echo esc_attr( $tc ); ?>;"><?php echo esc_html( $title ); ?></h3>
          <?php endif; ?>
          <?php if ( $body ) : ?>
          <p style="font-size:13px;line-height:1.75;color:<?php echo ( 'plain' === $style ) ? 'var(--text-secondary)' : 'rgba(253,248,249,0.7)'; ?>;"><?php echo esc_html( $body ); ?></p>
          <?php endif; ?>
          <a href="<?php echo esc_url( $btn_url ); ?>"
             style="display:inline-flex;align-items:center;gap:0.5rem;padding:12px 20px;background:<?php echo ( 'plain' === $style ) ? 'var(--accent-primary)' : 'transparent'; ?>;border:0.5px solid <?php echo ( 'plain' === $style ) ? 'var(--accent-primary)' : 'rgba(253,248,249,0.4)'; ?>;color:<?php echo ( 'plain' === $style ) ? 'var(--accent-fg,var(--surface-white))' : 'var(--text-inverse)'; ?>;font-size:11px;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;text-decoration:none;transition:all 0.25s ease;">
            <?php echo esc_html( $btn_label ); ?> &rarr;
          </a>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        $title     = $instance['title']     ?? '';
        $body      = $instance['body']      ?? '';
        $btn_label = $instance['btn_label'] ?? 'Enquire';
        $btn_url   = $instance['btn_url']   ?? '#';
        $style     = $instance['style']     ?? 'accent';
        ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Headline:', 'cvetanichin-widgets' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'body' ) ); ?>"><?php esc_html_e( 'Body text:', 'cvetanichin-widgets' ); ?></label>
          <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'body' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'body' ) ); ?>" rows="3"><?php echo esc_textarea( $body ); ?></textarea>
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'btn_label' ) ); ?>"><?php esc_html_e( 'Button label:', 'cvetanichin-widgets' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_label' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_label ); ?>">
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'cvetanichin-widgets' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" type="url" value="<?php echo esc_attr( $btn_url ); ?>">
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style:', 'cvetanichin-widgets' ); ?></label>
          <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
            <?php foreach ( [ 'accent' => 'Accent (brand colour)', 'inverse' => 'Inverse (dark)', 'plain' => 'Plain (white)' ] as $val => $label ) : ?>
            <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $style, $val ); ?>><?php echo esc_html( $label ); ?></option>
            <?php endforeach; ?>
          </select>
        </p>
        <?php
    }

    public function update( $new, $old ) {
        return [
            'title'     => sanitize_text_field( $new['title'] ?? '' ),
            'body'      => sanitize_textarea_field( $new['body'] ?? '' ),
            'btn_label' => sanitize_text_field( $new['btn_label'] ?? 'Enquire' ),
            'btn_url'   => esc_url_raw( $new['btn_url'] ?? '#' ),
            'style'     => in_array( $new['style'] ?? '', [ 'accent', 'inverse', 'plain' ], true ) ? $new['style'] : 'accent',
        ];
    }
}
