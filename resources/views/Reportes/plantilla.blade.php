<!DOCTYPE html>
<html>

<head>
    <title>BOLETA DE VENTA</title>
    <style type="text/css">
        body {
            font-size: 16px;
            font-family: "Arial";
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 6px 5px;
            font-size: 15px;
        }

        .h1 {
            font-size: 21px;
            font-weight: bold;
        }

        .h2 {
            font-size: 18px;
            font-weight: bold;
        }

        .tabla1 {
            margin-bottom: 20px;
        }

        .tabla2 {
            margin-bottom: 20px;
        }

        .tabla3 {
            margin-top: 15px;
        }

        .tabla3 td {
            border: 1px solid #000;
        }

        .tabla3 .cancelado {
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            border-top: 1px dotted #000;
            width: 200px;
        }

        .emisor {
            color: red;
        }

        .linea {
            border-bottom: 1px dotted #000;
        }

        .border {
            border: 1px solid #000;
        }

        .fondo {
            background-color: #dfdfdf;
        }

        .fisico {
            color: #fff;
        }

        .fisico td {
            color: #fff;
        }

        .fisico .border {
            border: 1px solid #fff;
        }

        .fisico .tabla3 td {
            border: 1px solid #fff;
        }

        .fisico .linea {
            border-bottom: 1px dotted #fff;
        }

        .fisico .emisor {
            color: #fff;
        }

        .fisico .tabla3 .cancelado {
            border-top: 1px dotted #fff;
        }

        .fisico .text {
            color: #000;
        }

        .fisico .fondo {
            background-color: #fff;
        }

        #logo {
            display: none;
        }

    </style>
</head>

<body>
    <div>
        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>Factura</strong></td>
                <td align="center" class="fondo"><strong>Fecha</strong></td>
                <td align="center" class="fondo"><strong>Vendedor</strong></td>
                <td align="center" class="fondo"><strong>Descripcion</strong></td>
                <td align="center" class="fondo"><strong>Cantidad</strong></td>
                <td align="center" class="fondo"><strong>Neto</strong></td>
                <td align="center" class="fondo"><strong>Total</strong></td>

            </tr>
            <tbody id="plantilla">
                @php
                    $total=0;                
                @endphp
                
                @foreach ($datos as $x)
                    @php
                        $valor=$x->total;
                        $total=$valor+$total;  
                        $total_venta = $total;                         
                    @endphp 
                    <tr>
                        <td>{{ $x->id }}</td>
                        <td>{{ $x->fecha }}</td>
                        <td>{{ $x->firstname }}</td>
                        <td>{{ $x->descripcion }}</td>
                        <td>{{ $x->cantidad }}</td>
                        <td>{{ $x->p_venta }}</td>
                        <td>{{ $x->total }}</td>
                    </tr>
                @endforeach
         
                    <tr>
                        <td style="border:0;">&nbsp;</td>
                        <td style="border:0;">&nbsp;</td>
                        <td style="border:0;">&nbsp;</td>
                        <td style="border:0;">&nbsp;</td>
                        <td style="border:0;">&nbsp;</td>
                        <td align="right"><strong>TOTAL</strong></td>
                        <td align="left"><span class="text">${{$total_venta = $total}}</span></td>
                   </tr>
            </tbody>
            
        </table>
    </div>
</body>
</html>
