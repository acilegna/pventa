
$( document ).ready( function ()
{
    $( '#verificadorb' ).click( function ()
    {
        $( '#txtverificador' ).val( '' );
        $( '#tbodyVs' ).text( "$0.00" );
        $( '#verificador' ).modal( 'show' );
        $( ".codigoProducto" ).val( '' );

    } );

    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './verifica',
            type: "GET",
            data: {
                query: query
            },
            dataType: 'json',
            success: function ( data )
            {
                var registros = eval( data.table_datos );
                var total = eval( data.total_datos );
                //console.log( registros );
                //console.log( total );
                if ( total >= 1 )
                {

                    for ( var i = 0; i < registros.length; i++ )
                    {
                        descripcion = registros[ i ][ "descripcion" ];
                        precio = registros[ i ][ "p_venta" ];
                        codigo = registros[ i ][ "codigo" ];
                    }

                    $( '#tbodyVs' ).html( precio );
                    $( '#existencia' ).html( existencia );
                    //$( '#codigoProducto' ).set( codigo );

                } else
                {
                    $( '#mensaje' ).text( 'Registro no encontrado en la Base de Datos' );
                    $( "#mensaje" ).addClass( "alert alert-danger" );
                }
            }
        } )
    }

    $( document ).on( 'keyup', '#txtverificador', function ()
    {
        var query = $( this ).val();
        $( ".codigoProducto" ).val( query );
        fetch_customer_data( query );
        if ( $( "#txtverificador" ).val().length < 4 )
        {
            $( '#tbodyVs' ).text( "$0.00" );
            $( '#mensaje' ).removeClass( "alert alert-danger" );
            $( '#mensaje' ).text( '' );

        }
    } );
} );
