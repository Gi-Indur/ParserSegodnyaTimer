<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/16/18
 * Time: 4:39 PM
 */

namespace models;

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