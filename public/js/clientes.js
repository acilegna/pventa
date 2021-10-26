
$( function ()
{
    $.ajaxSetup( {
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
    } );

    var table = $( '.data-table' ).DataTable( {
        "oLanguage": {
            "sLengthMenu": "_MENU_ Entradas por paginas",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 to 0 of 0 registros",
            "sInfoFiltered": "(Filtrado de _MAX_ registros totales)",
            "sSearch": "Buscar:",
            "sZeroRecords": "0 Registros encontrados",
            "sProcessing": "Procesando...",
        },
        processing: true,
        serverSide: true,
        "aLengthMenu": [ 5, 10, 15 ],
        ajax: './viewClientes',
        columns: [ {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'nombre',
            name: 'nombre'
        },
        {
            data: 'apellidos',
            name: 'apellidos'
        },
        {
            data: 'telefono',
            name: 'telefono'
        },
        {
            data: 'direccion',
            name: 'direccion'
        },

        { data: 'btn' },

        ]
    } );
    // $( '#boton' ).html( html ),

    $( '#createNewProduct' ).click( function ()
    {
        $( '#saveBtnn' ).val( "create-product" );
        $( '#product_id' ).val( '' );
        $( '#productForm' ).trigger( "reset" );
        $( '#modelHeading' ).html( "Crear nuevo cliente" );
        $( '#ajaxModel' ).modal( 'show' );
        $( '#res_message' ).hide();
        $( '#msg_div' ).hide();
    } );

    $( 'body' ).on( 'click', '.editCliente', function ()
    {
        var product_id = $( this ).data( 'id' );

        $.get( 'client' + '/' + product_id + '/edit', function ( data )
        {
            $( '#modelHeading' ).html( "Editar " );
            $( '#saveBtnn' ).val( "edit-user" );
            $( '#ajaxModel' ).modal( 'show' );
            $( '#product_id' ).val( data.id );
            $( '#nombre' ).val( data.nombre );
            $( '#apellidos' ).val( data.apellidos );
            $( '#direccion' ).val( data.direccion );
            $( '#telefono' ).val( data.telefono );
        } )
    } );

    $( '#saveBtnn' ).click( function ( e )
    {
        e.preventDefault();
        // $( this ).html( 'Sending..' );
        $.ajax( {
            data: $( '#productForm' ).serialize(),
            url: 'client',
            type: "POST",
            dataType: 'json',
            success: function ( data )
            {
                
                $( '#productForm' ).trigger( "reset" );
                $( '#ajaxModel' ).modal( 'hide' );
                $( '#res_message' ).html( data.msg );
                $( '#msg_div' ).removeClass( 'd-none' );              

                table.draw();
            }, 
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $( '#ajaxModel' ).modal( 'hide' );
                    table.draw();
                   
                 
                }
            }, 

            error: function ( data )
            {
                console.log( 'Error:', data );
                //
                // $( '#saveBtnn' ).html( 'Save Changes' );
            }
        } );
    } );

    $( 'body' ).on( 'click', '.deleteCliente', function ()
    {

        var product_id = $( this ).data( "id" );
        if ( confirm( '¿Estas seguro que deseas eliminar el registro?' ) )
        {
            $.ajax( {
                type: "DELETE",
                url: 'client' + '/' + product_id,
                success: function ( data )
                {
                    console.log( data );
                    $( '#res_message' ).html( data.msg );
                    $( '#res_message' ).html( "Canceladowww" );
                    $( '#msg_div' ).removeClass( 'd-none' );
                    table.draw();

                },
                error: function ( data )
                {
                    console.log( 'Error:', data );
                }
            } );

        } else
        {
            $( '#res_message' ).html( "Cancelado" );
            $( '#msg_div' ).removeClass( 'd-none' );
        }
    } );
} );

