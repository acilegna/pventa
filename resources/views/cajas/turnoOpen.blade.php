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

<!-- MODAL  turno abierto -->
<div class="modal fade" id="turnoOpen" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <div class="btn-group fl-rigth"><a href="{{ url('/') }}" class="btn btn-alert"><i
                            class="fa fa-times"></i></a> </div>
            </div>
            <form action="{{ route('envia') }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>Al parecer se cerro el programa sin haber cerrado el turno anterior, por lo que es necesario
                        continuar dicho turno o inicar uno nuevo.</p>
                    <p>Elija la caja con usuario correspondiente para proceder a la funcion que desee hacer.</p>
                    <label for="inputAddress"> Lista de usuarios con turnos abiertos</label>
                    <select class="custom-select" id="Opcioncaja" name="Opcioncaja">
                        @foreach ($datoTurno[0] as $list)
                            <option value="{{ $list->id_usu }}">{{ $list->firstname }} en
                                {{ $list->descripcion }}
                            </option>
                        @endforeach
                    </select>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="registrar" name="continuar">Continuar con
                            turno</button>
                        <button type="submit" class="btn btn-success" id="cerrarTurno" name="cerrarTurno"
                            value="closeTurno">Cerrar y empezar nuevo turno
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FIN  MODAL   turno abierto  -->

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
<script>
    $(document).ready(function() {

        $('#turnoOpen').modal("show");
        $('#modelHeading').html("Turnos abiertos");

    });

</script>
