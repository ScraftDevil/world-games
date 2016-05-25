<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class valorationDAO {

	public function getGameValoration($id) {
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $sql = ("SELECT SUM(V.Valoration)/COUNT(*) as score FROM Valoration V INNER JOIN game_has_valoration GV WHERE GV.Valoration_ID=V.ID_Valoration AND GV.Game_ID='$id';");
        $stmt = $db->getLink()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      } finally {
        return $result;
      }
 	}

  public function userInsertValoration($userid, $gameid, $rate) {
    try {
      $db = unserialize($_SESSION['dbconnection']);
      //check if already rate this game
      $sql = ("SELECT COUNT(*) AS rates FROM game_has_valoration GV WHERE GV.Registered_ID=$userid AND GV.Game_ID=$gameid");
      $stmt = $db->getLink()->prepare($sql);
      $stmt->execute();
      $result = $stmt->FetchAll();
      $rates = $result[0]['rates'];
      if ($rates <= 0) {
        $query = ("INSERT INTO valoration VALUES('', '$rate')");
        $result = $db->getLink()->prepare($query);
        if($result->execute()) {
          $lastid = $db->getLink()->lastInsertId();
          $query = ("INSERT INTO game_has_valoration (Game_ID, Valoration_ID, Registered_ID) VALUES ($gameid, $lastid, $userid)");
          $result = $db->getLink()->prepare($query);
          if($result->execute()) {
            $status['msg'] = "RATED_OK";
          }
        } else {
          $status['msg'] = "RATED_FAIL";
        }
      } else {
        $status['msg'] = "ALREADY_RATED_GAME";
      }
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
      $status['msg'] = "RATED_FAIL";
    } finally {
      return $status;
    }
  }

}

?>