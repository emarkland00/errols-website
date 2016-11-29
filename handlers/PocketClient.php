<?php
    require_once("config.php");
    require_once("PocketResponse.php");
    require_once("PocketRequest.php");

    class PocketClient
    {
        private $consumerKey;
        private $accessToken;
        private $baseURL;

        function __construct() {
            $creds = Config::getPocket();

            $this->consumerKey = $creds["CONSUMER_KEY"];
            $this->accessToken = $creds["ACCESS_TOKEN"];
            $this->baseURL = $creds["BASE_URL"];
        }

        public function getArticles() {
            $r = new PocketRequest($this->consumerKey, $this->accessToken, $this->baseURL);

            // apply filters
            $r->detailType = "simple";
            $r->tag = "tracker";
            $r->count= 3

            $request = $r->createRequest();
            if (!($result = curl_exec($request))) {
               trigger_error(curl_error($request));
               exit();
           }

           // parse the token
           $response = PocketResponse::parsePocketResponse($result);
           return $response;
        }
    }
?>
