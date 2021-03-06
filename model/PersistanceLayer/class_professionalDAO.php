<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

  class professionalDAO {
    
    public function login($username, $password) {
      $valid = false;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Professional FROM professional WHERE Username='$username' AND Password='".md5($password)."' LIMIT 1;");
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

    public function updateAllProfessionalUser($professional) {
        $proces = "";
        $id = $professional->getId();
        $username = $professional->getUsername();
        $email = $professional->getEmail();
        $db = unserialize($_SESSION['dbconnection']);
        try {
          // USERNAME VALIDATION IN TABLES
          if($this->usernameInUse($professional, $db, "update") == false) {
            // EMAIL VALIDATION IN TABLES
            if($this->emailInUse($professional, $db, "update") == false) {
              $password = $professional->getPassword();
              $bannedtime = $professional->getBannedTime();
              $birthdate = $professional->getBirthDate();
              $phone = $professional->getTelephone();

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

              $updateString = $updateString."BirthDate='$birthdate', ";

              if ($phone != null && $phone != "") {
                $updateString = $updateString."Telephone='$phone', ";
              } else {
                $updateString = $updateString."Telephone='', ";
              }

              $query = ("UPDATE professional SET ".$updateString." WHERE ID_Professional='$id'");
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

    public function deleteProfessionalUser($id) {
      $proces = -1;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $sql = ("SELECT ID_Professional FROM professional WHERE ID_Professional='$id'");
        $resultat = $db->getLink()->prepare($sql);
        $result = $resultat->execute();
        if ($result) {
          $query = ("DELETE FROM professional WHERE ID_Professional = '$id'");
          $resultat = $db->getLink()->prepare($query);
          $resultat->execute();
          $proces = 1;
        }
      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $proces;    
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

    /* PROFESSIONAL LIST */

    public function getAllProfessional() {
      try {
        $query = ("SELECT ID_Professional, Username, Email, BannedTime, BirthDate, Telephone FROM professional");       
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

    private function emailInUse($registered, $db, $type) {
      $use = 0;

      $email = $registered->getEmail();
      $id = $registered->getID();

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
        $query = ("SELECT ID_Professional FROM professional WHERE Email='$email' AND ID_Professional='$id'");
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

    private function usernameInUse($professional, $db, $type) {
      $use = 0;

      $username = $professional->getUsername();
      $id = $professional->getID();

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
        $query = ("SELECT ID_Professional FROM professional WHERE Username='$username' AND ID_Professional='$id'");
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

    public function getAllProfessionalInfo($id) {
      try {

        $query = ("SELECT Username, Password, Email, BannedTime, BirthDate, Telephone as Phone FROM professional where ID_Professional = '$id'");
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
          $username = $row['Username'];
          $password = $row['Password'];
          $email = $row['Email'];
          $bannedtime = $row['BannedTime'];
          $birthdate = $row['BirthDate'];
          $phone = $row['Phone'];
          $user = array('username'=> $username, 'password'=> $password, 'email'=>$email, 'bannedtime'=> $bannedtime, "birthdate"=> date('d-m-Y', strtotime($birthdate)), "phone"=> $phone);
        }
        $result = $user;

      } catch(PDOException $ex) {
        echo "An Error ocurred!";
        some_loggging_function($ex->getMessage());
      } finally {
        return $result;   
      }

    }

  }

?>