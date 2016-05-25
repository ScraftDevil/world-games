<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class valorationDAO {

	public function getGameValoration($id) {
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $sql = ("SELECT SUM(V.Valoration)/COUNT(*) as score FROM Valoration V INNER JOIN game_has_valoration GV WHERE GV.Valoration_ID=V.ID_Valoration AND GV.Game_ID='$id';");
        $stmt = $db->getLink()->prepare($sql);
        $stmt->execute();
        $userRow=$stmt->fetchAll();
      } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      } finally {
        return $userid;
      }
 	}

}

?>