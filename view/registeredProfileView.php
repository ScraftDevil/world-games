<?php

/* codigo php */

// controlador del perfil de usuario registrado
include("../controller/registeredProfileController.php");

//array que contiene los datos del usuario segun el id obtenido despu�s de hacer login
$id = $_SESSION['user_id'];
$registered = getRegisteredInfo($id);

$registeredObj = new Registered("german","1234","german@123.com","2011-12-13","Arabia Saudi");
$registeredObj->setId("123");

$_SESSION['registered'] = serialize($registeredObj);

?>

<!--DOCTYPE html -->
<html>
    <?php include("sections/head.php"); ?>
    <body>
        <div id="page" class="page">
            <?php include("sections/nav.php"); ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Perfil de Usuario</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Aqui encontraras todo lo relativo a tu cuenta, <?php echo $registered[0][0] ?></h2></div>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                            <div class="profile">
                                <!-- Datos del usuario -->
                                <div class="desplegableProfile" id="datosPersonales">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Datos Personales
                                </div>

                                <!-- Formulario para poder editar los datos del usuario (obtiene los datos de la BBDD) -->
                                <form id="profileForm" action="../controller/registeredProfileController.php" method="POST">
                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Nombre:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $registered[0][0];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Contrasena Actual</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="password" name="oldPassword" placeholder="Actual Password">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Nueva Contrasena</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="password" name="newPassword" placeholder="Nueva Password">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Confirmar la Nueva Contrasena</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="password" name="confirmNewPassowrd" placeholder="Nueva Password">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">E-mail</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="email" placeholder="E-mail" value="<?php echo $registered[0][1];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Fecha de Nacimiento:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="birthdate" placeholder="YYYY-MM-DD" value="<?php echo $registered[0][2];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Cuenta PayPal:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="paypal" placeholder="PayPal Account" value="<?php echo $registered[0][3];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Imagen de Perfil:</label>
                                        <div class="col-lg-8 inputAttribute">
                                            <input class="form-control" type="file" name="profileImage">
                                        </div>
                                    </div>

                                    <button name="update" class="button-profile pull-right btn form-button">
                                        <span class="glyphicon glyphicon-floppy-open"></span>
                                        Guardar Cambios
                                    </button>

                                </form>

                                <!-- Compras del usuario -->                               
                                <div id="compras" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Mis Compras
                                </div>
                                <div class="col-lg-12" id="comprasUsuario">
                                    Lista de compras
                                </div>
                                

                                <!-- Mis Mensajes -->                                
                                <div id="mensajes" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                    Mis Mensajes
                                </div>
                                <div class="col-lg-12" id="mensajesUsuario">
                                    Lista de Mensajes
                                </div>
                                

                                <!-- Configuraci�n de la Cuenta del usuario -->
                                <div id="configuracion" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Configuracion de la Cuenta
                                </div>

                                <form id="profileFormDelete" action="../controller/registeredProfileController.php" method="POST">
                                    <div class="col-lg-12" id="configuracionUsuario">
                                        <p>Marca la siguiente casilla para indicar que quieres eliminar tu cuenta para siempre. Despues, pulsa el boton Eliminar</p>
                                        <input type="checkbox" name="deleteCheckBox">
                                    Quiero eliminar mi cuenta de usuario
                                    <button name="delete" class="btn-danger pull-right btn form-button">                                            
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Eliminar
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include("sections/footer.php"); ?>
    </body>
</html>