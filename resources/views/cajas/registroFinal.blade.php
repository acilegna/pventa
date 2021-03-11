<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel</title>


    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">



</head>



<!-- MODAL  ingresar dinero en caja -->
<div class="modal fade" id="dineroFinal" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <div class="btn-group fl-rigth"><a href="{{ url('/') }}" class="btn btn-alert"><i
                            class="fa fa-times"></i></a>
                </div>

            </div>
            <form action="{{ route('verificar') }}" method="post">


                @csrf
                <div class="modal-body">

                    <label for="name" class="col-sm-12 control-label text-left"><i class="fas fa-info-circle"
                            id="info"></i>
                        Cierre de turno </label>


                    <p>Cuenta el dinero que hay en caja e ingrésalo para proceder con el cierre de turno.</p>
                    <div class="modal-footer">
                        <div class="form-group row">
                            <label for="inputEfectivo" class="col-sm-9 col-form-label">¿Cuánto efectivo hay en
                                Caja?</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control-plaintext" id="efectivoFinal"
                                    name="efectivoFinal" placeholder="$0.00" value=$0.00>
                            </div>
                        </div>
                        <p id="mensaje"> </p>
                        <input type="number" placeholder="$0.00" class="form-control-plaintext" id="desbloq">

                        <button type="submit" class="btn btn-primary" id="closeCount">Cerrar turno</button>
                        <div class="btn-group fl-rigth"><a href="" id="cancel" class="btn btn-success">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!--   -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>


<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<link href="{{ asset('css/dataTables.css') }}" rel="stylesheet">

<!-- para datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- fin datepicker -->

<!-- para dataTables -->
<script src="{{ asset('js/dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables-bootstrap4.js') }}"></script>
<script src="{{ asset('js/bootstrapcdn.js') }}"></script>

@if ($alert != '')

    <script>
        $(document).ready(function() {
            $('#dineroFinal').modal("show");
            $('#modelHeading').html("Cierre de Turno");
            $('#mensaje').text(
                "Demasiados Intentos. El sistema te ha bloqueado, Agrega el codigo para desbloquear");
            $("#mensaje").addClass("alert alert-danger");

            $("#desbloq").show();
            //$("#closeCount").css("visibility", "0");
            $("#closeCount").hide();


        });
        $(document).on('keyup', '#desbloq', function() {
            var cantidad = $("#desbloq").val();
            var compara = 0920;
            if (cantidad == compara) {
                $("#closeCount").show();
            }
            if (cantidad != compara) {
                $("#closeCount").hide();
            }

        });

    </script>
@endif
@if ($alert == '')
    <script>
        $(document).ready(function() {
            $('#dineroFinal').modal("show");
            $('#modelHeading').html("Cierre de Turno");

            $("#desbloq").hide();
        });

    </script>
@endif

<!-- ingresar dinero de salida -->
