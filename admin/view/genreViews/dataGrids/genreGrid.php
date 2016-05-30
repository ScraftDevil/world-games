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
		return "<form action=\"genreDataEditView.php\" method=\"POST\">
		  	<button class=\"btn btn-danger\" type=\"submit\" name=\"genre\" value=\"$id\" title=\"Modificar\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button><button class=\"btn btn-danger\" type=\"button\" onclick=\"deleteGenre($id)\" title=\"Borrar\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
		</form>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Genre'];
		return utf8_encode($fieldData);
	}

	
?>