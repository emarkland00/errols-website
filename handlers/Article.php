<?php
    require_once("ArticleBase.php");
    class Article extends ArticleBase {
        /**
         * Gets the last 10 articles
         * @return Article[] The last 10 articles that were viewed
         */
        public static function getLastTenArticles() {
            $items = array();
            $article = new Article();
            $query = 'SELECT * FROM Article ORDER BY article_id DESC LIMIT 10';
            $result = $article->getAll($query);
            foreach ($result as $entry => $value) {
                $items[] = Article::fillArticleModel($value);
            }
            return $items;
        }
    }
?>