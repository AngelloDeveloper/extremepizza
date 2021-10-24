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

<!--modals-->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4 id="descripcion" class="text-center text-success"></h4>
                        <div id="download_voucher"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button id="finish_Voucher" class="btn btn-success">Finalizar</button>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <h3>Divisa a Pagar</h3>
    </div>
    <div class="col-4 text-center">
        <span title="Pedido" style="margin-right:50px; background-color: #39B332; color: white; padding:15px 20px; border-radius:40px; font-size:20px">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        </span>
        <span title="Calculos" style="margin-right:50px; background-color: #39B332; color: white; padding:15px 20px; border-radius:40px; font-size:20px;">
            <i class="fa fa-calculator" aria-hidden="true"></i>
        </span>
        <span title="Pago" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px; border: 2px solid #663477; ">
            <i class="fa fa-university" aria-hidden="true"></i>
        </span>
    </div>
    <div class="col-4">
        <button style="float:right;" class="btn btn-secondary address" data-description="Pedido" data-address="modules/newOrden.php">Volver</button>
    </div>
</div>

<hr />

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        <div class="row">
            <input type="hidden" id="data_pedido" value=<?= json_encode($arrData['data'], true)?> /> <!--codificacion del array-->
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