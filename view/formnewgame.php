
<?php
session_start();
include("../controller/controlerselectoffer.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


    <form action="../controller/controlerinsergame.php" name="alta" method="post">
        <p>Titulo juego: <input type="text" name="title"/> </p>

    </p>
    <p>Stock juego:<input type="text" name="stock"/></p>

    <p>Oferta:<input type="text" name="offer"/></p>

    <p>Precio:<input type="text" name="precio"/></p>
      

    <p>Plataforma juego: <input type="text" name="plataform"/> </p>

    <p>Genero juego:
        <select name="genre" multiple>
            <?php
            showgenre();
            ?>
        </select>
    </p>
    <p>
        <input type="submit" name ="add" value="Añadir juego" >
    </p>			
</form>

</body>

</html>