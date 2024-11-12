<?php
//CONEXION BASE DE DATOS 
include('../../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../../admin/layout/parte1.php');

?>
<!-- CUERPO DE PAGINA -->
<div class="content-wrapper" style="background: #d7dfef">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel de inscripciones</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success" style="background: #d3d2d2">
                <div class="card-header">
                    <h3 class="card-title">Importar Estudiantes</h3>
                    <div class="card-tools">
                        <!-- {{-- CREAR --}} -->
                        <a type="button" class="btn btn-success" href="PLANTILLA_IMPORTAR_ESTUDIANTES.xlsx">
                            Descargar plantilla
                            <i class="fa fa-fw bi bi-cloud-download-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" class="form-control" id="archivoExcel" accept=".xlsx, .xls" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button id="cargarArchivo" class="btn btn-info">Visualizar archivo</button>
                            <button id="enviarDatos" class="btn btn-success">Registrar archivos</button>
                            <script>
                                var datosExcel;
                                document.getElementById('cargarArchivo').addEventListener('click', function() {
                                    var input = document.getElementById('archivoExcel');
                                    var archivo = input.files[0];
                                    if (!archivo) {
                                        alert('Por favor, selecciona un archivo.');
                                        return;
                                    }
                                    if (!archivo.name.endsWith('.xlsx') && !archivo.name.endsWith('.xls')) {
                                        alert('Por favor, selecciona un archivo Excel válido.');
                                        return;
                                    }
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var data = new Uint8Array(e.target.result);
                                        var workbook = XLSX.read(data, {
                                            type: 'array'
                                        });
                                        var hoja = workbook.Sheets[workbook.SheetNames[0]];
                                        datosExcel = XLSX.utils.sheet_to_json(hoja, {
                                            header: 1
                                        });
                                        mostrarTabla(datosExcel);
                                    };
                                    reader.readAsArrayBuffer(archivo);
                                });
                                document.getElementById('enviarDatos').addEventListener('click', function() {
                                    if (!datosExcel) {
                                        alert('Primero debes cargar un archivo Excel.');
                                        return;
                                    }
                                    enviarDatos(datosExcel);
                                });

                                function mostrarTabla(datos) {
                                    var container = document.getElementById('tablaContainer');
                                    container.innerHTML = '';
                                    var tabla = document.createElement('table');
                                    tabla.border = 1;
                                    tabla.classList.add = 'table table-bordered table-striped table-sm';
                                    datos.forEach(function(fila) {
                                        var filaTabla = document.createElement('tr');
                                        fila.forEach(function(celda) {
                                            var celdaTabla = document.createElement('td');
                                            celdaTabla.textContent = celda;
                                            filaTabla.appendChild(celdaTabla);
                                        });
                                        tabla.appendChild(filaTabla);
                                    });
                                    container.appendChild(tabla);
                                }

                                function enviarDatos(datos) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'insertar.php', true);
                                    xhr.setRequestHeader('Content-Type', 'application/json');
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            alert('Datos enviados y procesados correctamente.');
                                        }
                                    };
                                    xhr.send(JSON.stringify(datos));
                                }
                            </script>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Retornamos los datos de excel -->
                            <div id="tablaContainer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//  PIE DE PAGINA 
include('../../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../../layout/mensajes.php');
?>