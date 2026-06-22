<?php
/**
 * Cvetanichin Product Card Widget — sidebar product promotion.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Product_Card_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_product_card', __( 'Cvetanichin — Product Card', 'cvetanichin-widgets' ), [
            'description' => __( 'A styled product card with name, price, and CTA — ideal for promoting a digital product from a sidebar.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--product-card',
        ] );
    }

    public function widget( $args, $instance ) {
        $name      = $instance['name']      ?? '';
        $tagline   = $instance['tagline']   ?? '';
        $price     = $instance['price']     ?? '';
        $note      = $instance['note']      ?? 'One payment. No subscription.';
        $btn_label = $instance['btn_label'] ?? 'Get instant access';
        $btn_url   = $instance['btn_url']   ?? '#';
        $badge     = $instance['badge']     ?? '';

        echo wp_kses_post( $args['before_widget'] );
        ?>
        <div style="background:var(--surface-white);border:0.5px solid var(--border-subtle);display:flex;flex-direction:column;gap:0;overflow:hidden;">

          <!-- Accent strip -->
          <div style="height:3px;background:var(--accent-primary);"></div>

          <div style="padding:1.5rem;display:flex;flex-direction:column;gap:1rem;">

            <?php if ( $badge ) : ?>
            <span style="display:inline-block;align-self:flex-start;padding:4px 10px;background:var(--accent-pale);color:var(--text-accent);font-size:10px;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;"><?php echo esc_html( $badge ); ?></span>
            <?php endif; ?>

            <?php if ( $name ) : ?>
            <p style="font-family:var(--font-display);font-size:19px;font-weight:300;line-height:1.25;color:var(--text-primary);"><?php echo esc_html( $name ); ?></p>
            <?php endif; ?>

            <?php if ( $tagline ) : ?>
            <p style="font-size:13px;line-height:1.7;color:var(--text-secondary);"><?php echo esc_html( $tagline ); ?></p>
            <?php endif; ?>

            <?php if ( $price ) : ?>
            <div style="padding-top:0.75rem;border-top:0.5px solid var(--border-subtle);">
              <p style="font-family:var(--font-display);font-size:36px;font-weight:300;line-height:1;color:var(--text-primary);"><?php echo esc_html( $price ); ?></p>
              <?php if ( $note ) : ?>
              <p style="font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-muted);margin-top:4px;"><?php echo esc_html( $note ); ?></p>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <a href="<?php echo esc_url( $btn_url ); ?>"
               style="display:block;width:100%;padding:13px 0;text-align:center;background:var(--accent-primary);color:var(--accent-fg,var(--surface-white));font-size:11px;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;text-decoration:none;transition:all 0.25s ease;"
               onmouseover="this.style.background='var(--accent-deep)'" onmouseout="this.style.background='var(--accent-primary)'">
              <?php echo esc_html( $btn_label ); ?> &rarr;
            </a>
          </div>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        foreach ( [
            'name'      => [ 'Product name', 'The First Offer Kit' ],
            'tagline'   => [ 'Tagline', 'Stop preparing. Start earning.' ],
            'price'     => [ 'Price (e.g. €37)', '€37' ],
            'note'      => [ 'Price note', 'One payment. No subscription.' ],
            'badge'     => [ 'Badge label (optional)', 'New' ],
            'btn_label' => [ 'Button label', 'Get instant access' ],
            'btn_url'   => [ 'Button URL', '#' ],
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
            'name'      => sanitize_text_field( $new['name']      ?? '' ),
            'tagline'   => sanitize_text_field( $new['tagline']   ?? '' ),
            'price'     => sanitize_text_field( $new['price']     ?? '' ),
            'note'      => sanitize_text_field( $new['note']      ?? '' ),
            'badge'     => sanitize_text_field( $new['badge']     ?? '' ),
            'btn_label' => sanitize_text_field( $new['btn_label'] ?? 'Get instant access' ),
            'btn_url'   => esc_url_raw( $new['btn_url']   ?? '#' ),
        ];
    }
}
