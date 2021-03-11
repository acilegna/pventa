$( document ).ready( function ()
{
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './action',
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
                        resultado += "<tr> <td>" + registros[ i ][ "codigo" ] + "</td> <td>" + registros[ i ][ "descripcion" ] + "</td> <td>" +
                            registros[ i ][ "categoria" ] + "</td> <td>" + registros[ i ][ "p_compra" ] + "</td> <td>" + registros[ i ][ "existencia" ] +
                            "</td> <td><input type = 'hidden' name = 'codigoProducto' value = " + registros[ i ][ "codigo" ] + "> " +
                            "<a data - toggle='tooltip' data-placement='right' title = 'Agregar Inventario' href='./viewInv/" + registros[ i ][ "id" ] + "'> " +
                            "<span class='glyphicon glyphicon-list-alt borde-inv'aria-hidden='true'></span></a>" +
                            "<a data-toggle='tooltip' data-placement='right' title='Editar' href='./editProd/" + registros[ i ][ "id" ] + "'>" +
                            "<span class='glyphicon glyphicon-pencil borde-edit' aria-hidden='true'></span></a>" +
                            "<a data-toggle='tooltip' data-placement='right' title='Eliminar' href='./deletePr/" + registros[ i ][ "id" ] + "'>" +
                            "<span class='glyphicon glyphicon-trash borde-delete' aria-hidden='true'></span></a>" +
                            "</td></tr>";
                    }

                    $( '#tbody' ).html( resultado );

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