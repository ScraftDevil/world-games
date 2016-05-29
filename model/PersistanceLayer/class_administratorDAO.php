<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

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
      $proces = "";
      try {
        $db = unserialize($_SESSION['dbconnection']);
        // USERNAME VALIDATION IN TABLES
        if($this->usernameInUse($administrator, $db, "insert") == false) {
          // EMAIL VALIDATION IN TABLES
          if($this->emailInUse($administrator, $db, "insert") == false) {
            // INSERT ALL COLUMNS IN REGISTERED TABLE
            $query = ("INSERT INTO administrator (ID_Administrator, Username, Password, Email, BannedTime, BirthDate, Shop_ID) VALUES ('', :username, :password, :email, :bannedtime, :birthdate, :shopid)");
              $stmt = $db->getLink()->prepare($query);
              $stmt->bindParam(':username', $administrator->getUsername());
              $stmt->bindParam(':password', $administrator->getPassword());
              $stmt->bindParam(':email', $administrator->getEmail());
              $stmt->bindParam(':bannedtime', $administrator->getBannedTime());
              $stmt->bindParam(':birthdate', $administrator->getBirthDate());
              $stmt->bindParam(':shopid', $this->getShopID());
              $stmt->execute();
              $proces = "success";
          } else {
            $proces = "email";
          }
        } else {
          $proces = "username";
        }
      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
        die();
      } finally {
        return $proces;
      }
    }

    public function getAllAdministratorInfo($id) {
      try {

        $query = ("SELECT Username, Password, Email, BannedTime, BirthDate FROM administrator where ID_Administrator = '$id'");
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
          $username = $row['Username'];
          $password = $row['Password'];
          $email = $row['Email'];
          $bannedtime = $row['BannedTime'];
          $birthdate = $row['BirthDate'];
          $user = array('username'=> $username, 'password'=> $password, 'email'=>$email, 'bannedtime'=> $bannedtime, "birthdate"=> date('d-m-Y', strtotime($birthdate)));
        }
        $result = $user;

      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $result;   
      }

    }

    public function updateAllAdministratorUser($administrator) {
        $proces = "";
        $id = $administrator->getId();
        $username = $administrator->getUsername();
        $email = $administrator->getEmail();
        $db = unserialize($_SESSION['dbconnection']);
        try {
          // USERNAME VALIDATION IN TABLES
          if($this->usernameInUse($administrator, $db, "update") == false) {
            // EMAIL VALIDATION IN TABLES
            if($this->emailInUse($administrator, $db, "update") == false) {
              $password = $administrator->getPassword();
              $bannedtime = $administrator->getBannedTime();
              $birthdate = $administrator->getBirthDate();

              // update string
              $updateString = "Username='$username', ";
              
              if ($password != null && $password != "") {
                $updateString = $updateString."Password='$password', ";
              }

              $updateString = $updateString."Email='$email', ";

              if ($bannedtime != null && $bannedtime != "") {
                $updateString = $updateString."BannedTime='$bannedtime', ";
              } else {
                $updateString = $updateString."BannedTime='', ";
              }

              $updateString = $updateString."BirthDate='$birthdate'";

              $query = ("UPDATE administrator SET ".$updateString." WHERE ID_Administrator='$id'");
              $stmt = $db->getLink()->prepare($query);
              $stmt->execute();
              $proces = "success";
            } else {
              $proces = "email";
            }
          } else {
            $proces = "username";
          }
        } catch(PDOException $ex) {
          echo "An Error ocurred!";
          some_loggging_function($ex->getMessage());
          $proces = "error";
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

    private function emailInUse($administrator, $db, $type) {
      $use = 0;

      $email = $administrator->getEmail();
      $id = $administrator->getID();

      // Select que comprueba si existe el email en cualquiera de las tablas de usuario
      $query = ("SELECT p.Username FROM professional p WHERE p.Email='$email' UNION SELECT a.Username FROM administrator a WHERE a.Email='$email' UNION SELECT r.Username FROM registered r WHERE r.Email='$email'");
      $resultat = $db->getLink()->prepare($query);
      $resultat->execute();
      $emailInTables = $resultat->fetch(PDO::FETCH_ASSOC);

      switch($type) {
        case "insert":
          if (!$emailInTables) {
            $use = false;
          } else {
            $use = true;
          }
        break;

        case "update":
          // Select que comprueba si el nombre de usuario es el mismo que esta usando
          $query = ("SELECT ID_Administrator FROM administrator WHERE Email='$email' AND ID_Administrator='$id'");
          $resultat = $db->getLink()->prepare($query);
          $resultat->execute();
          $thisEmail = $resultat->fetch(PDO::FETCH_ASSOC);
          // Si el nombre de usuario existe en una tabla, esta es la tabla del usuario y su ID coincide o si el nombre de usuario no existe en ninguna tabla devuelve un 0 porque puede usarlo, en caso contrario devuelve un 1 denegando la operacion.
          if (!$emailInTables) {
            $use = false;
          } else {
            if (!$thisEmail) {
              $use = true;
            } else {
              $use = false;
            }
          }
        break;
      }

      return $use;
    }

    private function usernameInUse($administrator, $db, $type) {
      $use = 0;

      $username = $administrator->getUsername();
      $id = $administrator->getID();

      // Select que comprueba si existe el nombre de usuario en cualquiera de las tablas de usuario
      $query = ("SELECT p.Username FROM professional p WHERE p.Username='$username' UNION SELECT a.Username FROM administrator a WHERE a.Username='$username' UNION SELECT r.Username FROM registered r WHERE r.Username='$username'");
      $resultat = $db->getLink()->prepare($query);
      $resultat->execute();
      $usernameInTables = $resultat->fetch(PDO::FETCH_ASSOC);

      switch($type) {
        case "insert":
          if (!$usernameInTables) {
            $use = false;
          } else {
            $use = true;
          }
        break;

        case "update":
          // Select que comprueba si el nombre de usuario es el mismo que esta usando
          $query = ("SELECT ID_Administrator FROM administrator WHERE Username='$username' AND ID_Administrator='$id'");
          $resultat = $db->getLink()->prepare($query);
          $resultat->execute();
          $thisUsername = $resultat->fetch(PDO::FETCH_ASSOC);
          // Si el nombre de usuario existe en una tabla, esta es la tabla del usuario y su ID coincide o si el nombre de usuario no existe en ninguna tabla devuelve un 0 porque puede usarlo, en caso contrario devuelve un 1 denegando la operacion.
          if (!$usernameInTables) {
            $use = false;
          } else {
            if (!$thisUsername) {
              $use = true;
            } else {
              $use = false;
            }
          }
        break;
      }

      return $use;
    }

}

?>