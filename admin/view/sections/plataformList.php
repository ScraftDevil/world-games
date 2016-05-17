<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	$db = unserialize($_SESSION['dbconnection']);
		$plataform = $db->getPlataform();
		?>
			<div class="dropdown">
  				<button class="btn btn-default dropdown-toggle" type="button" name="plataform" id="plataform" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $plataform[0][0]; ?>">
    				<?php echo utf8_encode($plataform[0][1]); ?>
    				<span class="caret"></span>
  				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php
					for ($i=0; $i < count($plataform); $i++) {
						$id = $plataform[$i][0];
						$name = utf8_encode($plataform[$i][1]);
						echo "<li class=\"dropdown-header\"><a value=\"$id\" href=\"#\" class=\"plataform\" onclick=\"changePlataform(this)\">$name</a></li>";
					}
				?>
				</ul>
			</div>
		<?php
?>