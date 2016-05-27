<?php
	require_once 'Structures/DataGrid.php';
	function showPlatform() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getPlatform($order);
		$dg = new Structures_DataGrid();
		$dg->bind($game, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Plataforma', 'ID_Platform', 'ID_Platform', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Nombre<br>de la Plataforma', 'Name', 'Name', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Platform'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger selectPlatform\">Selecciona</button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\">Selecciona una opcion</span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a class=\"drop-grid\" href=\"platformDataEdit.php?id=$id\">Editar</a></span></li>
		     <li><a href=\"#\" onclick=\"deletePlatform($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Platform'];
		return utf8_encode($fieldData);
	}

	
?>