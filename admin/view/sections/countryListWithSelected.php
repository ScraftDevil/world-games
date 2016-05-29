<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

		$shop = unserialize($_SESSION['shop']);
		$countries = $shop->getCountries();
		$countryname = $shop->getCountryByName($country);
		?>
			<div class="dropdown">
  				<button class="btn btn-default dropdown-toggle" type="button" name="country" id="country" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $countryname[0][0]; ?>">
    				<?php echo $countryname[0][1]; ?>
    				<span class="caret"></span>
  				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php
					for ($i=0; $i < count($countries); $i++) {
						$id = $countries[$i][0];
						$name = $countries[$i][1];
						echo "<li class=\"dropdown-header\"><a value=\"$id\" href=\"#\" class=\"country\" onclick=\"changeCountry(this)\">$name</a></li>";
					}
				?>
				</ul>
			</div>
		<?php
?>