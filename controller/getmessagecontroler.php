<?php
$link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('worldgames') or die('No se pudo seleccionar la base de datos');

$id = $_POST["gameid"];
$query = "SELECT * FROM comment WHERE Game_ID = $id ";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while($fila = mysql_fetch_array($result)) {
	echo '<div class="divcomentari">';
	echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >';
	echo ' <img class ="img-responsive " src="imagenes/user.jpg">';
	echo '</div >';

	echo '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >';
	echo ' <span class="span2 span2grandaria">Escrito por Carles</span>';
	echo '<p >';
	echo ' <span class=" glyphicon glyphicon-calendar ">17/05/2016</span>';
	echo '</p >';
	echo '<span id="mensajejuego">'.$fila[2].'</span>';
	echo '</div >';
	echo '</div >';
	//echo $fila[2];
} 

 

?>