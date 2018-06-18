<?php

namespace Models;

abstract class AbstractParseProvider
{
    protected $SHD;

    public function __construct($url)
    {
        $this->SHD = new \simple_html_dom();
        $this->SHD->load_file($url);
    }

}
