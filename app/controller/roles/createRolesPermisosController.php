<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');


$id_rol = $_GET['rol_id'];
$permiso_id = $_GET['permiso_id'];


$sql = "INSERT INTO roles_permisos (rol_id, permiso_id, fyh_creacion, estado) 
                VALUES (:rol_id, :permiso_id, :fyhcreacion, :estado)";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('rol_id', $id_rol);
$sentencia->bindParam('permiso_id', $permiso_id);
$sentencia->bindParam('fyhcreacion', $fechaHora);
$sentencia->bindParam('estado', $estado_registro);
$sentencia->execute();

?>
<div class="row">
    <table class="table table-bordered table-striped table-sm" id="tabla_res<?= $id_rol; ?>">
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

            $sql = "SELECT * FROM roles_permisos AS rolper
                            INNER JOIN permisos AS per
                            ON per.id_permiso = rolper.permiso_id
                            INNER JOIN roles AS rol
                            ON rol.id_rol = rolper.rol_id
                    WHERE rolper.estado = '1'
                    ORDER BY per.nombre_url ASC";
            $query = $pdo->prepare($sql);
            $query->execute();

            $roles_Permisos = $query->fetchAll(PDO::FETCH_ASSOC);

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