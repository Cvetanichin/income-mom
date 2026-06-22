/**
 * Cvetanichin — Customizer Live Preview JS
 * Binds postMessage handlers for settings with transport: 'postMessage'.
 */

( function( $ ) {
  'use strict';

  // Nav CTA label
  wp.customize( 'cvetanichin_nav_cta_label', function( value ) {
    value.bind( function( newVal ) {
      $( '.cv-nav__cta' ).text( newVal + ' →' );
    } );
  } );

  // Tagline
  wp.customize( 'cvetanichin_tagline', function( value ) {
    value.bind( function( newVal ) {
      $( '.cv-hero__tagline' ).text( newVal );
    } );
  } );

} )( jQuery );
