<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro Inicial</title>

    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<!-- MODAL registro inicial -->

<div class="modal fade" id="registroInicial" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <div class="btn-group fl-rigth"><a href="{{ url('/') }}" class="btn btn-alert"><i
                            class="fa fa-times"></i></a></div>
            </div>
            <form action="{{ route('caja') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="inputAddress"> Seleccione la caja que corresponda</label>
                    <select class="custom-select" id="caja" name="caja">
                        @if (count($cajaClose) == 0)
                            <option value="">No hay cajas Disponibles</option>
                        @endif
                        @foreach ($cajaClose as $list)
                            <option value="{{ $list->id }}">{{ $list->descripcion }}</option>
                        @endforeach
                    </select>
                    <label for="inputAddress">Efectivo Inicial en Caja</label>
                    <input type="number" class="form-control" id="inicial" name="inicial" placeholder="$0.00" required>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="registrar" name="registrar"
                            value="regCaja">Registrar Dinero Inicial en Caja</button>
                        <div class="btn-group fl-rigth"><a href="{{ url('/') }}"
                                class="btn btn-success">Cancelar</a> </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FIN registro inicial -->

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
        $('#registroInicial').modal("show");
        $('#modelHeading').html("Punto de Venta");


    });

</script>
