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
		<form action=\"editPlatformView.php\" method=\"POST\">
		  	<button class=\"btn btn-danger\" type=\"submit\" name=\"platform\" value=\"$id\" title=\"Modificar\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button><button class=\"btn btn-danger\" type=\"button\" onclick=\"deletePlatform($id)\" title=\"Borrar\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
		</form>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Platform'];
		return utf8_encode($fieldData);
	}

	
?>