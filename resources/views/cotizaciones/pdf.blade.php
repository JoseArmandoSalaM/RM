<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización PDF</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .mb-3 {
            margin-bottom: 16px;
        }
        body {
            font-family: 'Arial', sans-serif;
        }
        
    .header > div,
    .header img {
        flex: 1; /* Esto asegura que el espacio se distribuya equitativamente */
        text-align: center; /* Centra el texto de los div */
    }
    .header img {
        flex: 0 0 100px; /* No permite que el logo crezca, pero sí que se encoja */
        max-height: 50px; /* Limita la altura del logo */
    }
    .header div:first-child {
        text-align: left; /* Alinea el primer div a la izquierda */
    }
    .header div:last-child {
        text-align: right; /* Alinea el último div a la derecha */
        font-size: 12px; /* Cambia el tamaño de la letra del párrafo */
    }
    .header h4 {
    margin: 0; /* Remueve los márgenes por defecto */
    margin-top: -23px;
    font-size: 12px; /* Cambia el tamaño de la letra del título */
}

.header h5 {
    margin: 0; /* Remueve los márgenes por defecto */
    margin-top: 2px;
    font-size: 12px; /* Cambia el tamaño de la letra del subtítulo */
}
h1 {
    margin: 0; /* Remueve los márgenes por defecto */
    margin-top: 2px;
    font-size: 18px; /* Cambia el tamaño de la letra del subtítulo */
}
.header p {
    margin: 0; /* Remueve los márgenes por defecto */
    margin-top: 2px;
    font-size: 12px; /* Cambia el tamaño de la letra del párrafo */
}

p {
    margin: 0; /* Remueve los márgenes por defecto */
    margin-top: 5px;
    font-size: 12px; /* Cambia el tamaño de la letra del párrafo */
}

        .logo {
            width: 100px; /* Ajusta según el tamaño deseado */
        }
        .linea {
    width: 70%; /* Ancho de la línea */
    height: 5px;
    background-color: #008000; /* Color verde */
    margin: 10px auto; /* Centra la línea horizontalmente y añade un margen superior */
}

.linea-secundaria {
    width: 60%; /* Ancho de la segunda línea */
    height: 5px;
    background-color: #ccc; /* Color gris */
    margin: 0 auto; /* Centra la línea horizontalmente */
}

        .fecha-lugar {
            text-align: right;
            margin-top: 10px;
        }

        .table {
    width: 100%;
    border-collapse: separate; /* Utiliza 'separate' para controlar mejor los bordes */
    border-spacing: 0; /* Elimina cualquier espacio entre las celdas */
    border: 0; /* Elimina todos los bordes */

}

.table th, .table td {
    padding: 3px; /* Ajusta el padding según tu necesidad */
    border: 0; /* Elimina todos los bordes */

}

.table thead th {
    background-color: #f8f9fa; /* Añade un color de fondo al encabezado, si deseas */
    border-bottom: 3px solid #ccc; /* Borde gris de 3px para el encabezado */
}

.table tbody tr td {
    border-bottom: 3px solid #ccc; /* Borde gris de 3px entre filas */
}

.table tbody tr:last-child td {
    border-bottom: none; /* Elimina el borde del fondo de la última fila */
}
.linea-final, .linea-secundaria-final {
        position: fixed;
        left: 50%; /* Coloca el punto de inicio de las líneas en el centro */
        transform: translateX(-50%); /* Centra las líneas exactamente en el centro */
        width: 60%; /* Ancho de la línea principal */
        bottom: 10px; /* Despegadas 10px del borde inferior de la página */
    }

    .linea-final {
        margin-top: 5px;
        background-color: #ccc; /* Color verde */ 
        height: 5px; /* Altura de la línea principal */
    }

    .linea-secundaria-final {
        background-color: #008000; /* Color gris para la segunda línea */
        height: 3px; /* Altura de la línea secundaria */
        width: 70%; /* Ancho de la línea secundaria */
        bottom: 17px; /* Ajusta para separar 2px debajo de la primera línea */
    }

    .footer {
    position: fixed;
    left: 0;
    bottom: -28; /* Colocar al pie de la página */
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 10px;
    padding: 5px 20px; /* Añade padding para un mejor espaciamiento */
    flex-wrap: nowrap; /* Evita que los elementos se envuelvan */
}

