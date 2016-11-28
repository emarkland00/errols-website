<?php
    class PocketRequest
    {
        private $consumerKey = null;
        private $accessToken = null;
        private $baseURL = null;

        public $state = null; // string (unread, archive, all)
        public $favorite = null; // integer (0 = unfavorite items, 1 = favorite items)
        public $tag = null; // string (<tag_name> - only items with tag name, _untagged_ - only items with no tag)
        public $contentType = null; //	string (article, video, image)
        public $sort = null; // string (newest, oldest, title, site)
        public $detailType = null; // string (simple, complete)
        public $search = null; // string - Only return items whose title or url contain the search string
        public $domain = null; // string - Only return items from a particular domain
        public $since = null; // timestamp (long)	- Only return items modified since the given since unix timestamp
        public $count = null; // integer - Only return count number of items
        public $offset = null; // Used only with count; start returning from offset position of results

        private $RETRIEVE_PATH = "/get";

        function __construct($consumerKey, $accessToken, $baseURL) {
            $this->consumerKey = $consumerKey;
            $this->accessToken = $accessToken;
            $this->baseURL = $baseURL;
        }

        public function createRequest() {
            $ch = curl_init($this->baseURL . $this->RETRIEVE_PATH);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json; charset=UTF-8",
                "X-Accept: application/json"
            ));

            $arr = array(
                "consumer_key" => $this->consumerKey,
                "access_token" => $this->accessToken
            );
            $arr = $this->applyValue($arr, "state", $this->state);
            $arr = $this->applyValue($arr, "favorite", $this->favorite);
            $arr = $this->applyValue($arr, "tag", $this->tag);
            $arr = $this->applyValue($arr, "contentType", $this->contentType);
            $arr = $this->applyValue($arr, "sort", $this->sort);
            $arr = $this->applyValue($arr, "detailType", $this->detailType);
            $arr = $this->applyValue($arr, "search", $this->search);
            $arr = $this->applyValue($arr, "domain", $this->domain);
            $arr = $this->applyValue($arr, "since", $this->since);
            $arr = $this->applyValue($arr, "count", $this->count);
            $arr = $this->applyValue($arr, "offset", $this->offset);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));

            // ensure that we get server response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            return $ch;
        }

        private function applyValue($arr, $key, $value) {
            if ($value != null) {
                $arr[$key] = $value;
            }
            return $arr;
        }
    }
?>
