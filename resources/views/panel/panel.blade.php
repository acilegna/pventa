<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel</title>
    @include('includes.libreriasCss')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="" class="brand-link">
                    <img src="{{ asset('images/pv.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Punto de venta</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('images/faces.png') }}" aclass="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">

                            @if (Route::has('login'))
                                @auth
                                    <a href="#" class="d-block">{{ Auth()->user()->firstname }}</a>
                                @endauth
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                            <li class="nav-item menu-open">
                                <a href="{{ route('welcome') }}" class="nav-link active">
                                    <i class="nav-icon fa fa-home"></i>
                                    <p>
                                        Home

                                    </p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewUser') }}" class="nav-link">
                                    <i class="nav-icon fa fa-home"></i>
                                    <p>
                                        Usuarios

                                    </p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewFiltro') }}" class="nav-link">
                                    <i class="nav-icon fa fa-cubes"></i>
                                    <p>
                                        Productos
                                    </p>
                                </a>
                            </li>
                           

                            <li class="nav-item">
                            <a href="{{ route('mayoreo') }}" class="nav-link">
                                    <i class="nav-icon fa fa-tags"></i>
                                    <p>
                                    Mayoreos
                                        
                                    </p>
                                </a>
                                
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('viewVents') }}" class="nav-link">
                                    <i class="nav-icon fa fa-cart-plus"></i>
                                    <p>
                                        Ventas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('client.index') }}" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Clientes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Reportes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('viewReportes') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reporte de Ventas</p>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="pages/charts/inline.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reporte de Inventario</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allcaja') }}" class="nav-link">
                                    <i class="nav-icon fa fa-boxes"></i>
                                    <p>
                                        Cajas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link entradaEfectivo">
                                    <i class="nav-icon fa fa-hand-holding-usd"></i>
                                    <p>Entradas</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link salidaEfectivo">
                                    <i class="nav-icon fa fa-folder-minus"></i>
                                    <p>Salidas</p>
                                </a>
                            </li>
                            <!-- salir -->
                            <li class="nav-item">
                                <a class="nav-link exit">
                                    <i class="nav-icon fa fa-sign-out-alt" id="exit"></i>
                                    <p>
                                        Salir
                                    </p>
                                </a>

                            </li>
                            <!-- salir -->

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            @yield('javascript')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <main class="py-4"> @yield('content') </main>
                <!-- MODAL   -->
                <div class="modal fade" id="modalEntradas" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="headingEntradas"></h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action='{{ route('save') }}' method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-8">

                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Cantidad</span>
                                                            <span class="input-group-text">$</span>
                                                            <input name="cantidadEntrada" id="cantidadEntrada"
                                                                class="form-control" type="text" required=""
                                                                pattern="[0-9]+">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Comentarios</span>

                                                            <input id="comentario" name="comentario" type="text"
                                                                class="form-control" required="" pattern="[0-9]+">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-outline-success" type="submit" name="saveEntrada"
                                                    id="saveEntrada" value="entrada">Guardar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="Btncancela">Cancelar </button>


                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN  MODAL  ENTRADAS-->

                <!-- MODAL SALIDAS   -->
                <div class="modal fade" id="modalSalidas" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="headingSalida"></h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action='{{ route('save') }}' method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-8">

                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Cantidad</span>
                                                            <span class="input-group-text">$</span>
                                                            <input name="cantidadEntrada" id="cantidadEntrada"
                                                                class="form-control" type="text" required=""
                                                                pattern="[0-9]+">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Comentarios</span>

                                                            <input id="comentario" name="comentario" type="text"
                                                                class="form-control" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-outline-success" type="submit" name="saveSalida"
                                                    id="saveSalida" value="salida">Guardar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="Btncancela">Cancelar </button>


                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN  MODAL   CAJA -->

                <!-- MODAL  EXIT -->
                <div class="modal fade" id="cajaModel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelHeading"></h5>
                            </div>
                            <div class="modal-body">

                                <form action="{{ url('caja') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <label for="name" class="col-sm-12 control-label text-center">COMENTARIO</label>

                                    <div class="modal-footer col-sm-6">
                                        <button type="submit" class="btn btn-primary" id="cerrar" name="cerrar"
                                            value="close">Cerrar caja
                                        </button>
                                    </div>

                                    <div class="modal-footer col-sm-6">
                                        <button type="submit" class="btn btn-primary" id="mantener" name="mantener"
                                            value="open">Dejar turno abierto y cerrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN  MODAL   CAJA -->


            </div> <!-- Fin Contains page content -->
            @include('panel.footer')
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    </div>
    <!-- ./app -->
    @include('includes.libreriasJs')
</body>

</html>
