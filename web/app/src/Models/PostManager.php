<?php

namespace Models;

class PostManager extends DB
{
    private $providers;
//    public function getProviders()
//    {
//        return $this->providers;
//    }


    public function __construct()
    {
        parent::__construct();

        $this->providers = [
            "segodnya" =>   new \Models\SegodnyaDataProvider("https://www.segodnya.ua/regions/odessa.html"),
            "timer" =>      new \Models\TimerDataProvider("http://timer-odessa.net/news")
        ];

    }

    public function uploadPosts()
    {
        $query = $this->getConn()->createQueryBuilder();

        foreach ( $this->providers as $provider ) {

            $query
                ->insert( $provider->getTableName() )
                ->values( $provider->getDbParams() );

            $sql_query_duplicate = $query->getSQL() . ' ON DUPLICATE KEY UPDATE `url` = VALUES(`url`) ';

            foreach ( $provider->getParamsForSQL() as $postParams )
            {
                $query->setParameters( $postParams );
                $query
                    ->getConnection()
                    ->executeUpdate( $sql_query_duplicate, $postParams, $query->getParameterTypes() );
            }
        }
    }

    public function downloadPosts()
    {
        $query = $this->getConn()->createQueryBuilder();

        foreach ( $this->providers as $provider  )
        {
            $query
                ->select('*')
                ->from( $provider->getTableName() );
            $result = $query
                ->execute()
                ->fetchAll();
            return $result;
        }
    }
}

