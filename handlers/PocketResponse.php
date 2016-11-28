<?php
    class PocketResponse {
        private $json;

        public function getItemID() {
            return getProperty("item_id");
        }

        public function getResolvedID() {
            return getProperty("resolved_id");
        }

        public function getGivenURL() {
            return getProperty("given_url");
        }

        public function getResolvedURL() {
            return getProperty("resolved_url");
        }

        public function getGivenTitle() {
            return getProperty("given_title");
        }

        public function getResolvedTitle() {
            return getProperty("resolved_title");
        }

        public function isFavorite() {
            return getProperty("favorite") == 1;
        }

        public function getStatus() {
            // 0 - nothing
            // 1 - is archived
            // 2 - should be deleted
            switch (getProperty("status")) {
                case 0:
                    return "nothing";
                case 1:
                    return "archived";
                case 2:
                    return "deleted";
                default:
                    return null;
            }
        }

        public function getExcerpt() {
            return getProperty("excerpt");
        }

        public function isArticle() {
            return getProperty("is_article") == 1;
        }

        public function containsImages() {
            return getProperty("has_image") > 0;
        }

        public function containsVideos() {
            return getProperty("has_video") > 0;
        }

        public function getWordCount() {
            return getProperty("word_count");
        }

        public function getTags() {
            return getProperty("tags");
        }

        public function getAuthors() {
            return getProperty("authors");
        }

        public function getImages() {
            $json = getProperty("images");
            if ($json == null) return array();
            return PocketResponseImage::createPocketResponseImages($json);
        }

        public function getVideos() {
            $json = getProperty("videos");
            if ($json == null) return array();
            return PocketResponseVideo::createPocketResponseVideos($json);
        }

        private function getProperty($name) {
            return $json[$name];
        }

        public static function parsePocketResponse($rawString) {
            $json = json_decode($rawSring);
            $arr = array();
            foreach ($json as $key => $value) {
                $p = new PocketResponse();
                $p->$json = $value;
                $arr[] = $p;
            }
            return $arr;
        }
    }

    class PocketResponseImage
    {
        private $json;

        public function getItemID() {
            return getValue("item_id");
        }

        public function getImageID() {
            return getValue("image_id");
        }

        public function getSrc() {
            return getValue("src");
        }

        public function getWidth() {
            return getValue("width");
        }

        public function getHeight() {
            return getValue("height");
        }

        public function getCredit() {
            return getValue("credit");
        }

        public function getCaption() {
            return getValue("caption");
        }

        private function getValue($key) {
            return $json[$key];
        }

        public static function createPocketResponseImages($json) {
            $results = array()
            foreach ($json as $key => $value) {
                $i = new PocketResponseImages();
                $i->$json = $value;
                $results[] = $i;
            }
            return $results;
        }
    }

    class PocketResponseVideo
    {
        private $json;

        public function getItemID() {
            return getValue("item_id");
        }

        public function getVideoID() {
            return getValue("video_id");
        }

        public function getSrc() {
            return getValue("src");
        }

        public function getWidth() {
            return getValue("width");
        }

        public function getHeight() {
            return getValue("height");
        }

        public function getType() {
            return getValue("type");
        }

        public function getVID() {
            return getValue("vid");
        }

        private function getValue($key) {
            return $json[$key];
        }

        public static function createPocketResponseVideos($json) {
            $results = array();
            foreach ($json as $key => $value) {
                $v = new PocketResponseVideo();
                $v->$json = $value;
                $results[] = $v;
            }
            return $results;
        }
    }
?>
