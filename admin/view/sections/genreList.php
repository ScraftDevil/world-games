<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$db = unserialize($_SESSION['dbconnection']);
		$genre = $db->getGenre();
		?>
			<select name="genre" id="genres" class="form-control" style="width='40%;'" multiple >
  								
				<?php
					for ($i=0; $i < count($genre); $i++) {
						$id = $genre[$i][0];
						$name = utf8_encode($genre[$i][1]);
						echo "<option value=\"$id\" class=\"dropdown-header\"><a href=\"#\" class=\"genre\" >$name</a></option>";
					}
				?>
				
			</select>
		<?php
?>