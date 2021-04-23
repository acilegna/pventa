
$( document ).ready( function ()
{
    fetch_customer_data();
    $( function ()
    {
        $( "#datepicker" ).datepicker( {
            dateFormat: 'yy/mm/dd'
        } );
        $( "#datepicker_2" ).datepicker( {
            dateFormat: 'yy/mm/dd'
        } );
    } );

    function fetch_customer_data ( date1 = '', date2 = '', sale_by = '' )
    {
        $.ajax( {
            url: './reporte',
            method: 'GET',
            data: {
                date1: date1,
                date2: date2,
                sale_by: sale_by
            },
            dataType: 'json',
            success: function ( data )
            {

                var registros = eval( data.table_data );
                var total = eval( data.total_data );
                res = "";
                //console.log( registros );
                console.log( total );
                if ( total >= 1 )
                {
                    for ( var i = 0; i < registros.length; i++ )
                    {
                        res += "<tr> <td>" + registros[ i ][ "id" ] + "</td> <td>" + registros[ i ][ "fecha" ] + "</td> <td>" +
                            registros[ i ][ "firstname" ] + "</td> <td>" + registros[ i ][ "p_venta" ] +
                            "</td> <td>" + registros[ i ][ "cantidad" ] + "</td> <td>" + registros[ i ][ "total" ] + "</td> <td>" + registros[ i ][ "descripcion" ] +
                            "</td>" + "</tr>";
                    }
                    $( '#tbody_re' ).html( res );
                    $( '#tre ' ).html( total );

                }

                /*
                $( '#tbody_re' ).html( data.table_data );
                $( '#plantilla' ).html( data.table_data );
                $( '#t_re ' ).text( data.total_data );*/
            }
        } )
    }

    $( document ).on( 'change', '#datepicker', function ()
    {
        //referencia al elemento que se le está aplicando el evento.
        //var date1 = $(this).val();
        var sale_by = $( "#sale_by" ).val();
        var date1 = $( "#datepicker" ).val();
        var date2 = $( "#datepicker_2" ).val();
        //pasar parametro a la funcion
        fetch_customer_data( date1, date2, sale_by );
    } );

    $( document ).on( 'change', '#datepicker_2', function ()
    {

        var sale_by = $( "#sale_by" ).val();
        var date1 = $( "#datepicker" ).val();
        var date2 = $( "#datepicker_2" ).val();
        //pasar parametro a la funcion
        fetch_customer_data( date1, date2, sale_by );
    } );

    $( document ).on( 'change', '#sale_by', function ()
    {
        //referencia al elemento que se le está aplicando el evento.          
        var sale_by = $( this ).val();
        var date1 = $( "#datepicker" ).val();
        var date2 = $( "#datepicker_2" ).val();
        //pasar parametro a la funcion
        fetch_customer_data( date1, date2, sale_by );

    } );

} );

