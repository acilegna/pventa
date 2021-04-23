
$( document ).ready( function ()
{
    $( '#cobrar' ).click( function ()
    {
        $( '#modalCobro' ).modal( 'show' );

    } );
    fetch_customer_data();

    function fetch_customer_data ()
    {
        $.ajax( {
            url: './cobrar',
            type: "GET",
            data: {},
            dataType: 'json',
            success: function ( data )
            {
                //console.log( data );
                $( '#total_pagar' ).text( data.total_pagar );
                $( '#pago' ).val( data.total_pagar );
                $( '#articulos' ).text( data.total_articulos );
            }
        } )
        $( "#pago" ).keyup( function ()
        {
            var pagoCon = document.getElementById( "pago" ).value;
            var total = $( "#total_pagar" ).text();
            Resultado = ( parseFloat( pagoCon ) - parseFloat( total ) );
            $( '#cambio' ).val( Resultado );

        } );
    }
} );
