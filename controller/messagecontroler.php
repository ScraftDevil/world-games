<?php
$link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('worldgames') or die('No se pudo seleccionar la base de datos');

$comentari = $_POST["comentari"];
$id = $_POST["gameid"];

$query = "INSERT INTO comment VALUES ('','$id','$comentari')";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

return $result;
/*$comentari = $_POST["comentari"];
$query = "insert into comment values('', '" . 1 . "', '" . $comentari . "')";

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();

        return $resultat;

?>