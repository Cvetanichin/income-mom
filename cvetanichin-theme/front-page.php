<?php
/**
 * Cvetanichin — Front Page Template
 * Main landing page: Hero + CSO Domain + Self-Improvement Domain + Products + Console + Footer CTA
 *
 * @package Cvetanichin
 */

get_header();
?>

<?php get_template_part( 'template-parts/hero' ); ?>

<?php get_template_part( 'template-parts/domain-cso' ); ?>

<?php get_template_part( 'template-parts/domain-workspace' ); ?>

<?php get_template_part( 'template-parts/products-grid' ); ?>

<?php get_template_part( 'template-parts/console-signin' ); ?>

<?php get_template_part( 'template-parts/footer-cta' ); ?>

<?php get_footer(); ?>
