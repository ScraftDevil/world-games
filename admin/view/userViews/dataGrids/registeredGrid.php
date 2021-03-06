<?php
	require_once 'Structures/DataGrid.php';
	function showUsers() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$registered = $db->getRegisteredUsers($order);
		$dg = new Structures_DataGrid();
		$dg->bind($registered, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Usuario', 'ID_Registered', 'ID_Registered', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Nombre<br>de Usuario', 'Username', 'Username', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Dirección de Email', 'Email', 'Email', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Tiempo<br>de Baneo', 'BannedTime', 'Banned Time', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Fecha de<br>Nacimiento', 'BirthDate', 'BirthDate', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Cuenta de PayPal', 'PaypalAccount', 'PaypalAccount', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Avatar', 'AvatarURL', 'AvatarURL', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('País', 'Country', 'Country', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Registered'];
		return "
		<form action=\"userDataEditView.php\" method=\"POST\">
		  	<button class=\"btn btn-danger\" type=\"submit\" name=\"user\" value=\"$id\" title=\"Modificar\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button><button class=\"btn btn-danger\" type=\"button\" onclick=\"deleteUser($id)\" title=\"Borrar\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
		</form>";
	}

?>