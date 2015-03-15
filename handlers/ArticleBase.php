<?php
require_once("MySQLAbstract.php");
class ArticleBase extends MySQLAbstract {
    protected static $TABLE_NAME = "Article";
    private $_existsInDB;
    public function __construct() {
        $this->_existsInDB = false;
        $this->_modelChanged = false;
    }

    private $_ArticleID;
    public function getArticleID() {
        return $this->_ArticleID;
    }

    public static function findByArticleID($ArticleIDValue) {
        if ($ArticleIDValue == NULL) {
            die('ArticleIDValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `article_id` = :val';
        $result = $Article->getOne($query, array(
            ':val' => array($ArticleIDValue, PDO::PARAM_INT),
        ));
        return Article::fillArticleModel($result);
    }

    private $_Article_key;
    public function getArticle_key() {
        return $this->_Article_key;
    }

    public function setArticle_key($Article_keyValue) {
        if ($Article_keyValue == NULL) {
            die('Article_keyValue can not be null');
        }
        if ($this->_Article_key === $Article_keyValue) return;
        $this->_Article_key = $Article_keyValue;
        $this->_modelChanged = true;
    }

    public static function findAllByArticle_key($Article_keyValue) {
        if ($Article_keyValue == NULL) {
            die('Article_keyValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `article_key`= :val';
        $result = $Article->getAll($query, array(
            ':val' => array($Article_keyValue, PDO::PARAM_STR),
        ));
        foreach ($result as $entry => $value) {
            $items[] = Article::fillArticleModel($value);
        }
        return $items;
    }

    private $_Name;
    public function getName() {
        return $this->_Name;
    }

    public function setName($NameValue) {
        if ($NameValue == NULL) {
            die('NameValue can not be null');
        }
        if ($this->_Name === $NameValue) return;
        $this->_Name = $NameValue;
        $this->_modelChanged = true;
    }

    public static function findAllByName($NameValue) {
        if ($NameValue == NULL) {
            die('NameValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `name`= :val';
        $result = $Article->getAll($query, array(
            ':val' => array($NameValue, PDO::PARAM_STR),
        ));
        foreach ($result as $entry => $value) {
            $items[] = Article::fillArticleModel($value);
        }
        return $items;
    }

    private $_Source;
    public function getSource() {
        return $this->_Source;
    }

    public function setSource($SourceValue) {
        if ($SourceValue == NULL) {
            die('SourceValue can not be null');
        }
        if ($this->_Source === $SourceValue) return;
        $this->_Source = $SourceValue;
        $this->_modelChanged = true;
    }

    public static function findAllBySource($SourceValue) {
        if ($SourceValue == NULL) {
            die('SourceValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `source`= :val';
        $result = $Article->getAll($query, array(
            ':val' => array($SourceValue, PDO::PARAM_STR),
        ));
        foreach ($result as $entry => $value) {
            $items[] = Article::fillArticleModel($value);
        }
        return $items;
    }

    private $_Timestamp;
    public function getTimestamp() {
        return $this->_Timestamp;
    }

    public function setTimestamp($TimestampValue) {
        if ($TimestampValue == NULL) {
            die('TimestampValue can not be null');
        }
        if ($this->_Timestamp === $TimestampValue) return;
        $this->_Timestamp = $TimestampValue;
        $this->_modelChanged = true;
    }

    public static function findAllByTimestamp($TimestampValue) {
        if ($TimestampValue == NULL) {
            die('TimestampValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `timestamp`= :val';
        $result = $Article->getAll($query, array(
            ':val' => array($TimestampValue, PDO::PARAM_STR),
        ));
        foreach ($result as $entry => $value) {
            $items[] = Article::fillArticleModel($value);
        }
        return $items;
    }

    private $_Url;
    public function getUrl() {
        return $this->_Url;
    }

    public function setUrl($UrlValue) {
        if ($UrlValue == NULL) {
            die('UrlValue can not be null');
        }
        if ($this->_Url === $UrlValue) return;
        $this->_Url = $UrlValue;
        $this->_modelChanged = true;
    }

    public static function findAllByUrl($UrlValue) {
        if ($UrlValue == NULL) {
            die('UrlValue can not be null');
        }
        $Article = new Article();
        $query = 'SELECT * FROM $TABLE_NAME WHERE `url`= :val';
        $result = $Article->getAll($query, array(
            ':val' => array($UrlValue, PDO::PARAM_STR),
        ));
        foreach ($result as $entry => $value) {
            $items[] = Article::fillArticleModel($value);
        }
        return $items;
    }

    /**
     * Save Article into database
     * @return True, if saved into database. False, if otherwise.
     **/
    public function save() {
        if ($this->_existsInDB && !$this->_modelChanged) {
            return false;
        }

        $res = ($this->_existsInDB) ? $this->create() : $this->commit();
        if ($res) {
            $this->$this->_modelChanged = false;
        }
        return $res;
    }

    protected static function fillArticleModel($reader) {
        $item = new Article();
        $item->_ArticleID = $reader["article_id"];
        $item->_Article_key = $reader["article_key"];
        $item->_Name = $reader["name"];
        $item->_Source = $reader["source"];
        $item->_Timestamp = $reader["timestamp"];
        $item->_Url = $reader["url"];
        $item->_modelChanged = false;
        $item->_existsInDB = true;
        return $item;
    }

    private function create() {
        $query = "INSERT INTO " . ArticleBase::$TABLE_NAME . " (`article_id`,`article_key`,`name`,`source`,`timestamp`,`url`) VALUES (:article_id,:article_key,:name,:source,:timestamp,:url)";
        $result = $this->createBase($query, array(
            ':article_id' => array($this->_ArticleID, PDO::PARAM_INT),
            ':article_key' => array($this->_Article_key, PDO::PARAM_STR),
            ':name' => array($this->_Name, PDO::PARAM_STR),
            ':source' => array($this->_Source, PDO::PARAM_STR),
            ':timestamp' => array($this->_Timestamp, PDO::PARAM_STR),
            ':url' => array($this->_Url, PDO::PARAM_STR)
        ));
        $this->_existsInDB = ($result === null || $result === -1);
        return $this->_existsInDB;
    }

    private function commit() {
        $query = "UPDATE " . ArticleBase::$TABLE_NAME . " SET `article_key`=:article_key,`name`=:name,`source`=:source,`timestamp`=:timestamp,`url`=:url WHERE `article_id`=:article_id";
        $result = $this->process($query, array(
            ':article_id' => array($this->_ArticleID, PDO::PARAM_INT),
            ':article_key' => array($this->_Article_key, PDO::PARAM_STR),
            ':name' => array($this->_Name, PDO::PARAM_STR),
            ':source' => array($this->_Source, PDO::PARAM_STR),
            ':timestamp' => array($this->_Timestamp, PDO::PARAM_STR),
            ':url' => array($this->_Url, PDO::PARAM_STR),
        ));
        return $result == null;
    }

    private $_modelChanged = false;
    protected function modelChanged() {
        return $this->_modelChanged;
    }
}
?>