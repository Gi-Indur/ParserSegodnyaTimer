<?php
require_once '../app/vendor/autoload.php';
require_once '../app/vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';
//$sql = "INSERT INTO posts (id, url) VALUES (3, 'https://getcomposer.org/doc/03-cli.md#clear-cache-clearcache-')";

//абстрактный класс с набором методов и свойств, подзываемых с каждым новым объектом класса.
//handler, который получает абстрактный класс с методами и свойствами (от неизвестного объекта класса
use Doctrine\DBAL\Query;

class DB
{
    private $config;
    private $connectionParams;
    private $conn;
    private $tableName = "pages";


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
//        $stmt = $conn->createQueryBuilder();
//        $result = $stmt->select('url')
//            ->from('articles')
//            //        ->insert('articles')
//            //        ->setValue('url', '?')
//            //        ->setValue('title', '?')
//            //        ->setValue('description', '?')
//            //        ->setValue('timeCreated', '?')
//            //        ->setValue('viewsAmount', '?')
//            //        ->setParameter(0, 'https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#configuration')
//            //        ->setParameter(1, 'title')
//            //        ->setParameter(2, 'description')
//            //        ->setParameter(3, '21-40')
//            //        ->setParameter(4, '3');
//            //    echo $stmt->getSQL();
//            ->execute()->fetchAll();
//
//    }
}

new DB();

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
Class Database
{
    private $config;

    public function getConfig()
    {
        return $this->config = new \Doctrine\DBAL\Configuration();
    }

    private $connParams = array(
        'dbname' => 'parser',
        'user' => 'root',
        'password' => 'testc',
//        'host' => '127.0.0.1',
        'host' => 'localhost',
        'port' => 8001,
        'driver' => 'pdo_mysql',
        'charset' => 'utf8'
    );

    public function getConnParams()
    {
        return $this->connParams;
    }

    private $conn;

    public function getConn()
    {
//        try{
        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->getConnParams(), $this->getConfig());
        return $this->conn;
//        }
//        catch(\Doctrine\DBAL\DBALException $exception)
//        {
//            $this->getConn()->rollback();
//        }

    }
    public function createTable($sql){
        try {
            $this->getConn()->query($sql);
        }
        catch(\Doctrine\DBAL\DBALException $exception){
            $exception->getMessage();
        }
    }
    public function doSelect($sql){
        try {
            $this->getConn()->query($sql);
//            return
        }
        catch(\Doctrine\DBAL\DBALException $exception){
            $exception->getMessage();
        }
    }
}
Class PostRepository{
//    private $url;
//    private $SHD;
//
//    public function __construct($SHD, $url, $findItem)
//    {
//        function setSHD($SHD){
//            $this->SHD = $SHD;
//    }
//        function setUrl($url){
//            $this->SHD->load_file($url);
//        }
//        function setItem($findItem){
//            $this->SHD->find($findItem);
//        }
//
//    }
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


//$database = new Database();
//$database->getConn();
//$database->doSelect("INSERT INTO posts (id, url) VALUES (3, 'https://getcomposer.org/doc/03-cli.md#clear-cache-clearcache-')");


///$database->createTable("CREATE TABLE `example` (
//        id INT(6) AUTO_INCREMENT PRIMARY KEY,
//        url VARCHAR (255) NOT NULL UNIQUE,/
//          title VARCHAR (255) NOT NULL,
////        description TEXT,
////        timeCreated TIMESTAMP,
////        viewsAmount INT (12)
//  )");