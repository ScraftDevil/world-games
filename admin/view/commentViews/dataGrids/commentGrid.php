<?php
	require_once 'Structures/DataGrid.php';
	function showComment() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getAllComment($order);
		$dg = new Structures_DataGrid();
		$dg->bind($game, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Comentario', 'ID_Comment', 'ID_Comment', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Texto<br>del Comentario', 'Text', 'Text', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Fecha del Comentario', 'Date', 'Date', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Dueño responsable', 'Userowner', 'Userowner', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Juego <br> destinado', 'Titlegame', 'Titlegame', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Comment'];
		return "
		<div class=\"btn-group\">
		  <a href=\"#\" onclick=\"deleteComment($id)\"  class=\"btn btn-danger \">Eliminar</a>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Text'];
		return utf8_encode($fieldData);
	}

	/*function printP($params, $pos) {
		extract($params);
		$fieldData = $record["'".$pos."'"];
		return "<p>".utf8_encode($fieldData)."</p>";
	}*/
?>