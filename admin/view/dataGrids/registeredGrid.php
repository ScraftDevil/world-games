<?php
	require_once '/Structures/DataGrid.php';
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
		$column = new Structures_DataGrid_Column('País', 'Country', 'Country', array('class'=>'grid-cel'), null, 'PrintUTF8()');
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Registered'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger\"><a class=\"drop-grid\" href=\"userDataView.php?id=$id\">Ver</a></button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\"><a class=\"drop-grid\" href=\"registeredDataView.php?id=$id\">Ver</a></span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a href=\"registeredDataEdit.php?id=$id\">Modificar</a></li>
		    <li><a href=\"registeredDelete.php?id=$id\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Country'];
		return utf8_encode($fieldData);
	}

	function printP($params, $pos) {
		extract($params);
		$fieldData = $record["'".$pos."'"];
		return "<p>".utf8_encode($fieldData)."</p>";
	}
?>