<?php
/**
 * Cvetanichin Recent Posts Widget — brand-styled post list.
 *
 * @package CvetanichinWidgets
 */

defined( 'ABSPATH' ) || exit;

class CVW_Recent_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'cvw_recent_posts', __( 'Cvetanichin — Recent Posts', 'cvetanichin-widgets' ), [
            'description' => __( 'Brand-styled list of recent posts with date and category.', 'cvetanichin-widgets' ),
            'classname'   => 'cvw-widget cvw-widget--recent-posts',
        ] );
    }

    public function widget( $args, $instance ) {
        $title  = $instance['title']  ?? '';
        $number = absint( $instance['number'] ?? 4 );
        $show_thumb = ! empty( $instance['show_thumb'] );

        $posts = get_posts( [ 'numberposts' => $number, 'post_status' => 'publish' ] );
        if ( ! $posts ) return;

        echo wp_kses_post( $args['before_widget'] );
        if ( $title ) echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
        ?>
        <div style="display:flex;flex-direction:column;gap:0;">
          <?php foreach ( $posts as $i => $post ) :
            $cats = get_the_category( $post->ID );
            $cat  = $cats ? $cats[0]->name : '';
          ?>
          <a href="<?php echo esc_url( get_permalink( $post ) ); ?>"
             style="display:flex;gap:0.75rem;align-items:flex-start;padding:1rem 0;<?php echo $i > 0 ? 'border-top:0.5px solid var(--border-subtle);' : ''; ?>text-decoration:none;">
            <?php if ( $show_thumb && has_post_thumbnail( $post ) ) : ?>
            <div style="flex-shrink:0;width:52px;height:52px;overflow:hidden;">
              <?php echo get_the_post_thumbnail( $post->ID, [ 52, 52 ], [ 'style' => 'width:52px;height:52px;object-fit:cover;display:block;' ] ); ?>
            </div>
            <?php endif; ?>
            <div style="display:flex;flex-direction:column;gap:0.2rem;min-width:0;">
              <p style="font-family:var(--font-display);font-size:15px;font-weight:300;line-height:1.35;color:var(--text-primary);overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;"><?php echo esc_html( get_the_title( $post ) ); ?></p>
              <p style="font-size:10px;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-muted);">
                <?php echo esc_html( get_the_date( '', $post ) ); ?>
                <?php if ( $cat ) echo ' &mdash; ' . esc_html( $cat ); ?>
              </p>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <?php
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        $title  = $instance['title']  ?? '';
        $number = $instance['number'] ?? 4;
        $show_thumb = ! empty( $instance['show_thumb'] );
        ?>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cvetanichin-widgets' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'cvetanichin-widgets' ); ?></label>
          <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo absint( $number ); ?>" min="1" max="10">
        </p>
        <p>
          <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumb' ) ); ?>" <?php checked( $show_thumb ); ?>>
          <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>"><?php esc_html_e( 'Show thumbnails', 'cvetanichin-widgets' ); ?></label>
        </p>
        <?php
    }

    public function update( $new, $old ) {
        return [
            'title'      => sanitize_text_field( $new['title'] ?? '' ),
            'number'     => absint( $new['number'] ?? 4 ),
            'show_thumb' => ! empty( $new['show_thumb'] ),
        ];
    }
}
