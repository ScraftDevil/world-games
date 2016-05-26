<?php
function printMessages($list) {
	for($i = 0; $i < count($list); $i++) {
		echo '<div class="divcomentari">';
		echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">';
		if (!empty($list[$i]['AvatarURL'])) {
			//exist avatar = images/avatars/userid/avatarurl
			$imgURL = "../resources/images/avatars/".$list[$i]['UserID']."/".$list[$i]['AvatarURL'];
		} else {
			//default avatar = images/avatars/userid/userid.png
			$imgURL = "../resources/images/avatars/".$list[$i]['UserID']."/".$list[$i]['UserID'].".png";
		}
		if(!file_exists($_SESSION['BASE_PATH']."/view/".$imgURL)) {
			$imgURL = "../resources/images/avatars/default.png";
		}
		echo ' <img class ="img-responsive " src="'.$imgURL.'">';
		echo '</div >';

		echo '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >';
		echo ' <span class="span2 nomusuari span2grandaria">Escrito por '.$list[$i]['Usuario'].'</span>';
		echo '<p >';
		echo ' <span class=" glyphicon glyphicon-calendar margin-left ">'.$list[$i]['Date'].'</span>';
		echo ' <span class=" glyphicon glyphicon-exclamation-sign "><a class="linkreport" href="../view/formNew">REPORT</a></span>'; 
		echo ' <span class=" glyphicon glyphicon-exclamation-sign "><a class="linkmessage" href="../view/formNew">ENVIAR MENSAJE</a></span>'; 
		echo '</p >';
		echo '<span id="comentariojuego">'.$list[$i]['Text'].'</span>';
		echo '</div >';
		echo '</div >';
	}
}
?>