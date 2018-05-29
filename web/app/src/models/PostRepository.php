<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/7/18
 * Time: 2:00 AM
 */

namespace models;

require_once __DIR__ . '/../../vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

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
