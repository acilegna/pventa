@extends('layouts.app')

@section('title', 'Page Title')

<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



@section('content')
<section class="col-lg-11 connectedSortable">


  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Añadir Clientes</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="container">
        <h2>CRUD operations in Laravel 5.3</h2>
        <button type="button" class="btn btn-info btn-sm pull-left" style="    margin-bottom: 10px;
" data-toggle="modal" data-target="#addModal">Añadir</button>
        <br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block col-lg-10 ">
          <button type="button" class="close" data-dismiss="alert">X </button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
        <!--
-->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Direccion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $x)
            <tr>
              <td>{{$x -> nombre}}</td>
              <td>{{$x -> apellidos}}</td>
              <td>{{$x -> direccion}}</td>
              <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#viewModal"
                  onclick="fun_view('{{$x -> id}}')">View</button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal"
                  onclick="fun_edit('{{$x -> id}}')">Edit</button>
                <button class="btn btn-danger" onclick="fun_delete('{{$x -> id}}')">Delete</button>


              </td>
              <td>

                <button class="delete-modal btn btn-danger" data-id="{{$x->id}}" data-title="{{$x->nombre}}"
                  data-content="{{$x->apellido}}">
                  <span class="glyphicon glyphicon-trash"></span> Delete</button>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
        <!-- Add Modal start -->
        <div class="modal fade" id="addModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir Cliente</h4>
              </div>
              <div class="modal-body">
                <form action="{{ url('Cliente') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div class="form-group">
                      <label for="name">Nombre:</label>
                      <input type="text" class="form-control" id="Nombre" name="Nombre">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Apellido:</label>
                      <input type="text" class="form-control" id="Apellido" name="Apellido">
                    </div>
                    <label for="short">Direccion:</label>
                    <input type="text" class="form-control" id="Direccion" name="Direccion">
                  </div>

                  <button type="submit" class="btn btn-default">Guarda</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- add code ends -->
        <!-- View Modal start -->
        <div class="modal fade" id="viewModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
              </div>
              <div class="modal-body">
                <p><b>ID : </b><span id="view_id" class="text-success"></span></p>
                <p><b>Nombre : </b><span id="view_nombre" class="text-success"></span></p>
                <p><b>Apellido : </b><span id="view_apellido" class="text-success"></span></p>
                <p><b>Direccion : </b><span id="view_direccion" class="text-success"></span></p>
                <!--
            <p><b>last name : </b><span id="view_last_name" class="text-success"></span></p>

            <p><b>Email : </b><span id="view_short" class="text-success">bhaskar.panja@quadone.com</span></p>
-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Edit Modal start -->
        <div class="modal fade" id="editModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar</h4>
              </div>
              <div class="modal-body">
                <form action="{{ url('Cliente/update') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div class="form-group">
                      <label for="edit_nombre">Nombre:</label>
                      <input type="text" class="form-control" id="edit_nombre" name="edit_nombre">
                    </div>
                    <div class="form-group">
                      <label for="edit_apellido">Apellido:</label>
                      <input type="text" class="form-control" id="edit_apellido" name="edit_apellido">
                    </div>
                    <label for="edit_Direccion">Direccion:</label>
                    <input type="short" class="form-control" id="edit_Direccion" name="edit_Direccion">
                  </div>

                  <input type="hidden" id="edit_id" name="edit_id">




                  <button type="submit" class="btn btn-default">Modificar</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </div>

          </div>
        </div>
        <!-- Edit code ends -->
        <!--eliminar un registro-->
        <div id="deleteModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <h3 class="text-center">Are you sure you want to delete the following post?</h3>
                <br />
                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="id">ID:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="id_delete" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="title">Title:</label>
                    <div class="col-sm-10">
                      <input type="name" class="form-control" id="title_delete" disabled>
                    </div>
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                    <span id="" class='glyphicon glyphicon-trash'></span> Delete
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class='glyphicon glyphicon-remove'></span> Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>




        <!--eliminar un registro-->




      </div>
    </div>



  </div>



</section>
<script type="text/javascript">
  function fun_view(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#view_id").text(result.id);
          $("#view_nombre").text(result.nombre);
          $("#view_apellido").text(result.apellido);
          $("#view_direccion").text(result.Direccion);
          


          

        }
      });
    }
 
    function fun_edit(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#edit_id").val(result.id);
          $("#edit_nombre").val(result.nombre);
          $("#edit_apellido").val(result.apellido);
          $("#edit_Direccion").val(result.Direccion);
          



        }
      });
    }
 
    function fun_delete(id)
    {
      var conf = confirm("Are you sure want to delete??");
      if(conf){
        var delete_url = $("#hidden_delete").val();
        $.ajax({
          url: delete_url,
          type:"POST", 
          data: {"id":id,_token: "{{ csrf_token() }}"}, 
          success: function(response){
            alert(response);
            location.reload(); 
          }
        });
      }
      else{
        return false;
      }
    }

 // delete a post
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#title_delete').val($(this).data('title'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'posts/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });




</script>




<!-- toastr notifications -->
{{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


{{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>

<!-- toastr notifications -->
{{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">





@endsection