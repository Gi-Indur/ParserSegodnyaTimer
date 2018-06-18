<?php

namespace Models;

class SegodnyaDataProvider extends AbstractParseProvider implements DataProviderInterface
{
    private $posts;
    private $feed;
    private $dbParams;
    private $tableName;

    public function __construct($url)
    {
        parent::__construct($url);

        $this->tableName = 'segodnya';

        $this->dbParams = [
            'url' => '?',
            'title' => '?',
            'description' => '?',
            'views' => '?',
            'time' => '?'
        ];

        $this->findPosts();
    }


    public function getDbParams(){
        return $this->dbParams;
    }
    public function getTableName(){
        return $this->tableName;
    }

    public function initFeed()
    {
        $this->feed = $this->SHD->find('body.loaded section.rubric-page div.container div.rubric-wrapper div.rubric-content div.main-content div.content-blocks div.news-block-wrapper');
        return $this->feed;
    }

    public function findPosts()
    {
        foreach ($this->initFeed() as $searcher)
        {
            $post = new Post();
            $postTime = $searcher->find("div.overflow-wrap a div.description div.date-views-wrap span.date", 0)->innertext;
            if( preg_match( '/Сегодня( |, )/', $postTime, $matches))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ' , time()), $postTime);
            }
            else if( preg_match( '/Вчера( |, )/', $postTime, $matches ))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ' , time() - 86400), $postTime);
            }
            else if( preg_match( '/Позавчера( |, )/', $postTime, $matches ))
            {
                $postTime = str_replace($matches[0], date('Y-m-d ',  time() - 172800 ), $postTime);
            }
            else if( preg_match( '/(0[1-9]|[1-2][0-9]|3[0-1]) (Января|Февраля|Марта|Апреля|Мая|Июня|Июля|Августа|Сентября|Октября|Ноября|Декабря), /u' , $postTime, $matches))
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
                $postTime = str_replace($matches[0] , date('Y',  time()).'-'.$month[$matches[2]].'-'.$matches[1].' ', $postTime);
            }
            $post
                ->setLink           ($searcher->find("div.overflow-wrap a", 0)->href)
                ->setTitle          ($searcher->find("div.overflow-wrap a div.description h3", 0)->innertext)
                ->setTime           ($postTime)
                ->setViews          ($searcher->find("div.overflow-wrap a div.description div.date-views-wrap span.views acronym", 0)->innertext)
                ->setDescription    ($searcher->find("div.overflow-wrap a div.description p", 0)->innertext);
            $this->posts[] = $post;
        }
    }


    public function getPosts(){
        return $this->posts;
    }

    public function getParamsForSQL() {
        $params = [];
        foreach ( $this->posts as $post ){
            $params[] = [
                0 => $post->getLink(),
                1 => $post->getTitle(),
                2 => $post->getDescription(),
                3 => $post->getViews(),
                4 => $post->getTime(),
            ];
        }
        return $params;
    }
}

