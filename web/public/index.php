<?php
require_once '../app/vendor/autoload.php';

//абстрактный класс с набором методов и свойств, подзываемых с каждым новым объектом класса.
//handler, который получает абстрактный класс с методами и свойствами (от неизвестного объекта класса

use models\PostRepository as PostRepository;
use models\Database as Database;

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

$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'dbname' => 'parser',
    'user' => 'root',
    'password' => 'testc',
    'host' => '127.0.0.1',
    'port' => "2300",
    'driver' => 'pdo_mysql',
    'charset' => 'utf8'

);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
$sql = "INSERT INTO posts (id, url) VALUES (3, 'https://getcomposer.org/doc/03-cli.md#clear-cache-clearcache-')";

try {
    $stmt = $conn->query($sql);
}
catch(\Doctrine\DBAL\DBALException $exception){
    $exception->getMessage();
}




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