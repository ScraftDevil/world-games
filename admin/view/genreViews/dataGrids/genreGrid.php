<?php
	require_once 'Structures/DataGrid.php';
	function showGenre() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getGenre($order);
		$dg = new Structures_DataGrid();
		$dg->bind($game, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Genero', 'ID_Genre', 'ID_Genre', array('class'=>'grid-cel'), "null");
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Nombre<br>del Genero', 'Name', 'Name', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Genre'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger selectGenre\">Selecciona</button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\">Selecciona una opcion</span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a class=\"drop-grid\" href=\"genreDataEdit.php?id=$id\">Editar</a></span></li>
		     <li><a href=\"#\" onclick=\"deleteGenre($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Genre'];
		return utf8_encode($fieldData);
	}

	
?>