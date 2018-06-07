<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/7/18
 * Time: 2:00 AM
 */

namespace models;

require_once __DIR__ . '/../../vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

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
