<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$db = unserialize($_SESSION['dbconnection']);
		$platform = $db->getPlatform();
		?>
			<div class="dropdown">
  				<button class="btn btn-default dropdown-toggle" type="button" name="platform" id="platform" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $platform[0][0]; ?>">
    				<?php echo utf8_encode($platform[0][1]); ?>
    				<span class="caret"></span>
  				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php
					for ($i=0; $i < count($platform); $i++) {
						$id = $platform[$i][0];
						$name = utf8_encode($platform[$i][1]);
						echo "<li class=\"dropdown-header\"><a value=\"$id\" href=\"#\" class=\"platform\" onclick=\"changePlatform(this)\">$name</a></li>";
					}
				?>
				</ul>
			</div>
		<?php
?>