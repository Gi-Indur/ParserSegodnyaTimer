<?php

namespace Models;

class TimerDataProvider extends AbstractParseProvider implements DataProviderInterface
{
    private $posts;
    private $feed;
    private $dbParams;
    private $tableName;

    public function __construct($url)
    {
        parent::__construct($url);

        $this->tableName = 'timer';

        $this->dbParams = [
            'url' => '?',
            'title' => '?',
            'description' => '?',
            'time' => '?',
            'comment' => '?',
            'videos' => '?',
            'photos' => '?',
            'mark' => '?'
        ];
        $this->findPosts();
    }

    public function getDbParams()
    {
        return $this->dbParams;
    }
    public function getTableName()
    {
        return $this->tableName;
    }

    public function initFeed()
    {
        return $this->feed = $this->SHD->find( 'body center div.field section.clearfix div.c468 div article.clearfix' );
    }

    public function findPosts()
    {
        foreach ($this->initFeed() as $searcher)
        {
            $post = new Post();
            $postTime = $searcher->find( "time.small", 0 )->innertext;
            if      ( preg_match( '/Сегодня( |, )/',    $postTime, $matches))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ' , time()), $postTime);
            }
            else if ( preg_match( '/Вчера( |, )/',      $postTime, $matches ))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ' , time() - 86400), $postTime);
            }
            else if ( preg_match( '/Позавчера( |, )/',  $postTime, $matches ))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ',  time() - 172800 ), $postTime);
            }
            else if ( preg_match( '/(0[1-9]|[1-2][0-9]|3[0-1]) (Января|Февраля|Марта|Апреля|Мая|Июня|Июля|Августа|Сентября|Октября|Ноября|Декабря), /u' , $postTime, $matches))
            {
                $month =
                    [
                        "Января" => "01",
                        "Февраля" => "02",
                        "Марта" => "03",
                        "Апреля" => "04",
                        "Мая" => "05",
                        "Июня" => "06",
                        "Июля" => "07",
                        "Августа" => "08",
                        "Сентября" => "09",
                        "Октября" => "10",
                        "Ноября" => "11",
                        "Декабря" => "12"
                    ];
                $postTime = str_replace( $matches[0] , date('Y',  time()).'-'.$month[$matches[2]].'-'.$matches[1].' ', $postTime );
            }
            $post
                ->setLink           ( $searcher->find( "h3 a", 0 )              ->href )
                ->setTime           ( $postTime )
                ->setTitle          ( $searcher->find( "h3 a", 0 )         ->innertext )
                ->setDescription    ( $searcher->find( "p a", 0 )          ->innertext )
                ->setMark           ( $searcher->find( "a.scenario", 0 )   ->innertext )
                ->setComment        ( $searcher->find( "span.comments", 0 )->innertext )
                ->setPhotos         ( $searcher->find( "span.photos", 0 )  ->innertext )
                ->setVideos         ( $searcher->find( "span.videos", 0)   ->innertext );
            $this->posts[] = $post;
        }
    }

    public function getPosts()
    {
        return $this->posts;
    }
    public function getParamsForSQL()
    {
        $params = [];
        foreach ( $this->posts as $post )
        {
            $params[] =
            [
                0 => $post->getLink(),
                1 => $post->getTitle(),
                2 => $post->getDescription(),
                3 => $post->getTime(),
                4 => $post->getComment(),
                5 => $post->getVideos(),
                6 => $post->getPhotos(),
                7 => $post->getMark(),
            ];
        }
        return $params;
    }
}
