<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/carta_menu.class.php');

    if(!$_REQUEST) {
        header('Location: ../dashboard.php');
    } else {
        $idMenu = $_REQUEST;
        var_dump($idMenu);
        die();
    }

    //objetos
    $objCartaMenu = new carta_menu();
    $arrCartaMenu = $objCartaMenu->getCartaMenu($idMenu);
?>

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED;">
        <div class="row">
            <div class="col-6">
                <img src="<?= $arrCartaMenu['imagen'] ?>" style="width:100%;height:350px;border-radius:20px;" />
            </div>
            <div class="col-6">
                <h2 class="text-left"><?= $arrCartaMenu['menu'] ?></h2>
                <p class="text-left"><?= $arrCartaMenu['descripcion'] ?></p>
                <form id="form_orden">
                    <div class="form-group">
                        <input type="number" value="1" class="form-control mb-4" style="width:80px;"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>