<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/carta_menu.class.php');

    /*if(!$_REQUEST) {
        header('Location: ../dashboard.php');
    } else {
        $idMenu = $_REQUEST;
    }*/

    if($_REQUEST) {
        $idMenu = $_REQUEST;
        $_SESSION['newOrden'] = $_REQUEST;
    } else if(!empty($_SESSION['newOrden'])) {
        $idMenu = $_SESSION['newOrden'];
    }

    //objetos
    $objCartaMenu = new carta_menu();
    foreach($idMenu['orden'] as $key => $value) {
        $arrCartaMenu[$key] = $objCartaMenu->getCartaMenu($value);
    }

    $arrPresentacion = $objCartaMenu->getAllPresentacion();
?>

<!--Modal-->
<div class="modal fade" id="validation_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
      </div>
      <div class="modal-body">
        <center>
            <i style="font-size:50px;color: orange;" class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <p class="text-center">Verifica que todos los campos esten llenos.</p>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_modal" data-close="validation_modal"  data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-4">
        <h3>Cotización</h3>
    </div>
    <div class="col-4 text-center">
        <span title="Manú" style="margin-right:50px; background-color: #39B332; color: white; padding:15px 20px; border-radius:40px; font-size:20px;">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        </span>
        <span title="Cotización" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px;  border: 2px solid #663477; font-size:20px; ">
            <i class="fa fa-calculator" aria-hidden="true"></i>
        </span>
        <span title="Divisa a Pagar" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px; font-size:20px;">
            <i class="fa fa-university" aria-hidden="true"></i>
        </span>
    </div>
    <div class="col-4">
        <button style="float:right;" class="btn btn-secondary address" data-description="Pedido" data-address="modules/pedidos.php">Volver</button>
    </div>
</div>

<hr />

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        <?php foreach($arrCartaMenu as $pedido) { ?>
            <div class="row" style="background-color: #663477; color:white; border-radius: 20px;">
                <div class="col-6">
                    <img src="<?= $pedido['imagen'] ?>" style="width:25%;height:184px;border-radius:20px; position:absolute; left:38px;" />
                </div>
                <div class="col-6">
                    <h2 class="text-left mt-3"><?= $pedido['menu'] ?></h2>
                    <p class="text-left"><?= $pedido['descripcion'] ?></p>
                    <form class="form_pedido">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Cantidad</label>
                                <span 
                                    style="float:right; font-size:15px; background-color:#E0D71F; color: black; padding: 0px 0px 5px 0px; position:relative; top: 5px;"
                                >
                                    <b>Precio</b>
                                </span>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input 
                                            type="text" 
                                            placeholder="0"
                                            onkeypress="ValidaSoloNumeros()" 
                                            value="1" 
                                            class="form-control cantidad" 
                                            aria-label="Dollar amount (with dot and two decimal places)" 
                                        />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <b>$</b> <span data-precio="<?= $pedido['precio'] ?>" class="costo_cantidad">
                                                    <b><?= $pedido['precio'] ?></b>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Presentación</label>
                                <span 
                                    style="float:right; font-size:15px; background-color:#E0D71F; color: black; padding: 0px 0px 5px 0px; position:relative; top: 5px;"
                                >
                                    <b>Precio</b>
                                </span>
                                <div class="input-group mb-3">
                                    <select class="custom-select form-control presentacion">
                                        <option value="0,0">Seleccionar</option>
                                        <?php foreach($arrPresentacion as $presentacion) {  ?>
                                            <option value="<?= $presentacion['id_presentacion'].','.$presentacion['valor_agregado']?>"><?=$presentacion['presentacion']?></option> 
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01"><b>$</b><span class="valor_presentacion"><b>0</b></span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label style="font-size:15px; background-color:rgba(44,44,44,.6); color: white; padding: 0px 0px 4px 0px; position:relative; top: 3px;"><b>Total</b></label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: #329139;border: 1px solid #329139;color: white;"><b>$</b></span>
                                        </div>
                                        <input data-total="0" 
                                            data-cantidad="0" 
                                            data-presentacion="0" 
                                            value="0" 
                                            class="form-control total" 
                                            style="border:none; background-color:rgba(145,105,149); color: white;" 
                                            disabled 
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="idmenu" value="<?= $pedido['id_menu'] ?>" />
                    </form>
                </div>
            </div>
            <hr />
        <?php } ?>
        <div class="row">
            <div class="col-12">
                <center>
                    <button id="finish" class="btn btn-success btn-lg">
                        Continuar
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>