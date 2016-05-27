<?php
/**
    * This function redirects to a specified page (current page by default), but
    * passes along a message in the users SESSION.  It passes a GET var that tells
    * where that message is.  Used properly, this will avoid giving the user a
    * duplicate message on page refresh.
    *
    * @param string $message - Message to pass along via session
    * @param string[optional] $page - page to redirect to (with leading /)
    */
function redirect($message, $page=FALSE) {
    $my_get = array();
    $_GET['message'] = set_session_message($message);
    foreach ($_GET as $n=>$v) {
        $my_get[] = "{$n}={$v}";
    }
    if (count($my_get) > 0) {
        $my_get = '?'.implode('&',$my_get);
    } else {
        $my_get = '';
    }

    if (is_string($page)) {
        $location = $page;
    } else {
        $location = $_SERVER['SCRIPT_NAME'];
    }

    $http = (!isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS'])!='on')?'http':'https';

    header("Location: {$http}://{$_SERVER['HTTP_HOST']}{$location}{$my_get}");
    exit;
}

    /**
     * Set a session message
     *
     * @param string $message Message to set
     *
     * @return string - Message ID which is the $_SESSION index that holds the message
     */
    function set_session_message($message) {
        $message_id = sha1(microtime(true));
        $_SESSION[$message_id] = $message;
        return $message_id;
    }
    ?>