<?php
if (session_id() == '') {
    session_start();
}

function checkAuth() {
    $auth = false;
    if (isset($_SESSION['adminAuth'])) {
        $auth = true;
    }
    return $auth;
}
?>