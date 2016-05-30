<!DOCTYPE html>
<html>

<?php

/* codigo php */
include("../sections/head.php");

if (!isset($_SESSION['user_id'])) {
        redirect('<div class="message-redirect">¡No has hecho login. No puedes acceder a esa pagina!</div>', '/world-games/view/mainViews/home.php');
}

if (isset($_GET['gameid']) && $_GET['gameid'] != "") {
    $gameid = $_GET['gameid'];

}
else {
    $gameid = "";
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
                            <h1>FORMULAR DENUNCIA</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Denuncia el juego por algun fallo sobre el </h2>
                        </div>
                    </div>

                    <!-- Mensaje de Error de que no se puede actualizar por falta de datos o datos incorrectos 
                         o de que se han actualizado corretamente -->
                    <div id="general-error" class="col-lg-offset-2 col-xs-12 col-sm-6 col-md-6 col-lg-9"></div>

                    <div id="send-message-form" class"send-message-form col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">

                    <div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                            <label>Usuario responsable</label>
                            <input id="responsibleName"  class="form-control" type="text" name="responsibleName" value="<?php echo $_SESSION['user_id'];?>" >
                        </div>

                    	
                        <div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label>Razon denuncia:</label>
                            <input  id="reasoncomplain"  class="form-control" type="text" name="reasonreport"  >
                        </div>

                        <div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Contenido de la denuncia:</label>
                            <textarea maxlength="100" class="form-control contentReport" id="contentcomplain" type="text" name="contentReport"  rows="6" placeholder="Escribe tu denuncia aquí"></textarea>
                        </div>

                        <a href="../userViews/registeredProfileView.php" class="button-profile pull-left btn form-button" role="button">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Volver al Perfil
                        </a>
                        <button type="button"  id="sendComplainreason" class="button-green pull-right btn form-button">
                            <span class="glyphicon glyphicon-send"></span>
                            Enviar Denuncia
                        </button>
                    </div>
                </div>
            </section>
            <footer>
                <?php include("../sections/footer.php"); ?>
                <script type="text/javascript" src="../resources/js/complainManage.js"></script>
            </footer>
    </body>
</html>