
$( document ).ready( function ()
{
    $( '.entradaEfectivo' ).click( function ()
    {

        $( '#modalEntradas' ).modal( "show" );
        $( '#headingEntradas' ).html( "Registro entrada de efectivo" );
    } );
} );