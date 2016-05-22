<?php
	require_once 'Structures/DataGrid.php';
	function showOfferGame($gameid) {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$game = $db->getOfferGame($gameid);
		if (!empty($game)) {
			echo '
			<script>
			document.getElementById("newOffer").setAttribute(\'disabled\', \'true\');
			document.getElementById("newOfferRef").setAttribute(\'href\', \'#\');
			</script>';
			$dg = new Structures_DataGrid();
			$dg->bind($game, array(), 'Array');
			$dg->renderer->sortIconASC= "&uarr;";
			$dg->renderer->sortIconDESC = "&darr;";
			$column = new Structures_DataGrid_Column('ID Oferta', 'ID_Offer', 'ID_Offer', array('class'=>'grid-cel'), "null");
			$dg->addColumn($column);
			$column = new Structures_DataGrid_Column('Descuento', 'Discount', 'Discount', array('class'=>'grid-cel'));
			$dg->addColumn($column);
			$column = new Structures_DataGrid_Column('Juego', 'Game', 'Game', array('class'=>'grid-cel'), null, 'PrintUTF8()');
			$dg->addColumn($column);
			$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
			$dg->addColumn($column);
			$dg->render();
		}
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Offer'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger selectGame\">Selecciona una opcion</button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\">Selecciona una opcion</span>
		  </button>
		  <ul class=\"dropdown-menu\">
		    <li><a class=\"drop-grid\" href=\"offerDataEdit.php?id=$id\">Editar</a></span></li>
		     <li><a href=\"#\" onclick=\"deleteOffer($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Game'];
		return utf8_encode($fieldData);
	}
?>