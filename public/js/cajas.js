$( document ).ready( function ()
{
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './cajasAjax',
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',

            success: function ( data )
            {


                var registros = eval( data.table_data );

                html = "";
                for ( var i = 0; i < registros.length; i++ )
                {

                    html += "<tr> <td>" + registros[ i ][ "descripcion" ] + "</td> <td>" + registros[ i ][ "status" ] +
                        "</td> <td><a data-toggle='tooltip' data-placement='right' title='Editar' href='./editCj/" + registros[ i ][ "id" ] + "'>" +
                        "<span class='glyphicon glyphicon-pencil borde-edit' aria-hidden='true'></span></a>" +
                        "<a data-toggle='tooltip' data-placement='right' title='Editar' href='./deleteCj/" + registros[ i ][ "id" ] + "'>" +
                        "<span class='glyphicon glyphicon-trash borde-delete' aria-hidden='true'></span></a>" +
                        "</td></tr>";

                };

                $( '#cajabody' ).html( html );
                $( '#total_cajas' ).text( data.total_data );

            }
        } )
    }
    $( document ).on( 'keyup', '#search', function ()
    {
        var query = $( this ).val();
        fetch_customer_data( query );
    } );
} );

