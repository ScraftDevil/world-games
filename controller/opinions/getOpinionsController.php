<?php
session_start();
require_once("../../model/autoload.php");
include_once("../../view/messagesViews/showMessagesView.php");
$db = unserialize($_SESSION['dbconnection']);
$gameid = $_POST["gameid"];
$sqlUser = "(SELECT R.Username FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as Usuario";
$sqlUserAvatar = "(SELECT R.AvatarURL FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as AvatarURL";
$sqlUserID = "(SELECT R.ID_Registered FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as UserID";
$sql = "SELECT C.ID_Comment, C.Game_ID, C.Text, C.Date , ".$sqlUser.", ".$sqlUserAvatar.", ".$sqlUserID." FROM comment C INNER JOIN registered_has_comment RC WHERE C.ID_Comment=RC.Comment_ID AND C.Game_ID = ".$gameid;
$stmt = $db->getLink()->prepare($sql);
$stmt->execute();
$result = $stmt->FetchAll();
printMessages($result);
?>