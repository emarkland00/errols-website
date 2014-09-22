<?php
session_start();
require_once("article.php");

function is_valid_request() {
    // token existence
    if (!isset($_SESSION['token'])) return false;
    $tkn = $_SESSION['token'];

    // token expiration (5 min)
    if (!isset($_SESSION['token_time'])) return false;
    $time = $_SESSION['token_time'];
    if (time() - $time > 300) return false;

    // fetched token
    if (!isset($_GET['tkn'])) return false;
    $currentTkn = $_GET('tkn');

    return $currentTkn === $tkn;
}

function clear_session() {
    unset($_SESSION['token']);
    unset($_SESSION['token_time']);
}

function get_results() {
    $arr = array();
    foreach (Article::getLastTenArticles() as $article) {
        $arr[] = array(
            'title' => $article->getName(),
            'url' => $article->getUrl(),
            'source' => $article->getSource(),
            'timestamp' => $article->getTimestamp()
        );
    }
    return json_encode($arr);
}

if (!is_valid_request()) {
    clear_session();
    header('HTTP/1.1 400 Bad Request', true, 400);
    return;
}

echo get_results();
?>