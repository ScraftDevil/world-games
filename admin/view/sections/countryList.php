<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	$db = unserialize($_SESSION['dbconnection']);
		$country = $db->getCountries();
		?>
			<select name="country" id="country">
			<?php
				for ($i=0; $i < count($country); $i++) {
					$id = $country[$i][0];
					$name = utf8_encode($country[$i][1]);
					echo "<option value=\"$id\">$name</option>";
				}
			?>
			</select>
		<?php
?>