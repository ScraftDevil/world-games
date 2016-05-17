<?php
$link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('worldgames') or die('No se pudo seleccionar la base de datos');



$rating = $_POST['rating'];


$query = 'INSERT INTO valoration VALUES ('', '.$rating.')';

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

return $result;

echo 'Gracias por emitir tu voto';
?>