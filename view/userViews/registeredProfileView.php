<!DOCTYPE html>
<html>

<?php
/* codigo php */

include("../sections/head.php");

    // controladores del perfil de usuario registrado
    include("../../controller/profileControllers/getRegisteredInfoController.php");

    if (!isset($_SESSION['user_id'])) {
        redirect('<div class="message-redirect">¡No has hecho login. No puedes acceder a esa pagina!</div>', '/world-games/view/mainViews/home.php');
    }

    //array que contiene los datos del usuario segun el id obtenido después de hacer login
    $registered = getRegisteredInfo($_SESSION['user_id']);

//Objeto usuario con los datos de la base de datos obtenidos a partir del id del usuario tras hacer login
    $registeredObject = createObjectRegistered($registered);

    $_SESSION['registered'] = serialize($registeredObject);
    ?>    

    <body>
        <div id="page" class="page">
            <?php include("../sections/nav.php"); ?>
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
                            <h2>Saludos <?php echo $registeredObject->getUsername(); ?>, este es tu espacio personal</h2>
                        </div>
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

                                <!-- Mensaje de Error de que no se puede actualizar por falta de datos o datos incorrectos 
                                o de que se han actualizado corretamente -->
                                <div id="general-error"></div>

                                <!-- Formulario para poder editar los datos del usuario (obtiene los datos de la BBDD) -->
                                <form id="profileForm">
                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Correo Eletrónico</label>
                                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                            <input id="email" class="form-control" type="text" name="email" placeholder="micorreo@ejemplo.com" value="<?php echo $registeredObject->getEmail(); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Fecha de Nacimiento:</label>
                                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                            <input id="calendar" id="birthdate" class="form-control" type="text" name="birthdate" placeholder="DD-MM-AAAA" value="<?php echo $registeredObject->getBirthDate(); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Cuenta PayPal:</label>
                                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                            <input id="paypal" class="form-control" type="text" name="paypal" placeholder="micorreoPayPal@ejemplo.com" value="<?php echo $registeredObject->getPaypalAccount(); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">País:</label>
                                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                            <select id="country" name="country" class="form-control ">
                                                <?php getCountriesList($registeredObject->getCountry()); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Imagen de Perfil:</label>
                                        <div class="col-lg-7">
                                        <?php
                                        $pathUploaderPHP = "../../view/sections/uploader/";
                                        $uploadText['text'] = "Subir Avatar";
                                        $uploadText['textUploadBtn'] = "Elegir imagen";
                                        $uploadText['textUploadBtnRetry'] = "Elegir otra imagen";
                                        $pathUpload = "../../resources/images/avatars/".$registeredObject->getId()."/";
                                        include("../../view/sections/uploader/showUploadView.php");
                                        ?>
                                        </div>
                                    </div>

                                    <button type="button" id="update-registered" name="update" class="button-profile pull-right btn form-button">
                                        <span class="glyphicon glyphicon-floppy-open"></span>
                                        Guardar Cambios
                                    </button>

                                </form>

                                <!-- Compras del usuario -->                               
                                <div id="shoppings" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Mis Compras
                                </div>
                                <div class="col-lg-12" id="userShoppings">
                                    Lista de compras
                                </div>


                                <!-- Mis Mensajes -->
                                <div id="messages" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                    Gestión de Mensajes Privados
                                </div>
                                <div id="messagesList" class="col-lg-offset-1 col-xs-12 col-sm-12 col-md-12 col-lg-10">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <a href="showInboxMessagesView.php" id="showInbox" class="button-profile pull-left btn form-button" role="button">
                                            <i class="fa fa-inbox" aria-hidden="true"></i>
                                            Ver mis Mensajes
                                        </a>
                                    </div>
                                    <div class="pull-right col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <a href="sendPrivateMessageView.php" id="newMessage" class="button-profile pull-right btn form-button" role="button">
                                            <span class="glyphicon glyphicon-send"></span>
                                            Nuevo Mensaje
                                        </a>
                                    </div>
                                </div>

                                <!-- Configuración de la Cuenta del usuario -->
                                <div id="configuracion" class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Configuracion de la Cuenta
                                </div>

                                <form id="profileFormDelete" action="../controller/deleteRegisteredController.php" method="POST">
                                    <div class="col-lg-12" id="configuracionUsuario">
                                        <p id="delete-confirm">Marca la siguiente casilla para indicar que quieres eliminar tu cuenta para siempre. Después, pulsa el boton Eliminar</p>
                                        <input id="checkbox" type="checkbox" name="deleteCheckBox">
                                        Quiero eliminar mi cuenta de usuario
                                        <button type="button" id="delete-registered" name="delete" class="btn-danger pull-right btn form-button">
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
            <footer>
                <?php include("../sections/footer.php"); ?>
                <script type="text/javascript" src="../resources/js/userProfile.js"></script>
            </footer>
        </body>
        </html>