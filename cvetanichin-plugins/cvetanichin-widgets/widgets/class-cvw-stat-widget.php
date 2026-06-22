<?php
/**
 * Cvetanichin Stat Widget — displays up to 3 key numbers.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Stat_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_stat', __( 'Cvetanichin — Stat Row', 'cvetanichin-widgets' ), [
            'description' => __( 'Up to 3 editorial stat figures with labels.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--stat',
        ] );
    }

    public function widget( $args, $instance ) {
        $dark = ! empty( $instance['dark'] );
        $bg   = $dark ? 'var(--surface-inverse)' : 'var(--surface-white)';

        echo wp_kses_post( $args['before_widget'] );
        echo '<div style="background:' . esc_attr( $bg ) . ';padding:1.5rem;display:flex;flex-direction:column;gap:1.25rem;">';

        for ( $i = 1; $i <= 3; $i++ ) {
            $val   = $instance[ "stat{$i}_val" ]   ?? '';
            $label = $instance[ "stat{$i}_label" ] ?? '';
            $desc  = $instance[ "stat{$i}_desc" ]  ?? '';
            if ( ! $val ) continue;

            $vc = $dark ? 'var(--accent-light)' : 'var(--text-primary)';
            $lc = $dark ? 'rgba(253,248,249,0.4)' : 'var(--text-muted)';
            $dc = $dark ? 'rgba(253,248,249,0.55)' : 'var(--text-secondary)';

            if ( $i > 1 ) {
                echo '<div style="border-top:0.5px solid ' . ( $dark ? 'var(--border-inverse)' : 'var(--border-subtle)' ) . ';"></div>';
            }
            echo '<div style="display:flex;flex-direction:column;gap:0.25rem;">';
            echo '<p style="font-family:var(--font-display);font-size:40px;font-weight:300;line-height:1;color:' . esc_attr( $vc ) . ';">' . esc_html( $val ) . '</p>';
            if ( $label ) echo '<p style="font-size:10px;font-weight:500;letter-spacing:0.25em;text-transform:uppercase;color:' . esc_attr( $lc ) . ';">' . esc_html( $label ) . '</p>';
            if ( $desc )  echo '<p style="font-size:13px;line-height:1.65;color:' . esc_attr( $dc ) . ';margin-top:0.35rem;">' . esc_html( $desc ) . '</p>';
            echo '</div>';
        }

        echo '</div>';
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        ?>
        <p>
          <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dark' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dark' ) ); ?>" <?php checked( ! empty( $instance['dark'] ) ); ?>>
          <label for="<?php echo esc_attr( $this->get_field_id( 'dark' ) ); ?>"><?php esc_html_e( 'Dark background', 'cvetanichin-widgets' ); ?></label>
        </p>
        <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
        <hr>
        <p><strong><?php printf( esc_html__( 'Stat %d', 'cvetanichin-widgets' ), $i ); ?></strong></p>
        <?php foreach ( [ "stat{$i}_val" => 'Value (e.g. €37)', "stat{$i}_label" => 'Label (e.g. one payment)', "stat{$i}_desc" => 'Description' ] as $key => $lbl ) :
            $val = $instance[ $key ] ?? ''; ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $lbl ); ?>:</label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $val ); ?>">
        </p>
        <?php endforeach; endfor; ?>
        <?php
    }

    public function update( $new, $old ) {
        $out = [ 'dark' => ! empty( $new['dark'] ) ];
        for ( $i = 1; $i <= 3; $i++ ) {
            foreach ( [ "stat{$i}_val", "stat{$i}_label", "stat{$i}_desc" ] as $k ) {
                $out[ $k ] = sanitize_text_field( $new[ $k ] ?? '' );
            }
        }
        return $out;
    }
}
