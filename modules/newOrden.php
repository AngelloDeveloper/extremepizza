<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/carta_menu.class.php');

    if(!$_REQUEST) {
        header('Location: ../dashboard.php');
    } else {
        $idMenu = $_REQUEST;
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
    <div class="col-12">
        <button style="float:right;" class="btn btn-secondary address" data-description="Pedido" data-address="modules/pedidos.php">Volver</button>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        <?php foreach($arrCartaMenu as $pedido) { ?>
            <div class="row" style="background-color: #75109A; color:white; border-radius: 20px;">
                <div class="col-6">
                    <img src="<?= $pedido['imagen'] ?>" class="mt-3 mb-3" style="width:50%;height:150px;border-radius:20px; float:left;" />
                </div>
                <div class="col-6">
                    <h2 class="text-left mt-3"><?= $pedido['menu'] ?></h2>
                    <p class="text-left"><?= $pedido['descripcion'] ?></p>
                    <form id="form_orden">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Cantidad</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="cantidad" 
                                            type="text" 
                                            placeholder="0"
                                            onkeypress="ValidaSoloNumeros()" 
                                            value="1" 
                                            class="form-control cantidad" 
                                            aria-label="Dollar amount (with dot and two decimal places)" 
                                        />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                $ <span data-precio="<?= $pedido['precio'] ?>" class="costo_cantidad">
                                                    <?= $pedido['precio'] ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Presentación</label>
                                <div class="input-group mb-3">
                                    <select id="presentacion" class="custom-select form-control presentacion">
                                        <option value="0,0">Seleccionar</option>
                                        <?php foreach($arrPresentacion as $presentacion) {  ?>
                                            <option value="<?= $presentacion['id_presentacion'].','.$presentacion['valor_agregado']?>"><?=$presentacion['presentacion']?></option> 
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">$<span class="valor_presentacion">0</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Total</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> $</span>
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
                    </form>
                </div>
            </div>
            <hr />
        <?php } ?>
        <div class="row">
            <div class="col-12">
                <center>
                    <button id="finish" class="btn btn-success btn-lg">Finalizar</button>
                </center>
            </div>
        </div>
    </div>
</div>