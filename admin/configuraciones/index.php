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
                        <li class="breadcrumb-item active">Panel configuracion</li>
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
                    <h3 class="card-title">Configuraciones del sistema</h3>
                    <div class="card-tools">
                        
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- CONFIGURACION INSTITUCION-->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary">
                                    <i class="far fa">
                                        <i class="bi bi-hospital"></i>
                                    </i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        <b>
                                            Datos de la Institución
                                        </b>
                                    </span>
                                    <a href="institucion" class="btn btn-primary btm-sm">Configuración</a>
                                </div>
                            </div>
                        </div>

                        <!-- GESTION -- PERIODO -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="far fa">
                                        <i class="bi bi-calendar-range"></i>
                                    </i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        <b>
                                            Gestion educativa
                                        </b>
                                    </span>
                                    <a href="gestion" class="btn btn-info btm-sm">Configuración</a>
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
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>