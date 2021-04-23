
$( document ).ready( function ()
{
    fetch_customer_data();

    function fetch_customer_data ( query = '' )
    {
        $.ajax( {
            url: './llenar',
            type: "GET",
            data: {
                query: query
            },
            dataType: 'json',
            success: function ( data )
            {
                $( '#precioP' ).val( data.table_datos );
                $( '#total' ).text( data.total_datos );
            }
        } )
    }

    $( document ).on( 'change', '#descripcion', function ()
    {
        var query = $( this ).val();
        fetch_customer_data( query );
    } );
} );
