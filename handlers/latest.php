<?php
session_start();

require_once("Article.php");
require_once("PocketClient.php");

function is_valid_request() {
    // token existence
    if (!isset($_SESSION['token'])) {
      //  echo "Missing token on server";
        return false;
    }
    $token = $_SESSION['token'];

    if (!isset($_SESSION['token_time'])) {
        echo "Missing token to check expiration";
        return false;
    }
    $time = $_SESSION['token_time'];
    if (time() - $time > 30) {
        echo "Missing token (it's expired)";
        return false;
    }

    // fetched token
    if (!isset($_COOKIE['sc'])) {
        return false;
    }

    $cookieToken = $_COOKIE['sc'];
    $computedVal = md5($token ^ $time);

    clear_session();
    return $cookieToken === $computedVal;
}

function clear_session() {
    unset($_SESSION['token']);
    unset($_SESSION['token_time']);

    // remove cookie
    unset($_COOKIE['sc']);
    setcookie('sc', null, -1, "/", true, true);
}

function get_results($count) {
    $client = new PocketClient();
    $arr = $client=>getArticles();
    print_r($arr);
    return json_encode($arr);
}

if (is_valid_request()) {
    $count = 0;
    if (isset($_POST['count'])) {
        $count = (int)$_POST['count'];
        if ($count > 10) {
            $count = 10;
        } else if ($count < 0) {
            $count = 0;
        }
    }

    header('Content-type: application/json');
    echo get_results($count);
} else {
    header('HTTP/1.1 400 Bad Request', true, 400);
}
?>
