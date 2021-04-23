
$( document ).ready( function ()
{
    $( '.salidaEfectivo' ).click( function ()
    {

        $( '#modalSalidas' ).modal( "show" );
        $( '#headingSalida' ).html( "Registro salida de efectivo" );
    } );
} );