<?php
	require_once '/Structures/DataGrid.php';
	function showUsers() {
		$db = unserialize($_SESSION['dbconnection']);
		$order = "";
		if (isset($_GET['orderBy'])) {
			$order = $_GET['orderBy'] . " " . $_GET['direction'];
		}
		$registered = $db->getRegisteredUsers($order);
		$dg = new Structures_DataGrid();
		$dg->bind($registered, array(), 'Array');
		//$dg->renderer->sortIconASC= "&uarr;";
		//$dg->renderer->sortIconDESC = "&darr;";
		$column = new Structures_DataGrid_Column('ID_Registered', 'ID_Registered', 'ID_Registered', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Username', 'Username', 'Username', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Password', 'Password', 'Password', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Email', 'Email', 'Email', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('Banned Time', 'BannedTime', 'Banned Time', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('BirthDate', 'BirthDate', 'BirthDate', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('PaypalAccount', 'PaypalAccount', 'PaypalAccount', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column('AvatarURL', 'AvatarURL', 'AvatarURL', array('align'=>'center'));
		$dg->addColumn($column);
		$column = new Structures_DataGrid_Column("Opciones", null, null, array('align' => 'center'), null, 'PrintOption()');
		$dg->addColumn($column);
		$dg->render();
	}

	function PrintOption($params){
		extract($params);
		$id = $record['ID_Registered'];
		return "
		<style> td a { text-decoration: none }</style>
		<a target=\"_blank\" href=\"PDF_InfoClient.php?nif=$id\">
			<i title=\"Print\" class=\"fa fa-print\"></i>
		</a>&nbsp;
		<a href=\"edit_client.php?nif=$id\">
			<i title=\"Edit\" class=\"fa fa-pencil\"></i>
		</a>
		";
	}
?>