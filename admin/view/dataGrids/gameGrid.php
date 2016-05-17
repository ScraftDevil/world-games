<?php
	require_once 'Structures/DataGrid.php';
	function showGames() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getGames($order);
		$dg = new Structures_DataGrid();
		$dg->bind($game, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Juego', 'ID_Game', 'ID_Game', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Titulo<br>de Juego', 'Title', 'Title', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Precio del Juego', 'Price', 'Price', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Stock juego', 'Stock', 'Stock', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('ID de <br> plataforma', 'Plataform', 'Plataform', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Game'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger\">Selecciona una opcion</button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\">Selecciona una opcion</span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a class=\"drop-grid\" href=\"registeredDataEdit.php?id=$id\">Editar</a></span></li>
		     <li><a href=\"#\" onclick=\"deleteGame($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Plataform'];
		return utf8_encode($fieldData);
	}

	function printP($params, $pos) {
		extract($params);
		$fieldData = $record["'".$pos."'"];
		return "<p>".utf8_encode($fieldData)."</p>";
	}
?>