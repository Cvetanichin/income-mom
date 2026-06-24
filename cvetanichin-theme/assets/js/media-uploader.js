/**
 * Cvetanichin Media Uploader — Admin metabox image picker
 * Handles WordPress media library integration for image fields
 */

( function( $ ) {
  'use strict';

  var mediaFrame;

  $( document ).on( 'click', '.cvetanichin-media-btn', function( e ) {
    e.preventDefault();

    const field = $( this ).data( 'field' );
    const $input = $( '#' + field );

    if ( mediaFrame ) {
      mediaFrame.close();
    }

    mediaFrame = wp.media( {
      title: 'Select Image',
      button: {
        text: 'Use Image'
      },
      multiple: false
    } );

    mediaFrame.on( 'select', function() {
      const attachment = mediaFrame.state().get( 'selection' ).first().toJSON();
      $input.val( attachment.url );

      // Show preview if image
      const $preview = $input.siblings( 'img' );
      if ( $preview.length ) {
        $preview.attr( 'src', attachment.url ).show();
      } else {
        $( '<img src="' + attachment.url + '" alt="" style="max-width:200px;margin-top:10px;display:block;" />' ).insertAfter( $input );
      }
    } );

    mediaFrame.open();
  } );

} )( jQuery );
