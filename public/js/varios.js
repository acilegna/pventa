
$( document ).ready( function ()
{
    $( '#varios' ).click( function ()
    {
        $( '#txtbusca' ).val( '' );
        $( '#cantidad' ).val( '' );
        $( '#mensaje' ).text( '' );
        $( '#mensaje' ).removeClass( "alert alert-danger" );

        $( '#price' ).text( "" );
        $( '#descripcion' ).text( "" );
        $( '#existencia' ).text( "" );
        $( '#variosProd' ).modal( 'show' );
        $( ".codigoProducto" ).val( '' );
    } );
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './agrega',
            type: "GET",
            data: {
                query: query
            },
            dataType: 'json',
            success: function ( data )
            {
                var registros = eval( data.table_datos );
                var total = eval( data.total_datos );
                if ( total >= 1 )
                {

                    for ( var i = 0; i < registros.length; i++ )
                    {
                        descripcion = registros[ i ][ "descripcion" ];
                        existencia = registros[ i ][ "existencia" ];
                        codigo = registros[ i ][ "codigo" ];

                    }

                    $( '#descripcion' ).html( descripcion );
                    $( '#existencia' ).html( existencia );



                } else
                {
                    $( '#mensaje' ).text( 'Registro no encontrado en la Base de Datos' );
                    $( "#mensaje" ).addClass( "alert alert-danger" );
                }
            }
        } );
    }
    $( document ).on( 'keyup', '#txtbusca', function ()
    {
        var query = $( this ).val();
        $( ".codigoProducto" ).val( query );

        fetch_customer_data( query );
        if ( $( "#txtbusca" ).val().length < 4 )
        {
            $( '#price' ).text( "" );
            $( '#descripcion' ).text( "" );
            $( '#existencia' ).text( "" );
            $( '#mensaje' ).text( '' );
            $( '#mensaje' ).removeClass( "alert alert-danger" );

        }
    } );

    $( "#cantidad" ).keyup( function ()
    {
        var cantidad = parseInt( $( "#cantidad" ).val() );
        var existencia = parseInt( $( "#existencia" ).text() );
        console.log( cantidad );
        console.log( existencia );

        if ( cantidad > existencia )
        {
            $( '#agregarVarios' ).attr( "disabled", true );
            $( "#mensaje" ).addClass( "alert alert-danger" );
            $( '#mensaje' ).text(
                "No se pueden agregar más productos de este tipo, se quedarían sin existencia"
            );
        } else
        {
            $( '#agregarVarios' ).attr( "disabled", false );
            $( '#mensaje' ).text( "" );
            $( '#mensaje' ).removeClass( "alert alert-danger" );

        }

    } );
} );