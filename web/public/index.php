<?php
require_once '../app/vendor/autoload.php';
require_once '../app/vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';
//$sql = "INSERT INTO posts (id, url) VALUES (3, 'https://getcomposer.org/doc/03-cli.md#clear-cache-clearcache-')";

//абстрактный класс с набором методов и свойств, подзываемых с каждым новым объектом класса.
//handler, который получает абстрактный класс с методами и свойствами (от неизвестного объекта класса

use Doctrine\DBAL\Query;

class DB
{
    public $config;
    public $connectionParams;
    public $conn;
    private $tableName = "";


    public function __construct()
    {
        try {
            $this->config = new \Doctrine\DBAL\Configuration();
            $this->connectionParams = array(
                'dbname' => 'parser',
                'user' => 'root',
                'password' => 'root',
                'host' => 'mysql',
                'port' => '3306',
                'driver' => 'pdo_mysql',
                'charset' => 'utf8'
            );
            $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->connectionParams, $this->config);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $e->getMessage();
        }
    }
    public function setTableName($tableName){
        $this->tableName = $tableName;

    }
    public function getTableName(){
    return $this->tableName;
}
}
class Article extends DB{


    public $stmt;
    private $select = "";
    private $insert = "";

    public function setSelect($select){
        $this->select = $select;
    }
    public function getSelect(){
        return $this->select;
    }
    public function setInsert($insert){
        $this->insert = $insert;
    }
    public function getInsert(){
        return $this->insert;
    }
    private $where = "";
    public function setWhere($where){
        $this->where = $where;
    }
    public function getWhere(){
        return $this->where;
    }
    private $limit = "";
    public function setLimit($limit){
        $this->limit = $limit;
    }
    public function getLimit(){
        return $this->limit;
    }

    private $values = array();
    public function setValues($values){
        $this->values = $values;
    }
    public function getValues(){
        return $this->values;
    }

    public function __construct()
    {
        parent::__construct();
//        $this->tableName = $tableName;
//        $this->where = $where;
//        $this->select = $select;
//        $this->limit = $limit;
    }

}

$db = new DB();
$db->setTableName("articles");
$article = new Article();

abstract Class Parser{

    protected $htmLINK;
    protected $htmlTITLE;
    protected $htmlDESCRIPTION;
    protected $htmlVIEWS;
    protected $htmlTIME;

    protected $link;
    protected $title;
    protected $description;
    protected $views;
    protected $timeCreated;
    protected $article = [];

    abstract public function setHtmlLINK($htmlLINK);
    abstract public function getHtmlLINK();
    abstract public function setHtmlTITLE($htmlTITLE);
    abstract public function getHtmlTITLE();
    abstract public function setHtmlDESCRIPTION($htmlDESCRIPTION);
    abstract public function getHtmlDESCRIPTION();
    abstract public function setHtmlVIEWS($htmlVIEWS);
    abstract public function getHtmlVIEWS();
    abstract public function setHtmlTIME($htmlTIME);
    abstract public function getHtmlTIME();

    abstract public function setLink($link);
    abstract public function getLink();
    abstract public function setTitle($title);
    abstract public function getTitle();
    abstract public function setDescription($description);
    abstract public function getDescription();
    abstract public function setViews($views);
    abstract public function getViews();
    abstract public function setTime($timeCreated);
    abstract public function getTime();
    abstract public function setArticle($article);
    abstract public function getArticle();

}
Class Post extends Parser {

    protected $htmLINK;
    protected $htmlTITLE;
    protected $htmlDESCRIPTION;
    protected $htmlVIEWS;
    protected $htmlTIME;

    protected $link;
    protected $title;
    protected $description;
    protected $views;
    protected $timeCreated;
    protected $article = [];

    private $url;
    private $findItem;
    public function setUrl($url){
        $this->url = $url;
    }
    public function findItem($findItem){
        $this->findItem = $findItem;
    }

    public function setHtmlLINK($htmlLINK){
        $this->htmLINK = $htmlLINK;
    }
    public function getHtmlLINK(){
        return $this->htmLINK;
    }
    public function setHtmlTITLE($htmlTITLE){
        $this->htmlTITLE = $htmlTITLE;
    }
    public function getHtmlTITLE(){
        return $this->htmlTITLE;
    }
    public function setHtmlDESCRIPTION($htmlDESCRIPTION)
    {
        $this->htmlDESCRIPTION = $htmlDESCRIPTION;
    }
    public function getHtmlDESCRIPTION()
    {
        return $this->htmlDESCRIPTION;
    }
    public function setHtmlVIEWS($htmlVIEWS)
    {
        $this->htmlVIEWS = $htmlVIEWS;
    }
    public function getHtmlVIEWS()
    {
        return $this->htmlVIEWS;
    }
    public function setHtmlTIME($htmlTIME){
        $this->htmlTIME = $htmlTIME;
    }
    public function getHtmlTIME(){
        return $this->htmlTIME;
    }

    public function setLink($link){
        $this->link = $link;
    }
    public function getLink(){
        return $this->link;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setViews($views)
    {
        $this->views = $views;
    }
    public function getViews()
    {
        return $this->views;
    }
    public function setTime($timeCreated){
        $this->timeCreated = $timeCreated;
    }
    public function getTime(){
        return $this->timeCreated;
    }
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }
    public function getArticle()
    {
        return $this->article;
    }
}
Class PostRepository extends Article
{
    private $articles;
    public function setArticles($articles){
        $this->articles = $articles;
    }
    public function getArticles(){
        return $this->articles;
    }

    private $posts = [];
    public function getPosts(){
        return $this->posts;
    }
    public function setPosts($url, $findItem, $htmlLINK, $htmlTITLE, $htmlDESCRIPTION, $htmlVIEWS, $htmlTIME){
        $SHD = new \simple_html_dom();
        $SHD->load_file($url);
        $this->articles = $SHD->find($findItem);
        foreach ($this->articles as $article){
            $post = new Post();
            $post->setLink($article->find($htmlLINK, 0)->href);
            $post->setTitle($article->find($htmlTITLE, 0)->innertext);
            $post->setDescription($article->find($htmlDESCRIPTION, 0)->innertext);
            $post->setTime($article->find($htmlVIEWS, 0)->innertext);
            $post->setViews($article->find($htmlTIME, 0)->innertext);
            $this->posts[] = $post;
        }
        return $this->getPosts();

    }

    public function setQueryInsert($tableName)
    {
        foreach($this->getPosts() as $queryItem) {
            $stmt = $this->conn->createQueryBuilder();
            $result = $stmt->insert($tableName)
                ->setValue('url', '?')->setParameter(0, $this->posts[0])
                ->setValue('title', '?')->setParameter(1, $this->posts[1])
                ->setValue('description', '?')->setParameter(2, $this->posts[2])
                ->setValue('timeCreated', '?')->setParameter(3, $this->posts[3])
                ->setValue('viewsAmount', '?')->setParameter(4, $this->posts[4])
                ->execute()->fetchAll();
            return $result;
        }
    }

    public function setQuerySelect($tableName, $select, $where)
    {
        $stmt = $this->conn->createQueryBuilder();
        $result = $stmt->select($select)->from($tableName)->where($where)->execute()->fetchAll();
        return $result;
    }
}

