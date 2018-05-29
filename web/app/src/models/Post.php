<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/7/18
 * Time: 2:00 AM
 */

namespace models;

//use models\Parser;

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
