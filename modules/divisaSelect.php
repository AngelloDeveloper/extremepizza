<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/divisas.class.php');

    if(!$_REQUEST) {
        header('Location: ../dashboard.php');
    } else {
        $arrData = $_REQUEST;
    }

    //objetos
    $objDivisas = new Divisas();
    $arrDivisas = $objDivisas->getAllDivisas();

?>

<style>
    .divisa {
        background-color: #7292B1; 
        color: white;
    }

    .divisa:hover {
        background-color: #224466;
        cursor:pointer;
    }
</style>

<div class="row">
    <div class="col-6">
        <h3>Divisa a Pagar</h3>
    </div>
    <div class="col-6">
        <button style="float:right;" class="btn btn-secondary address" data-description="Pedido" data-address="modules/newOrden.php">Volver</button>
    </div>
</div>

<hr />

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        <div class="row">
            <input type="hidden" id="data_pedido" value="<?=$arrData['data']?>" /> <!--codificacion del array-->
            <?php foreach($arrDivisas as $divisa) { ?>
                <div class="col-4">
                    <div class="card divisa" data-divisa="<?= $divisa['id_divisa'] ?>">
                        <div class="card-body">
                            <h3 class="text-center"><?=  $divisa['divisa'] ?></h3>
                            <h2 class="text-center"><?= $divisa['simbolo'] ?></h2>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>