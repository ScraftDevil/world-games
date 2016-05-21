<!DOCTYPE html>
<html>

<?php

/* codigo php */

include("sections/head.php");

?>
    <body>
        <div id="page" class="page">
            <?php include("sections/nav.php"); ?>
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
                    <div id="general-error"></div>

                    <div id="send-message-form" class"send-message-form col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">
                    	<div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label>Correo electrónico</label>
                            <input id="emailReceiver" class="form-control" type="text" name="emailReceiver" placeholder="correoamigo@ejemplo.com">
                        </div>

                        <div class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Contenido del Mensaje</label>
                            <textarea id="contentMessage" class="form-control" type="text" name="contentMessage"  rows="10" placeholder="Escribe tu mensaje aquí"></textarea>
                        </div>

                        <a href="registeredProfileView.php" class="btn-info pull-left btn form-button" role="button">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Volver
                        </a>
                        <button type="button" id="sendPrivateMessage" class="btn-success pull-right btn form-button">Enviar mensaje</button>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

                        </div>
                    </div>
                </div>
            </section>
            <?php include("sections/footer.php"); ?>
    </body>
</html>