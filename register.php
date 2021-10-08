<?php 
    include('common/head_modules.php');
?>
    <style>
        .style_alert_focus {
            border : 1px solid red;
        }

        .style_alert_message {
            color: red;
            font-size:14px;
            padding: 0;
        }
    </style>
    <img class="bg-img" src="assets/img/register_background.jpg" />
    <nav class="navbar navbar-expand-lg navbar-light bgColor_">
        <div class="container-fluid">
            <a style="color: white;" class="navbar-brand" href="#">ExtremePizza</a>
            <a href="index.php" style="float: right; color: white; text-decoration: none;">Volver</a>
        </div>
    </nav>

    <div id="system_message"></div>
    
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div id="card-dataperson" class="card styleCardOpacity">
                    <div class="card-body">
                        <form id="form_r1">
                            <div class="form-group">
                                <label class="mb-2">Nombre</label>
                                <input id="name" type="text" 
                                    placeholder="Nombre"
                                    class="form-control mb-2"
                                    required 
                                />
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Apellido</label>
                                <input id="lastname" type="text" 
                                    placeholder="Apellido"
                                    class="form-control mb-2"
                                    required 
                                />
                            </div>
                            <div class="form-group validation" >
                                <label class="mb-2">Cedula</label>
                                <input id="cedula" type="number" 
                                    placeholder="Cedula"
                                    class="form-control mb-2"
                                    required 
                                />
                            </div>
                            <div class="form-group validation">
                                <label class="mb-2">Correo Electrónico</label>
                                <input id="email" type="email" 
                                    placeholder="Correo Electrónico"
                                    class="form-control mb-2"
                                    required 
                                />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-6">
                                    <label class="mb-2">Linea</label>
                                    <select id="codeNumber" class="form-control mb-2" required>
                                        <option value="0424">0424</option>
                                        <option value="0414">0414</option>
                                        <option value="0426">0426</option>
                                        <option value="0426">0426</option>
                                        <option value="0276">0276</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="mb-2">Teléfono</label>
                                    <input id="number" type="number" 
                                        placeholder="#"
                                        class="form-control mb-2" 
                                        required
                                    />
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Dirección</label>
                                <input id="direction" type="text" 
                                    placeholder="Calle # Casa"
                                    class="form-control mb-2"
                                    required 
                                />
                            </div>
                            <button type="submit" class="btn btn-success mt-2" style="width: 100%;">Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

<?php 
    include('common/footer_modules.php');
?>