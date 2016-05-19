<?php
	require_once '/Structures/DataGrid.php';
	function showUsers() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$registered = $db->getAdministratorUsers($order);
		$dg = new Structures_DataGrid();
		$dg->bind($registered, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Usuario', 'ID_Administrator', 'ID_Administrator', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Nombre<br>de Usuario', 'Username', 'Username', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Dirección de Email', 'Email', 'Email', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Tiempo<br>de Baneo', 'BannedTime', 'Banned Time', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Fecha de<br>Nacimiento', 'BirthDate', 'BirthDate', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Administrator'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></span>
		  </button>
		  <ul class=\"dropdown-menu\">
		  	<li><a href=\"userDataEditView.php?group=administrator&id=$id\">Modificar</a></li>
		    <li><a href=\"#\" onclick=\"deleteUser($id)\">Eliminar</a></li>
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