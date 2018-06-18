<?php

namespace Models;

Class Post
{
    private $link;
    private $title;
    private $description;
    private $views;
    private $time;
    private $comment;
    private $videos;
    private $photos;
    private $mark;

    public function __construct()
    {
        $this->photos =     0;
        $this->videos =     0;
        $this->comment =    0;
        $this->mark =      '';
    }

    public function getLink()
    {
        return $this->link;
    }


    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getViews()
    {
        return $this->views;
    }


    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
        return $this;

    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        if ( !empty($comment) && is_numeric($comment) )
        {
            $this->comment = $comment;
        }
        return $this;
    }

    public function getVideos()
    {
        return $this->videos;
    }

    public function setVideos($videos)
    {
        if ( !empty($videos) && is_numeric($videos) )
        {
            $this->videos = $videos;
        }
        return $this;
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function setPhotos($photos)
    {
        if( !empty($photos) && is_numeric($photos) )
        {
            $this->photos = $photos;
        }
        return $this;
    }

    public function getMark()
    {
        return $this->mark;
    }

    public function setMark($mark)
    {
        if (!empty($mark) && is_string($mark) )
        {
            $this->mark = $mark;
        }
        return $this;
    }
}