.footer-info {
    text-align: left;
    flex: 1 1 auto; /* Permite crecer y encogerse, pero también mantiene un tamaño base automático */
    min-width: 0; /* Evita que crezca demasiado y empuje a otro contenido */
}

.footer-phone {
    flex: 0 1 auto; /* No crece pero puede encogerse */
    text-align: right;
    align-self: flex-start; /* Alinea este elemento al inicio del contenedor flex (parte superior) */
    margin-top: -15px; /* Mueve el elemento 10px hacia arriba */
}

.footer-info p, .footer-phone p {
    margin: 2px 0; /* Ajusta el margen para un espaciamiento más compacto */
    white-space: nowrap; /* Evita que el texto se rompa en múltiples líneas */
}

.personal-info {
    font-weight: bold; /* Aplica negritas a todo el texto dentro de los párrafos */
    margin-top: 100px;
    margin-left: 40px;
}

.personal-info p {
    font-weight: bold; /* Aplica negritas a todo el texto dentro de los párrafos */
    font-size: 10;
}

.personal-info .name {
    text-align: left; /* Alinea el texto a la izquierda */
}

.personal-info .title {
    text-align: left; /* Asegura que el texto también esté alineado a la izquierda */
    margin-left: 15px; /* Añade una sangría de 15px a la izquierda */
}

    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('logoremen.jpg') }}" alt="Logo" class="logo">
    <div class="first-child">
        <h4>REINTEGRACIONES METÁLICAS ESTRUCTURALES</h4>
        <h5>DE MÉXICO S.A. DE C.V.</h5>
        <p>RFC: RME2210258V6</p>
    </div>
    <div class="last-child">MEX-USA</div>
</div>

    <div class="linea"></div>
    <div class="linea linea-secundaria"></div>
    <div class="fecha-lugar">
        Tlaxcala, Tlaxcala A {{ \Carbon\Carbon::now()->isoFormat('D [de] MMMM YYYY') }}
    </div>
<p>Estimado cliente le presentamos la cotización solicitada con respecto a la Construcción del local de servicios (Laboratorios de Ciencias Biológicas) ubicada en Av. 11 Poniente 2316</p>
    <div class="container">

    <h1>Presupuesto</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Costo Unitario</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Costo Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotizacion->presupuestos as $presupuesto)
                <tr>
                    <td>{{ $presupuesto->descripcion }}</td>
                    <td>${{ $presupuesto->importe }}</td>
                    <td>{{ $presupuesto->cantidad }}</td>
                    <td>{{ $presupuesto->unidad }}</td>
                    <td>${{ $presupuesto->costo_total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

     

        <table style="width:60%; border-collapse: collapse; float: right; margin-top:20px; border: 1px solid black;">
    <tr>
        <td style="border: 2px solid black; padding: 2px; text-align: right;">Total</td>
        <td style="border: 2px solid black; padding: 2px; text-align: right;">${{ $cotizacion->costo_total }}</td>
    </tr>
    <tr>
    <td colspan="2" style="border: 2px solid black; padding: 2px; text-align: right;  font-size: 12px;"><strong>{{ strtoupper($costoEnLetras) }} 40/100 MXN</strong></td>
    </tr>
</table>

<div class="personal-info">
    <p class="name">L. Fernando Villanueva P.</p>
    <p class="title">Director en Estrategias de ingeniería</p>
</div>



<div>
<div style="position: flex; left: 0; width: 100%;">
            <h2>Notas:</h2>
    <ul style="font-size: 12px; margin-top:-12px;">
        <li>Estos precios no incluyen IVA.</li>
        <li>La forma de pago será con un adelanto del 70%, resto sobre avance semanal.</li>
        <li>Los precios en metales son mensuales dependiendo al costo diario.</li>
        <li>Nuestros precios incluyen costos de traslado.</li>
        <li>Tiempo de entrega indeterminado.</li>
    </ul>
</div>

        </div>

    </div>
    
<div class="linea-final"></div>
<div class="linea-secundaria-final"></div>
<div class="footer">
    <div class="footer-info">
        <p>Insurgentes Norte, Santa Clara Atoyac Nativitas, Tlaxcala Tlax.</p>
        <p>Correo: fernandovillanueva@rememexico.mx</p>
    </div>
    <div class="footer-phone">
        <p>Tel: (771) 434 8063</p>
    </div>
</div>
</body>
</html>
