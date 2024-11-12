<?php
//CONEXION BASE DE DATOS 
include('../../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../../admin/layout/parte1.php');

// INCLUIMOS EL CONTROLLER DE INSTITUCION
include('../../../app/controller/configuraciones/institucion/datosController.php');
?>

<!-- CUERPO DE PAGINA -->
<div class="content-wrapper" style="background: #d7dfef;">
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
                        <li class="breadcrumb-item active">Panel Institución</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Datos de la institución</h3>
                            <div class="card-tools">
                                
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre_institucion">Nombre de la institución</label>
                                                <input type="text" name="nombre_institucion" class="form-control" value="<?= $nombre_institucion; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Correo de la institución</label>
                                                <input type="email" name="email" class="form-control" disabled value="<?= $correo; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono">Telefono de la institución</label>
                                                <input type="number" name="telefono" class="form-control" disabled value="<?= $telefono; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="celular">Celular de la institución</label>
                                                <input type="number" name="celular" class="form-control" disabled value="<?= $celular; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">Direccion de la institución</label>
                                                <input type="text" name="direccion" class="form-control" disabled value="<?= $direccion; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <center>
                                                    <label for="logo">Logo de la institución</label>
                                                </center>                                       
                                            </div>
                                            <br>
                                            <!-- {{-- VISUALIZA LA IMAGEN --}} -->
                                            <center>
                                                <img src="<?=APP_URL."/public/images/configuracion/".$logo; ?>" alt="Imagen Logo" style="width: 50%;">
                                            </center>
                                            <!-- {{-- CARGAR LA IMAGEN --}} -->
                                            <script>
                                                function archivo(evt) {
                                                    var files = evt.target.files; // FileList object
                                                    //Obtenemos la imagen del campo "file".
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                        //Solo admitimos imágenes.
                                                        if (!f.type.match('image.*')) {
                                                            continue;
                                                        }
                                                        var reader = new FileReader();
                                                        reader.onload = (function(theFile) {
                                                            return function(e) {
                                                                // Insertamos la imagen.
                                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e
                                                                    .target
                                                                    .result, '"width="70%" title="', escape(theFile.name), '"/>'
                                                                ].join('');
                                                            };
                                                        })(f);
                                                        reader.readAsDataURL(f);
                                                    }
                                                }
                                                document.getElementById('file').addEventListener('change', archivo, false);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <center>
                                            <a href="<?= APP_URL; ?>/admin/configuraciones/institucion" type="button" class="btn btn-secondary">Volver</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<?php
//  PIE DE PAGINA 
include('../../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../../layout/mensajes.php');
?>