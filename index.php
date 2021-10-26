<?php 
    include('common/head.php');
?>

    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="assets/mp4/bg2.mp4" type="video/mp4" /></video>
    <div class="masthead">
        <div class="masthead-content text-white">
            <div class="container-fluid px-4 px-lg-0">
                <h1 class="mb-4"><span style="font-size: 70px;">E</span>xtrema<span style="font-size: 70px;">Pizza</span></h1>
                <p class="mb-5">
                    Que nadie te diga cuanta Pizza Puedes comer !!!
                </p>
                <form id="formLogin">
                    <div class="row">
                        <div class="col-4">
                            <input id="userLogin"  type="text" placeholder="Usuario" class="form-control" />
                        </div>
                        <div class="col-4">
                            <input id="passLogin" type="password" placeholder="*******" class="form-control" />
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-success">Ingresar</button>
                        </div>
                    </div>
                </form>
                <div class="alert_nosession"></div>
                <a href="register.php" class="linkRegister mt-2">No estoy registrado</a>
            </div>
        </div>
    </div>

    <div class="social-icons">
        <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
            <a class="btn socialColor m-3" target="_blank" href="https://htmlcolorcodes.com/es/"><i class="fab fa-twitter"></i></a>
            <a class="btn socialColor m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
            <a class="btn socialColor m-3" href="#!"><i class="fab fa-instagram"></i></a>
            <!--coemtary-->
        </div>
    </div>

<?php 
    include('common/footer.php');
?>

      