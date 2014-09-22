<?php
    require_once("ArticleBase.php");
    class Article extends ArticleBase {
        /**
         * Gets the last 10 articles
         * @return Article[] - The last 10 articles that were viewed
         */
        public static function getLastTenArticles() {
            $Article = new Article();
            $query = 'SELECT * FROM Article ORDER BY ID DESC LIMIT 10';
            $result = $Article->getAll($query);
            foreach ($result as $entry => $value) {
                $items[] = Article::fillArticleModel($value);
            }
            return $items;
        }
    }
?>