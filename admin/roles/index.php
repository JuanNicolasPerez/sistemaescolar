<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ROLES
include('../../app/controller/roles/listado_de_roles.php');
include('../../app/controller/roles/listado_de_permisos.php');
include('../../app/controller/roles/listado_de_roles_permisos.php');

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
                        <li class="breadcrumb-item active">Panel de roles</li>
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
                    <h3 class="card-title">Lista de roles</h3>
                    <div class="card-tools">
                        <!-- {{-- CREAR --}} -->
                        <a type="button" class="btn btn-primary" href="create.php">
                            Crear rol
                            <i class="fa fa-fw bi bi-plus-square"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead class="thead">
                            <tr>
                                <th>Nro</th>
                                <th>Nombre del rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador_rol = 0;
                            foreach ($roles as $rol) {
                                $contador_rol++;
                                $id_rol = $rol['id_rol'];
                                $nombre = $rol['nombres_rol'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_rol; ?></td>
                                    <td><?= $nombre; ?></td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <!-- {{-- ASIGNAR ROLES PERMISOS --}} -->
                                            <!-- Button modal -->
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAsignacion<?= $id_rol; ?>">
                                                <i class="fa fa-fw bi bi-check-circle"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalAsignacion<?= $id_rol; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content" style="background-color: #d7dfef;">
                                                        <div class="modal-header" style="background-color: yellow;">
                                                            <h5 class="modal-title" id="exampleModalLabel">Asigación de los roles y permisos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" name="rol_id" id="rol_id<?= $id_rol; ?>" value="<?= $id_rol; ?>" hidden>
                                                                    <label>Rol: <?= $rol['nombres_rol']; ?></label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select name="permiso_id" id="permiso_id<?= $id_rol; ?>" class="form-control">
                                                                        <?php
                                                                        foreach ($permisos as $permiso) {
                                                                            $id_permiso = $permiso['id_permiso'];
                                                                        ?>
                                                                            <option value="<?= $id_permiso; ?>">
                                                                                <?= $permiso['nombre_url']; ?>
                                                                            </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button type="submit" class="btn btn-primary mb-2" id="btn_registrar<?= $id_rol; ?>">
                                                                        Asignar
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <!-- AJAX - JQUERY -->
                                                            <script>
                                                                $('#btn_registrar<?= $id_rol; ?>').click(function() {
                                                                    var rol_id = $('#rol_id<?= $id_rol; ?>').val();
                                                                    var permiso_id = $('#permiso_id<?= $id_rol; ?>').val();
                                                                    var url = "../../app/controller/roles/createRolesPermisosController.php";

                                                                    $.get(url, {
                                                                        rol_id: rol_id,
                                                                        permiso_id: permiso_id
                                                                    }, function(datos) {
                                                                        $('#respuesta<?= $id_rol; ?>').html(datos);
                                                                        $('#table<?= $id_rol; ?>').css('display', 'none');
                                                                    });

                                                                    Swal.fire({
                                                                        position: "top-end",
                                                                        icon: "success",
                                                                        title: "Se registro el permiso de manera correcta.",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });

                                                                });
                                                            </script>

                                                            <hr>

                                                            <div id="respuesta<?= $id_rol; ?>"></div>

                                                            <div class="row" id="table<?= $id_rol; ?>">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered table-striped table-sm">
                                                                        <thead class="thead">
                                                                            <tr>
                                                                                <th>Nro</th>
                                                                                <th>Nombre del rol</th>
                                                                                <th>Permiso</th>
                                                                                <th>Accion</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            $contador = 0;

                                                                            foreach ($roles_Permisos as $role_Permiso) {
                                                                                if ($id_rol == $role_Permiso['id_rol']) {
                                                                                    $id_rol_permiso = $role_Permiso['id_rol_permiso'];
                                                                                    $contador = $contador + 1;
                                                                            ?>
                                                                                    <tr>
                                                                                        <td style="text-align: center"><?= $contador; ?></td>
                                                                                        <td style="text-align: center"><?= $role_Permiso['nombres_rol']; ?></td>
                                                                                        <td style="text-align: center"><?= $role_Permiso['nombre_url']; ?></td>
                                                                                        <td style="text-align: center">
                                                                                            <!-- {{-- ELIMINAR --}} -->
                                                                                            <form action="<?= APP_URL; ?>/app/controller/roles/deleteRolPermisoController.php" method="post"
                                                                                                onclick="preguntar<?= $id_rol_permiso; ?>(event)" id="miformulario<?= $id_rol_permiso; ?>">
                                                                                                <input type="text" name="id_rol_permiso" value="<?= $id_rol_permiso; ?>" hidden>
                                                                                                <button type="submit" class="btn btn-danger">
                                                                                                    <i class="fa fa-fw fa-trash"></i>
                                                                                                </button>
                                                                                            </form>
                                                                                            <script>
                                                                                                function preguntar<?= $id_rol_permiso; ?>(event) {
                                                                                                    event.preventDefault();
                                                                                                    Swal.fire({
                                                                                                        title: "Eliminar registro",
                                                                                                        text: "¿Desea eliminar este registro?",
                                                                                                        icon: 'question',
                                                                                                        showDenyButton: true,
                                                                                                        confirmButtonText: "Eliminar",
                                                                                                        confirmButtonColor: '#a5151d',
                                                                                                        denyButtonColor: '#270a0a',
                                                                                                        denyButtonText: 'Cancelar',
                                                                                                    }).then((result) => {
                                                                                                        if (result.isConfirmed) {
                                                                                                            var form = $('#miformulario<?= $id_rol_permiso; ?>');
                                                                                                            form.submit();
                                                                                                        }
                                                                                                    });
                                                                                                }
                                                                                            </script>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- {{-- MOSTRAR --}} -->
                                            <a type="button" class="btn btn-info" href="show.php?id=<?= $id_rol; ?>">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>

                                            <!-- {{-- EDITAR --}} -->
                                            <a type="button" class="btn btn-success" href="edit.php?id=<?= $id_rol; ?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                            <!-- {{-- ELIMINAR --}} -->
                                            <form action="<?= APP_URL; ?>/app/controller/roles/deleteController.php" method="post"
                                                onclick="preguntar<?= $id_rol; ?>(event)" id="miformulario<?= $id_rol; ?>">
                                                <input type="text" name="id_rol" value="<?= $id_rol; ?>" hidden>
                                                <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar<?= $id_rol; ?>(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "Eliminar registro",
                                                        text: "¿Desea eliminar este registro?",
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5151d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miformulario<?= $id_rol; ?>');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Datatables Idioma Español-->
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLenght": 10,
                                "language": {
                                    "semptyTable": "No hay informacion.",
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ roles",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 roles",
                                    "sInfoFiltered": "(filtrado de _MAX_ total roles)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ roles",
                                    "sLoadingRecords": "Cargando...",
                                    "sProcessing": "Procesando...",
                                    "sSearch": "Buscar:",
                                    "sZeroRecords": "No se encontraron resultados",

                                    "paginate": {
                                        "sFirst": "Primero",
                                        "sLast": "Último",
                                        "sNext": "Siguiente",
                                        "sPrevious": "Anterior"
                                    }
                                },

                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                buttons: [{
                                        text: 'Reportes',
                                        extend: 'collection',
                                        orientation: 'landscape',

                                        buttons: [{
                                            text: 'Copiar',
                                            extend: 'copy'
                                        }, {
                                            text: '<button class="btn btn-danger btn-sm btn-block"><i class="bi bi-file-earmark-pdf-fill"></i> PDF </button>',
                                            extend: 'pdf'
                                        }, {
                                            text: '<button class="btn btn-info btn-sm btn-block"><i class="bi bi-filetype-csv"></i> CSV </button>',
                                            extend: 'csv'
                                        }, {
                                            text: '<button class="btn btn-success btn-sm btn-block"><i class="bi bi-file-earmark-excel-fill"></i> EXCEL </button>',
                                            extend: 'excel'
                                        }, {
                                            text: '<button class="btn btn-warning btn-sm btn-block"><i class="bi bi-printer-fill"></i> IMPRIMIR </button>',
                                            extend: 'print'
                                        }],
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fidex three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        })
                    </script>
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