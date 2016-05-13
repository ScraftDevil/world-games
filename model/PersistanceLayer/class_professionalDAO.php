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
  }

?>