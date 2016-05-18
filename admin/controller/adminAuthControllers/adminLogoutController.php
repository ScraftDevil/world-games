<?php
    if (session_id() == '') {
        session_start();
    }

    if (isset($_POST['logout'])) {
        $_SESSION['adminAuth'] = false;
        if (session_destroy()) {
        	header("Location: ../../index.php");
        } else {
        	echo "Fallo en login!";
        }
    }
?>