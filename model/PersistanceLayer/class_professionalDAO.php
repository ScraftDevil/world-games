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

    public function insertProfessional($professional) {
      $proces = 0;
      try {
        $exist = 0;
        $username = $professional->getUsername();
        $email = $professional->getEmail();
        $db = unserialize($_SESSION['dbconnection']);
        $query = ("SELECT p.Username FROM professional p WHERE p.Username='$username' OR p.Email='$email' UNION SELECT a.Username FROM administrator a WHERE a.Username='$username' OR a.Email='$email' UNION SELECT r.Username FROM registered r WHERE r.Username='$username' OR r.Email='$email'");
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        $result = $resultat->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
          $query = ("INSERT INTO professional (ID_Professional, Username, Password, Email, BannedTime, BirthDate, Telephone, Shop_ID) VALUES (:id, :username, :password, :email, :bannedtime, :birthdate, :telephone, :shop_id)");
          $stmt = $db->getLink()->prepare($query);
          $stmt->bindParam(':id', $this->getLastID());
            $stmt->bindParam(':username', $professional->getUsername());
            $stmt->bindParam(':password', $professional->getPassword());
            $stmt->bindParam(':email', $professional->getEmail());
            $stmt->bindParam(':bannedtime', $professional->getBannedTime());
            $stmt->bindParam(':birthdate', $professional->getBirthDate());
            $stmt->bindParam(':telephone', $professional->getTelephone());
            $stmt->bindParam(':shop_id', $this->getShopID());
            $stmt->execute();
            $proces = 2;
        } else {
          $proces = 1;
        }
      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
        die();
      } finally {
        return $proces;
      }
    }

    public function deleteProfessionalUser($id) {

      try {
      
        $query = ("DELETE FROM professional WHERE ID_Professional = '$id'");

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
            $resultat->execute();

      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $resultat;
        $_SESSION['dbconnection'] = serialize($shopDb);     
      }

    }

    private function getLastID() {
      $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT COUNT(*) as total FROM professional");
        $stmt->execute();
        $result = $stmt->FetchAll();
        return $result[0]['total'] + 1;
    }

    private function getShopID() {
      $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Shop FROM shop WHERE Name='WorldGames'");
        $stmt->execute();
        $result = $stmt->FetchAll();
        return $result[0]['ID_Shop'];
    }


  }

?>