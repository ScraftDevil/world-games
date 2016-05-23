<?php
	require_once 'Structures/DataGrid.php';
	function showMessage() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getAllMessages($order);
		$dg = new Structures_DataGrid();
		$dg->bind($game, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID del<br>Mensaje', 'ID_Message', 'ID_Message', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Contenido<br>del Mensaje', 'Content', 'Content', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Data del mensaje', 'Date', 'Date', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Propietari del <br> missatge', 'registered', 'registered', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Receptor del  <br> missatge', 'receiver', 'receiver', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Message'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger selectGame\">Selecciona</button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\">Selecciona una opcion</span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a class=\"drop-grid\" href=\"messageDataEdit.php?id=$id\">Editar</a></span></li>
		     <li><a href=\"#\" onclick=\"deleteMessage($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Content'];
		return utf8_encode($fieldData);
	}

	/*function printP($params, $pos) {
		extract($params);
		$fieldData = $record["'".$pos."'"];
		return "<p>".utf8_encode($fieldData)."</p>";
	}*/
?>