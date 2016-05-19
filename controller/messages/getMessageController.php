<?php
session_start();
require_once("../../model/autoload.php");
$db = unserialize($_SESSION['dbconnection']);
$gameid = $_POST["gameid"];
$sqlUser = "(SELECT R.Username FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as Usuario";
$sqlUserAvatar = "(SELECT R.AvatarURL FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as AvatarURL";
$sqlUserID = "(SELECT R.ID_Registered FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as UserID";
$sql = "SELECT C.ID_Comment, C.Game_ID, C.Text, C.Date , ".$sqlUser.", ".$sqlUserAvatar.", ".$sqlUserID." FROM comment C INNER JOIN registered_has_comment RC WHERE C.ID_Comment=RC.Comment_ID AND C.Game_ID = ".$gameid;
$stmt = $db->getLink()->prepare($sql);
$stmt->execute();
$result = $stmt->FetchAll();
for($i = 0; $i < count($result); $i++) {
    echo '<div class="divcomentari">';
	echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >';
	if (!empty($result[$i]['AvatarURL'])) {
		//exist avatar = images/avatars/userid/avatarurl
		$imgURL = "images/avatars/".$result[$i]['UserID']."/".$result[$i]['AvatarURL'];
	} else {
		//default avatar = images/avatars/userid/userid.png
		$imgURL = "images/avatars/".$result[$i]['UserID']."/".$result[$i]['UserID'].".png";
	}
	echo ' <img class ="img-responsive " src="'.$imgURL.'">';
	echo '</div >';

	echo '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >';
	echo ' <span class="span2 span2grandaria">Escrito por '.$result[$i]['Usuario'].'</span>';
	echo '<p >';
	echo ' <span class=" glyphicon glyphicon-calendar ">'.$result[$i]['Date'].'</span>';
	echo '</p >';
	echo '<span id="mensajejuego">'.$result[$i]['Text'].'</span>';
	echo '</div >';
	echo '</div >';
}
?>