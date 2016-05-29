<?php
	require_once 'Structures/DataGrid.php';
	function showReports() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$complaints = $db->getAllComplaints($order);
		$dg = new Structures_DataGrid();
		$dg->bind($complaints, array(), 'Array');
		$dg->renderer->sortIconASC= "&uarr;";
		$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID de<br>Denuncia', 'ID_Complaint', 'ID_Complaint', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Estado', 'Status', 'Status', array('class'=>'grid-cel'), null, 'PrintStatus()');
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Fecha', 'Date', 'Date', array('class'=>'grid-cel'), null, 'setDateFormat()');
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Razón', 'Reason', 'Reason', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Juego<br>Denunciado', 'GameComplainted', 'GameComplainted', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Plataforma', 'Platform', 'Platform', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Usuario<br>Denunciante', 'User', 'User', array('class'=>'grid-cel'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("<a href='#'>Opciones</a>", null, null, array('class'=>'grid-cel'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Complaint'];
		return "
		<div class=\"btn-group\">
		  <button type=\"button\" class=\"btn btn-danger\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></button>
		  <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    <span class=\"caret\"></span>
		    <span class=\"sr-only\"><a class=\"drop-grid\" href=\"#\">Selecciona una operación</a></span>
		  </button>
		  <ul class=\"dropdown-menu\">
		  	<li><a href=\"complaintView.php?id=$id\">Ver</a></li>
		    <li><a href=\"#\" onclick=\"deleteComplaint($id)\">Eliminar</a></li>
		  </ul>
		</div>";
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

	function setDateFormat($params) {
		extract($params);
		$fieldData = $record['Date'];
		$date = "";
		$hour = "";
		$change = false;
		for ($i=0; $i < 19; $i++) {
			if ($change == false) {
				if ($fieldData[$i] == " ") {
					$change = true;
				} else {
					if ($fieldData[$i] == "-") {
						$date = $date."/";
					} else {
						$date = $date.$fieldData[$i];
					}
				}
			} else {
				$hour = $hour.$fieldData[$i];
			}
		}
		$date = date('d-m-Y', strtotime($date));
		return $date." ".$hour;
	}


?>