<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	$db = unserialize($_SESSION['dbconnection']);
		$country = $db->getCountries();
		?>
			<div class="dropdown posicionarizquierda">
  				<button class="btn btn-default dropdown-toggle" type="button" name="country" id="country" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $country[0][0]; ?>">
    				<?php echo utf8_encode($country[0][1]); ?>
    				<span class="caret"></span>
  				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php
					for ($i=0; $i < count($country); $i++) {
						$id = $country[$i][0];
						$name = utf8_encode($country[$i][1]);
						echo "<li class=\"dropdown-header\"><a value=\"$id\" class=\"country\" onclick=\"changeCountry(this)\">$name</a></li>";
					}
				?>
				</ul>
			</div>
		<?php
?>