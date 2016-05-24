<?php
	require_once 'Structures/DataGrid.php';
	function showReports() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$id = $_SESSION['userid'];
		$group = $_SESSION['usertype'];
		if ($group == "Administrator") {
			$reports = $db->getAdministratorReports($id, $order);
		} else if ($group == "Professional") {
			$reports = $db->getProfessionalReports($id, $order);
		}
		$dg = new Structures_DataGrid();
		$dg->bind($reports, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Queja', 'ID_Report', 'ID_Report', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Estado', 'Status', 'Status', array('class'=>'grid-cel'), null, 'PrintStatus()');
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Fecha', 'Date', 'Date', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Razón', 'Reason', 'Reason', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Usuario<br>Denunciado', 'User', 'User', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Report'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></span>
		  </button>
		  <ul class=\"dropdown-menu\">
		  	<li><a href=\"reportView.php?id=$id\">Ver</a></li>
		    <li><a href=\"#\" onclick=\"deleteUser($id)\">Eliminar</a></li>
		  </ul>
		</div>";
	}

	function PrintUTF8($params){
		extract($params);
		$fieldData = $record['Country'];
		return utf8_encode($fieldData);
	}

	function PrintStatus($params){
		extract($params);
		$fieldData = $record['Status'];
		$fieldData = utf8_encode($fieldData);
		switch($fieldData) {
			case "No leído":
				$fieldData = "<p class=\"noRead\">".$fieldData."</p>";
			break;

			case "Leído":
				$fieldData = "<p class=\"read\">".$fieldData."</p>";
			break;

			case "Denegado":
				$fieldData = "<p class=\"deny\">".$fieldData."</p>";
			break;

			case "Aceptado":
				$fieldData = "<p class=\"accept\">".$fieldData."</p>";
			break;
		}
		return $fieldData;
	}


?>