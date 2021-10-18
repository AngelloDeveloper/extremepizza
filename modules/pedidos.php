<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/carta_menu.class.php');

    //objetos
    $objCartaMenu = new carta_menu();
    $arrCartaMenu = $objCartaMenu->getAllCartaMenu();
?>

<!--modals-->
<div class="modal fade" id="modaldetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="title"></h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <img style="width:100%; border-radius:20px;" id="img" src="" />
                </div>
                <div class="col-6">
                    <p id="descripcion"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_modal" data-close="modaldetalle" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <h3>Menú</h3>
    </div>
    <div class="col-4 text-center">
        <span title="Pedido" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px; border: 2px solid #663477; font-size: 20px;">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        </span>
        <span title="Calculos" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px; font-size:20px;">
            <i class="fa fa-calculator" aria-hidden="true"></i>
        </span>
        <span title="Pago" style="margin-right:50px; background-color: silver; color: white; padding:15px 20px; border-radius:40px; font-size:20px;">
            <i class="fa fa-university" aria-hidden="true"></i>
        </span>
    </div>
    <div class="col-4"></div>
</div>

<hr />

<div class="card mt-4">
    <div class="card-body" style="background-color: #EDEDED; padding: 30px 50px;">
        
        <div class="row">
            <?php foreach($arrCartaMenu as $menu) { ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card mb-2" style="width: 18rem;">
                        <img src="<?= $menu['imagen'] ?>" class="card-img-top" height="200" alt="...">
                        <div class="card-body">
                            <div clarr="row">
                                <div class="col-12">
                                    <h5 class="card-title"><?= $menu['menu'] ?></h5>
                                    <button type="button" 
                                        style="color: #2CD041;" 
                                        class="btn modal_despliegue" 
                                        data-toggle="modal" 
                                        data-target="modaldetalle"
                                        data-menu="<?= $menu['menu'] ?>"
                                        data-descripcion="<?= $menu['descripcion'] ?>"
                                        data-img="<?= $menu['imagen'] ?>">
                                            Detalle
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <form>
                                        <div class="form-group">
                                            <center>
                                                <div class="form-check mb-2 mr-sm-2">
                                                    <input data-idmenu="<?= $menu['id_menu'] ?>" class="form-check-input" type="checkbox" id="inlineFormCheck" style="position:relative; left:20px; padding:10px; background-color: silver;"/>
                                                </div>
                                            </center>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            
                        </div>
                        
                        <!--<button class="btn btn-primary btn-block newOrden" data-idmenu="<?= $menu['id_menu'] ?>">Pedir</a>-->
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="aux" class="mt-4"></div>
    </div>
</div>