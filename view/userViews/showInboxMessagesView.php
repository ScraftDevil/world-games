<!DOCTYPE html>
<html>

<?php

    include("../sections/head.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../mainViews/home.php");
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
                            <h1>Bandeja de Entrada</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Aquí puedes gestionar tus mensajes recibidos</h2>
                        </div>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

                        	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	                        	<a href="registeredProfileView.php" class="button-profile pull-left btn form-button" role="button">
	                            	<i class="fa fa-arrow-left" aria-hidden="true"></i>
	                            	Vuelve al Perfil
	                        	</a>
                        	</div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <a href="sendPrivateMessageView.php" id="newMessage" class="button-profile pull-right btn form-button" role="button">
                                    <span class="glyphicon glyphicon-send"></span>
                                    Nuevo Mensaje
                                </a>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="privateMessages">
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <?php include("../sections/footer.php"); ?>
                <script type="text/javascript" src="../resources/js/userProfile.js"></script>
            </footer>
    </body>
</html>