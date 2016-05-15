<?php

 require_once("../model/autoload.php");
            
             function showgenre(){


                try {
                $sqlOffer = "SELECT * FROM genre ";
                $db = unserialize($_SESSION['dbconnection']);
                $peticioOffer = $db->getLink()->prepare($sqlOffer);
                $resultat = $peticioOffer->execute();
            } catch (PDOException $ex) {
                echo "An Error occured!";
                some_logging_function($ex->getMessage());
            }


            while ($row = $peticioOffer->fetch(PDO::FETCH_ASSOC)) {    
             

                 echo "<option value=" . $row['ID_Genre'] . ">" . $row['Name'] . "</option>"; 
            }
            }


            ?>