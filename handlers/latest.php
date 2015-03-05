<?php
require_once("Article.php");

function is_valid_request() {
    // token existence
    if (!isset($_SESSION['token'])) return false;
    $tkn = $_SESSION['token'];

    // token expiration (5 min)
    if (!isset($_SESSION['token_time'])) return false;
    $time = $_SESSION['token_time'];
    if (time() - $time > 300) return false;

    // fetched token
    if (!isset($_GET['token'])) return false;
    $currentTkn = $_GET['token'];

    return $currentTkn === $tkn;
}

function clear_session() {
    unset($_SESSION['token']);
    unset($_SESSION['token_time']);
}

function get_results($count) {
    $arr = array();
    foreach (Article::getLatestArticles($count) as $article) {
        $arr[] = array(
            'title' => $article->getName(),
            'url' => $article->getUrl(),
            'source' => $article->getSource(),
            'timestamp' => $article->getTimestamp()
        );
    }
    return json_encode($arr);
}

if (is_valid_request()) {
    header('Content-type: application/json');
    echo get_results($_GET['count']);
} else {
    header('HTTP/1.1 400 Bad Request', true, 400);
}

clear_session();

?>