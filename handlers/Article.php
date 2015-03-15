<?php
    require_once("ArticleBase.php");
    class Article extends ArticleBase {
        /**
         * Gets the last 10 articles
         * @return Article[] The last 10 articles that were viewed
         */
        public static function getLatestArticles($count = 10) {
            $count = (is_null($count) || empty($count)) ? 10 : $count;
            $count = $count > 10 ? 10 : $count;

            $items = array();
            $article = new Article();
            $query = "SELECT * FROM " . ArticleBase::$TABLE_NAME . " ORDER BY article_id DESC LIMIT $count";
            $result = $article->getAll($query);
            foreach ($result as $entry => $value) {
                $items[] = Article::fillArticleModel($value);
            }
            return $items;
        }
    }
?>