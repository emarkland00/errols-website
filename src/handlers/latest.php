<?php
session_start();

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

function get_memcached() {
    if (!class_exists('Memcached')) {
        return null;
    }
    $mc = new Memcached();
    $memcachedHost = getenv("MEMCACHED_IP") ?? "127.0.0.1";
    $memcachedPort = getenv("MEMCACHED_PORT") ?? 11211;
    $mc->addServer($memcachedHost, $memcachedPort);
    return $mc;
}

function get_results($count) {
    $arr = null;
    $key = 'pocket:items';

    // pull items from cache
    $mc = get_memcached();
    if ($mc != null) {
        $arr = $mc->get($key);
    }

    if ($arr == null) {
        $client = new PocketClient();
        $arr = $client->getArticles();

        // store items in cache for a minute
        if ($mc != null) {
            $mc->set($key, $arr, time() + 60);
        }
    }
    $res = array();
    foreach ($arr as $a) {
        $host = parse_url($a->getGivenURL(), PHP_URL_HOST);
        $res[] = array(
            'title' => $a->getResolvedTitle(),
            'url' => $a->getResolvedURL(),
            'source' => $host,
            'timestamp' => $a->getTimeAdded()
        );
    }
    return json_encode($res);
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

    echo get_results($count);
} else {
    header('HTTP/1.1 400 Bad Request', true, 400);
}
?>
