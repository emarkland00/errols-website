<?php
    class PocketResponse {
        private $json;

        private function __construct($json) {
            $this->json = $json;
        }

        public function getItemID() {
            return $this->getProperty("item_id");
        }

        public function getResolvedID() {
            return $this->getProperty("resolved_id");
        }

        public function getGivenURL() {
            return $this->getProperty("given_url");
        }

        public function getResolvedURL() {
            return $this->getProperty("resolved_url");
        }

        public function getGivenTitle() {
            return $this->getProperty("given_title");
        }

        public function getResolvedTitle() {
            return $this->getProperty("resolved_title");
        }

        public function isFavorite() {
            return $this->getProperty("favorite") == 1;
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
            return $this->getProperty("excerpt");
        }

        public function isArticle() {
            return $this->getProperty("is_article") == 1;
        }

        public function containsImages() {
            return $this->getProperty("has_image") > 0;
        }

        public function containsVideos() {
            return $this->getProperty("has_video") > 0;
        }

        public function getWordCount() {
            return $this->getProperty("word_count");
        }

        public function getTags() {
            return $this->getProperty("tags");
        }

        public function getAuthors() {
            return $this->getProperty("authors");
        }

        public function getTimeAdded() {
            return $this->getProperty("time_added");
        }

        public function getTimeUpdated() {
            return $this->getProperty("time_updated");
        }

        public function getTimeRead() {
            return $this->getProperty("time_read");
        }

        public function getTimeFavorited() {
            return $this->getProperty("time_favorited");
        }

        public function getImages() {
            $json = $this->getProperty("images");
            if ($json == null) return array();
            return PocketResponseImage::createPocketResponseImages($json);
        }

        public function getVideos() {
            $json = $this->getProperty("videos");
            if ($json == null) return array();
            return PocketResponseVideo::createPocketResponseVideos($json);
        }

        private function getProperty($name) {
            return $this->json[$name];
        }

        public static function parsePocketResponse($rawString) {
            $json = json_decode($rawString, true);
            $arr = array();
            foreach ($json["list"] as $key => $value) {
                $arr[] = new PocketResponse($value);
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
            return $this->json[$key];
        }

        public static function createPocketResponseImages($json) {
            $results = array();
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
            return $this->json[$key];
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
