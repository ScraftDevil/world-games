<!DOCTYPE html>
<html>

<?php

/* codigo php */
include("../sections/head.php");

if (!isset($_SESSION['user_id'])) {
        redirect('<div class="message-redirect">¡No has hecho login. No puedes acceder a esa pagina!</div>', '/world-games/view/mainViews/home.php');
}

if (isset($_GET['receiverName']) && $_GET['receiverName'] != "") {
    $receiverName = $_GET['receiverName'];
}
else {
    $receiverName = "";
}

?>
    <body>
        <div id="page" class="page">
            <?php include("../sections/nav.php"); ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Nuevo Mensaje</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Envíale un mensaje privado a otro usuario registrado</h2>
                        </div>
                    </div>

                    <!-- Mensaje de Error de que no se puede actualizar por falta de datos o datos incorrectos 
                         o de que se han actualizado corretamente -->
                    <div id="general-error" class="col-lg-offset-2 col-xs-12 col-sm-6 col-md-6 col-lg-9"></div>

                    <div id="send-message-form" class"send-message-form col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">
                    	<div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label>Nombre de usuario</label>
                            <input id="receiverName" class="form-control" type="text" name="receiverName" value="<?php echo $receiverName?>" placeholder="Pepito">
                        </div>

                        <div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Contenido del Mensaje</label>
                            <textarea class="form-control contentMessage" type="text" name="contentMessage"  rows="10" placeholder="Escribe tu mensaje aquí"></textarea>
                        </div>

                        <a href="registeredProfileView.php" class="button-profile pull-left btn form-button" role="button">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Volver al Perfil
                        </a>
                        <button type="button" id="sendPrivateMessage" class="button-green pull-right btn form-button">
                            <span class="glyphicon glyphicon-send"></span>
                            Enviar mensaje
                        </button>
                    </div>
                </div>
            </section>
            <footer>
                <?php include("../sections/footer.php"); ?>
                <script type="text/javascript" src="../resources/js/userProfile.js"></script>
            </footer>
    </body>
</html>