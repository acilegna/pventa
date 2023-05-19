$( document ).ready( function ()
{
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './allUser',
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
                        resultado += "<tr> <td>" + registros[ i ][ "firstname" ] + "</td> <td>" + registros[ i ][ "lastname" ] + "</td> <td>" +
                            registros[ i ][ "email" ] + "</td> <td>" + registros[ i ][ "active" ] + "</td> <td><input type='hidden' name = 'id' value = " + registros[ i ][ "id_employee" ] + "> "  +
                            "<a data-toggle='tooltip' data-placement='right' title='Editar' href='./viewEditUser/" + registros[ i ][ "id_employee" ] + "'>" +
                            "<span class='glyphicon glyphicon-pencil borde-edit' aria-hidden='true'></span></a>" +
                            "<a data-toggle='tooltip' data-placement='right' title='Eliminar' href='./deleteUser/" + registros[ i ][ "id_employee" ] + "'>" +
                            "<span class='glyphicon glyphicon-trash borde-delete' aria-hidden='true'></span></a>" +
                            "</td></tr>";
                    }

                    $( '#tbodyusers' ).html( resultado );
                    $( '#total_records' ).html( total );

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