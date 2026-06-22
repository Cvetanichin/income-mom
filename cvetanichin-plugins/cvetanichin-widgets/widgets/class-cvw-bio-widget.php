<?php
/**
 * Cvetanichin Bio Widget
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Bio_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_bio', __( 'Cvetanichin — Bio Card', 'cvetanichin-widgets' ), [
            'description' => __( 'Creator bio with optional portrait placeholder and link.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--bio',
        ] );
    }

    public function widget( $args, $instance ) {
        $name    = $instance['name']    ?? 'Vaska Cvetanoska';
        $role    = $instance['role']    ?? 'CSO Consultant & Digital Product Creator';
        $bio     = $instance['bio']     ?? '';
        $link    = $instance['link']    ?? '#';
        $label   = $instance['label']   ?? 'Learn more';

        echo wp_kses_post( $args['before_widget'] );
        ?>
        <div style="display:flex;flex-direction:column;gap:1.25rem;">
          <!-- Portrait placeholder -->
          <div style="width:72px;height:72px;border-radius:50%;background:var(--surface-muted);border:0.5px solid var(--border-emphasis);overflow:hidden;display:flex;align-items:center;justify-content:center;">
            <?php echo get_avatar( get_the_author_meta( 'email' ), 72, '', $name, [ 'style' => 'border-radius:50%;width:72px;height:72px;object-fit:cover;' ] ); ?>
          </div>
          <div style="display:flex;flex-direction:column;gap:0.35rem;">
            <p style="font-family:var(--font-display);font-size:18px;font-weight:300;color:var(--text-primary);"><?php echo esc_html( $name ); ?></p>
            <p style="font-size:10px;font-weight:500;letter-spacing:0.22em;text-transform:uppercase;color:var(--text-muted);"><?php echo esc_html( $role ); ?></p>
          </div>
          <?php if ( $bio ) : ?>
          <p style="font-size:13px;line-height:1.75;color:var(--text-secondary);"><?php echo esc_html( $bio ); ?></p>
          <?php endif; ?>
          <a href="<?php echo esc_url( $link ); ?>" style="font-size:11px;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-accent);text-decoration:none;"><?php echo esc_html( $label ); ?> &rarr;</a>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        foreach ( [ 'name' => 'Name', 'role' => 'Role / Title', 'bio' => 'Short bio', 'link' => 'Link URL', 'label' => 'Link label' ] as $key => $lbl ) :
        $val = $instance[ $key ] ?? '';
        ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $lbl ); ?>:</label>
          <?php if ( $key === 'bio' ) : ?>
          <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" rows="3"><?php echo esc_textarea( $val ); ?></textarea>
          <?php else : ?>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $val ); ?>">
          <?php endif; ?>
        </p>
        <?php endforeach;
    }

    public function update( $new, $old ) {
        return [
            'name'  => sanitize_text_field( $new['name']  ?? '' ),
            'role'  => sanitize_text_field( $new['role']  ?? '' ),
            'bio'   => sanitize_textarea_field( $new['bio'] ?? '' ),
            'link'  => esc_url_raw( $new['link']  ?? '#' ),
            'label' => sanitize_text_field( $new['label'] ?? 'Learn more' ),
        ];
    }
}
