
$( document ).ready( function ()
{
    //get base URL *********************
    var url = $( '#url' ).val();
    //mostrar un nuevo producto *********************

    $( '#btn_add' ).click( function ()
    {
        $( '#btn-save' ).val( "add" );
        $( '#frmProducts' ).trigger( "reset" );
        $( '#myModal' ).modal( 'show' );
    } );
    //display modal form for product EDIT ***************************

    $( document ).on( 'click', '.open_modal', function ()
    {
        var cli_id = $( this ).val();
        // alert(product_id);
        /* url:"./action",   url:"{{ route('action') }}",*/

        // Populate Data in Edit Modal Form
        $.ajax( {
            type: "GET",
            url: url + '/' + cli_id,
            success: function ( data )
            {
                console.log( data );
                $( '#cli_id' ).val( data.id );
                $( '#nombre' ).val( data.nombre );
                $( '#apellidos' ).val( data.apellidos );
                $( '#telefono' ).val( data.telefono );
                $( '#direccion' ).val( data.direccion );
                $( '#btn-save' ).val( "update" );
                $( '#frmProducts' ).trigger( "reset" );
                $( '#myModal' ).modal( 'show' );
            },
            error: function ( data )
            {
                console.log( 'Error:', data );
            }
        } );
    } );

    //create new product / update existing product ***************************
    $( "#btn-save" ).click( function ( e )
    {
        $.ajaxSetup( {
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            }
        } )

        e.preventDefault();
        var formData = {
            nombre: $( '#nombre' ).val(),
            apellidos: $( '#apellidos' ).val(),
            telefono: $( '#telefono' ).val(),
            direccion: $( '#direccion' ).val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $( '#btn-save' ).val();
        var type = "POST"; //for creating new resource
        var cli_id = $( '#cli_id' ).val();
        var my_url = url;
        if ( state == "update" )
        {

            type = "PUT"; //for updating existing resource
            my_url += '/' + cli_id;
        }
        //  console.log(formData);
        $.ajax( {
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function ( data )
            {
                //console.log(data);                 

                var nombre = '<td>' + data.nombre + '</td>';
                var apellido = '<td>' + data.apellidos + '</td>';
                var telefono = '<td>' + data.telefono + '</td>';
                var direccion = '<td>' + data.direccion + '</td>';


                var RES = '<tr id="cli' + data.cli_id + '"><td>' + data.nombre + '</td><td>' + data.apellidos + '</td><td>' + data.telefono + '</td><td>' + data.direccion + '</td>';

                RES += '<td><button data-toggle="tooltip" data-placement="right" title="Editar" class="btn-op btn-detail open_modal" value="' + data.id + '" ><i class="glyphicon glyphicon-pencil borde-edit"></i></button>';
                RES += '<button data-toggle="tooltip" data-placement="right" title="Eliminar" class="btn-op open_modal" value="' + data.id + '" ><i class="glyphicon glyphicon-trash borde-delete"></i></button></td></tr>';
                if ( state == "add" )
                { //if user added a new record
                    $( '#bodyC' ).append( RES );
                    // $('#frmProducts').trigger("reset");

                    /*
                    $('#bodyC').append(nombre);
                    $('#bodyC').append(apellido);
                    $('#bodyC').append(telefono);
                    $('#bodyC').append(direccion);            
                       */
                }
                //$total_row = $data->count();
                //alert(data);

                else
                { //if user updated an existing record                    
                    $( "#name" + cli_id ).replaceWith( nombre );
                    $( "#lastname" + cli_id ).replaceWith( apellido );
                    $( "#telephone" + cli_id ).replaceWith( telefono );
                    $( "#address" + cli_id ).replaceWith( direccion );
                    //table.draw();
                }
                // $('#frmProducts').trigger("reset");
                // $('#frmProducts').DataTable().draw();

                $( '#frmProducts' ).trigger( "reset" );



                $( '#myModal' ).modal( 'hide' );


            },
            error: function ( data )
            {
                console.log( 'Error:', data );
            }
        } );
    } );

} );