$segodnya = new PostRepository();
$segodnya->setPosts(
    'https://www.segodnya.ua/regions/odessa.html',
    'body.loaded section.rubric-page div.container div.rubric-wrapper div.rubric-content div.main-content div.content-blocks div.news-block-wrapper',
    "div.overflow-wrap a",
    "div.overflow-wrap a div.description h3",
    'div.overflow-wrap a div.description p',
    'div.overflow-wrap a div.description div.date-views-wrap span.date',
    'div.overflow-wrap a div.description div.date-views-wrap span.views acronym'
);
$segodnya->getPosts();
echo "<pre>";
var_dump($segodnya->getPosts());
echo "</pre>";

$timer = new PostRepository();
$timer->setPosts(
    'http://timer-odessa.net/news',
    'body center div.field section.clearfix div.c468 div article.clearfix',
    'h3 a',
    'h3',
    'p a',
    'span.comments',
    'time.small'
);
echo "<pre>";
var_dump($timer->getPosts());
echo "</pre>";
$segodnya->setQueryInsert('segodnyaArticles');
$segodnya->setQueryInsert('segodnyaArticles');
$segodnya->setQuerySelect('timerArticles', "*", "id>10");
$segodnya->setQuerySelect('timerArticles', "*", "id>10");




//function pdoMultiInsert($articles, $conn)
//{
//    $articles;
//    global $conn;
//    $rowsSQL = array();
//    $toBind = array();
//    $columnNames = array_keys($articles[0]);
//    foreach ($articles as $arrayIndex => $row) {
//        $params = array();
//        foreach ($row as $columnName => $columnValue) {
//            $param = ":" . $columnName . $arrayIndex;
//            $params[] = $param;
//            $toBind[$param] = $columnValue;
//        }
//        $rowsSQL[] = "(" . implode(", ", $params) . ")";
//    }
//
//    /**
//     * DUPLICATE - если поле `url` выдает ошибку, что эти данные уже есть в таблице, мы даем команду UPDATE (обновить их)
//     */
//    $sql = "INSERT INTO `articles` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL) . " ON DUPLICATE KEY UPDATE `url` = VALUES(`url`) ";
////    die(var_dump($sql));
//    $pdoStatement = $conn->prepare($sql);
//    foreach ($toBind as $param => $val) {
//        $pdoStatement->bindValue($param, $val);
//    }
//    return $pdoStatement->execute();
//}