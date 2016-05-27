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
			$imgURL = "../resources/images/avatars/default.png";
		}

		?>

		<img class ="img-responsive " src="<?php echo $imgURL ?>">
		</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
			<span class="span2 nomusuari span2grandaria">Escrito por <?php echo $list[$i]['Usuario'] ?> </span>
			<p>
				<span class=" glyphicon glyphicon-calendar margin-left "><?php echo $list[$i]['Date'] ?> </span>
				<span class=" glyphicon glyphicon-exclamation-sign "><a class="linkreport" href="../view/formNew">REPORT</a></span>
				<span class=" glyphicon glyphicon-exclamation-sign">

					<a class="linkmessage" href="../userViews/sendPrivateMessageView.php?receiverName=<?php echo $list[$i]['Usuario'];?>">ENVIAR MENSAJE</a></span> 
			</p>
			<span id="comentariojuego"> <?php echo $list[$i]['Text'] ?> </span>
				</div>
				</div>
		<?php
	}
}
?>