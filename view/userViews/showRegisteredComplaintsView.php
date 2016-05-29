<!DOCTYPE html>
<html>

<?php
	
	include("../sections/head.php");
	require_once($_SESSION['BASE_PATH']."/model/autoload.php");
	require_once 'Structures/DataGrid.php';    

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
                            <h1>Mis Quejas</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Aquí puedes visualizar todas tus denúncias enviadas</h2>
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                    	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
	                       	<a href="registeredProfileView.php" class="button-profile pull-left btn form-button" role="button">
	                      		<i class="fa fa-arrow-left" aria-hidden="true"></i>
	                           	Vuelve al Perfil
	                       	</a>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                        	<a href="sendPrivateMessageView.php" id="newMessage" class="button-profile pull-right btn form-button" role="button">
								<span class="glyphicon glyphicon-send"></span>
                                Nuevo Mensaje
                            </a>
                        </div>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="grid col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

                        	<?php
								$shop = unserialize($_SESSION['shop']);
								$id = $_SESSION['user_id'];
								$order = "";
								
								if (isset($_GET['orderBy'])) {
									$order = $_GET['orderBy'] . " " . $_GET['direction'];
								}

								$registered = $shop->getRegisteredComplaints($id, $order);

								$dg = new Structures_DataGrid();
								$dg->bind($registered, array(), 'Array');
								$dg->renderer->sortIconASC= "&uarr;";
								$dg->renderer->sortIconDESC = "&darr;";
								$column = new Structures_DataGrid_Column('Razón', 'Reason', 'Reason', array('class'=>'grid-cel'), "null");
								$dg->addColumn($column);
								$column = new Structures_DataGrid_Column('Descripción', 'Text', 'Text', array('class'=>'grid-cel'), "null");
								$dg->addColumn($column);
								$column = new Structures_DataGrid_Column('Fecha', 'Date', 'Date', array('class'=>'grid-cel'));
								$dg->addColumn($column);
								$column = new Structures_DataGrid_Column('Estado', 'Status', 'Status', array('class'=>'grid-cel'));
								$dg->addColumn($column);
								$dg->render();
                        	?>
                    </div>

                </div>
            </section>
            <footer>
                <?php include("../sections/footer.php"); ?>
                <script type="text/javascript" src="../resources/js/userProfile.js"></script>
            </footer>
    </body>
</html>