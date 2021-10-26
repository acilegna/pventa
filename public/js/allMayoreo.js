$( document ).ready( function ()
{
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './allM',
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function ( data )
            {

                var registros = eval( data.table_data );
                var total = eval( data.total_data );
                resultado = "";
                if ( total >= 1 )
                {

                    for ( var i = 0; i < registros.length; i++ )
                    {
                        resultado += "<tr> <td>" + registros[ i ][ "descripcion" ] + "</td> <td>" + registros[ i ][ "p_venta" ] + "</td> <td>" +
                            registros[ i ][ "p_mayoreo" ] + "</td> <td>" + registros[ i ][ "cantidad" ] + "</td> <td><input type='hidden' name = 'idmayoreo' value = " + registros[ i ][ "id_prod" ] + "> "  +
                            "<a data-toggle='tooltip' data-placement='right' title='Editar' href='./viewEdit/" + registros[ i ][ "id_prod" ] + "'>" +
                            "<span class='glyphicon glyphicon-pencil borde-edit' aria-hidden='true'></span></a>" +
                            "<a data-toggle='tooltip' data-placement='right' title='Eliminar' href='./deleteM/" + registros[ i ][ "id" ] + "'>" +
                            "<span class='glyphicon glyphicon-trash borde-delete' aria-hidden='true'></span></a>" +
                            "</td></tr>";
                    }

                    $( '#tbodymayoreos' ).html( resultado );

                } else
                {
                    $( '#mensaje' ).text( 'Registro no encontrado en la Base de Datos' );
                    $( "#mensaje" ).addClass( "alert alert-danger" );
                }

            }
        } )
    }
    $( document ).on( 'keyup', '#search', function ()
    {
        var query = $( this ).val();
        fetch_customer_data( query );
    } );
} );