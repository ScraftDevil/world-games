<?php
  
  class administratorDAO {
    
    public function login($username, $password) {
      $valid = false;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Administrator FROM administrator WHERE Username='$username' AND Password='".md5($password)."' LIMIT 1;");
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
        $stmt = $db->getLink()->prepare("SELECT ID_Administrator FROM administrator WHERE Username='$username' AND Password='$password' LIMIT 1;");
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

    /* Metodo para obtener todos los datos de todos los usuarios registrados */
    public function showAdministrators($order) {
      try {
        $orderSQL = "";
        if (!empty($order)) {
          $orderSQL = "ORDER BY ".$order;
        }
        $query = ("SELECT ID_Administrator, Username, Password, Email, BannedTime, BirthDate FROM Administrator $orderSQL");
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

    public function insertAdministrator($administrator) {
      $proces = 0;
      try {
        $exist = 0;
        $username = $administrator->getUsername();
        $email = $administrator->getEmail();
        $db = unserialize($_SESSION['dbconnection']);
        $query = ("SELECT p.Username FROM professional p WHERE p.Username='$username' OR p.Email='$email' UNION SELECT a.Username FROM administrator a WHERE a.Username='$username' OR a.Email='$email' UNION SELECT r.Username FROM registered r WHERE r.Username='$username' OR r.Email='$email'");
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        $result = $resultat->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
          $query = ("INSERT INTO administrator (ID_Administrator, Username, Password, Email, BannedTime, BirthDate, Shop_ID) VALUES (:id, :username, :password, :email, :bannedtime, :birthdate, :shop_id)");
          $stmt = $db->getLink()->prepare($query);
          $stmt->bindParam(':id', $this->getLastID());
            $stmt->bindParam(':username', $administrator->getUsername());
            $stmt->bindParam(':password', $administrator->getPassword());
            $stmt->bindParam(':email', $administrator->getEmail());
            $stmt->bindParam(':bannedtime', $administrator->getBannedTime());
            $stmt->bindParam(':birthdate', $administrator->getBirthDate());
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

    public function deleteAdministratorUser($id) {

      try {
      
        $query = ("DELETE FROM administrator WHERE ID_Administrator = '$id'");

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
        $stmt = $db->getLink()->prepare("SELECT COUNT(*) as total FROM administrator");
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

    /* ADMINISTRATOR LIST */

    public function getAllAdministrator() {
      try {
        $query = ("SELECT ID_Administrator, Username, Email, BannedTime, BirthDate FROM administrator");
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        $result = $resultat->FetchAll();;
      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $result;   
      }
    }

  }

?>