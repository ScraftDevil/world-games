<?php
  
  class professionalDAO {
    
    public function login($username, $password) {
      $valid = false;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Professional FROM professional WHERE Username='$username' AND Password='$password' LIMIT 1;");
        $stmt->execute();
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
          $valid = true;
        } else {
          $valid = false;
        }
      } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      } finally {
        return $valid;
      }
    }

    public function getID($username, $password) {
      $id = null;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Professional FROM professional WHERE Username='$username' AND Password='$password' LIMIT 1;");
        $stmt->execute();
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
          $id = $userRow['ID_Administrator'];
        }
      } catch (PDOException $e) {
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
      } finally {
          return $id;
      }
    }

    public function showProfessionals($order) {

      try {
        $orderSQL = "";
        if (!empty($order)) {
          $orderSQL = "ORDER BY ".$order;
        }
        $query = ("SELECT ID_Professional, Username, Password, Email, BannedTime, BirthDate, Telephone FROM professional $orderSQL");
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        $result = $resultat->FetchAll();

      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $result;   
      }

    }
  }

?>