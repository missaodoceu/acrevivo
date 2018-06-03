jQuery( document ).ready( function( $ ) {
  $( 'input[type=date]' ).each( function() {
    $( this ).clone().attr( 'type', 'text' ).insertAfter( this ).datepicker().prev().remove();
  } );
} );