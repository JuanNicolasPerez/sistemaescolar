<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');


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
            <div class="card card-outline card-primary" style="background: #d3d2d2">
                <div class="card-header">
                    <h3 class="card-title">Inscripciones</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- INSCRIPCION -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary">
                                    <i class="bi bi-person-workspace"></i>
                                </span>
                                <div class="info-box-content">
                                    <center>
                                        <span class="info-box-text">Inscripciones</span>
                                    </center>
                                    <!-- {{-- CREAR --}} -->
                                    <a type="button" class="btn btn-primary btn-sm" href="create.php">
                                        Nuevo estudiante
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- IMPORTAR DATOS POR ARCHIVOS -->
                        <!-- <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="bi bi-person-plus"></i>
                                </span>
                                <div class="info-box-content">
                                    <center>
                                        <span class="info-box-text">Importar estudiantes</span>
                                    </center>
                                    {{-- SUBIR --}}
                                    <a type="button" class="btn btn-success btn-sm" href="importar/index.php">
                                        Subir archivo
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<?php
//  PIE DE PAGINA 
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>