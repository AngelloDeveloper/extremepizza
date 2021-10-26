<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/user.class.php');
    require('../class/type_user.class.php');

    //objetos
    $objUser = new User();
    $objTypeUser = new UserType();
    $arrTypeUser = $objTypeUser->getUserType();
    $arrUser = $objUser->getAllUser();
?>

<div class="row">
    <div class="col-12">
        <h3>Usuarios</h3>
    </div>
</div>

<?php if(!empty($_GET['edit'])) { 
    $dataUser = $objUser->getUser($_GET['id'])[0];
    if($dataUser['status'] == 0) {
        $status = '<span style="padding:2px 6px; color:white; border-radius:20px; background-color:#dc3545; font-size:15px; margin-left:12px;">Bloqueado</span>';
        $checked = '';
    } else {
        $status = '<span style="padding:2px 6px; color:white; border-radius:20px; background-color:#198754; font-size:15px; margin-left:12px;">Activo</span>';
        $checked = 'checked';
    }

?>
    <div class="card mt-4">
        <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
            <div class="card">
                <div class="card-body">
                    <h3>Editar</h3>
                    <br />
                    <div class="row">
                        <div class="col-md-4">
                            <form id="form_EditUser" action="user.php" method="POST">
                                <div class="form-group mb-4">
                                    <label><strong>Usuario</strong></label>
                                    <p><?= $dataUser['user'] ?></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label><strong>Tipo de Usuario</strong></label>
                                    <select id="type_user" class="form-control">
                                        <?php foreach($arrTypeUser as $userType) { 
                                            $selected = ($dataUser['id_type_user'] == $userType['id_type_user']) ? 'selected' : '';   
                                        ?>
                                            <?php if(!in_array($userType['id_type_user'], [1])) { ?>
                                                <option <?= $selected ?> value="<?= $userType['id_type_user'] ?>"><?= $userType['tipo'] ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label><strong>status</strong></label>
                                    <div class="form-check form-switch">
                                        <input id="checkStatus" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?= $checked ?>>
                                        <label id="checkLabel" class="form-check-label" for="flexSwitchCheckChecked"><?= $status ?></label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <h4>Privilegios</h4>
                                    <label><strong>Agregar</strong></label>
                                    <div class="form-check form-switch">
                                        <input  class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label id="checkLabel" class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                    </div>
                                    <label><strong>Actualizar</strong></label>
                                    <div class="form-check form-switch">
                                        <input  class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label id="checkLabel" class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                    </div>
                                    <label><strong>Eliminar</strong></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label id="checkLabel" class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <input id="idUser" type="hidden" value="<?= $dataUser['id'] ?>" /> 
                                    <button class="btn btn-success btn-md">Guardar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div id="alert_success"></div>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        <div class="row">
            <div class="col-md-3">
                <label>Usuario</label>
                <input type="text" placeholder="Usuario" class="form-control" />
            </div>
            <div class="col-md-3">
                <label>Tipo de Usuario</label>
                <select class="form-control">
                    <option value="2">Admin</option>
                    <option value="3">Cliente</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Cedula</label>
                <input type="text" class="form-control" placeholder="V-" />
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm mt-4" style="background-color: #663477; color: white;">Buscar</button>
                <button class="btn btn-sm btn-secondary mt-4">Limpiar</button>
            </div>
        </div>
        <hr />
        <div class="row mb-2">
            <div class="col-12">
                <button style="float:right;" class="btn btn-md btn-success">Nuevo Usuario</button>
            </div>
        </div>
        <div class="row" id="table_filter">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center" style="background-color: #224466; color: white;">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Tipo de Usuario</th>
                        <th>Status</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach($arrUser as $user) { 
                        if($user['status'] == 1) {
                            $status = 'Activo';
                            $styleStatus = 'background-color:#198754;';
                        } else {
                            $status = 'Bloqueado';
                            $styleStatus = 'background-color:#dc3545;';
                        }
                    ?>
                        <?php if(!in_array($user['id_type_user'], [1])) { ?>
                            <tr class="text-center">
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['user'] ?></td>
                                <td><b><?= $arrTypeUser[$user['id_type_user']]['tipo'] ?></b></td>
                                <td>
                                    <span style="padding:2px 6px; color:white; border-radius:20px; <?= $styleStatus; ?>">
                                        <?= $status ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="address btn btn-warning btn-sm" data-address="modules/users.php?edit=true&id=<?= $user['id'] ?>" data-description="Usuarios"><i class="fa fa-cogs" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>

