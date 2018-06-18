<?php

require_once '../app/vendor/autoload.php';
require_once '../app/vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

$manager = new \Models\PostManager();
$manager->uploadPosts();

echo "<pre>";
var_dump($manager->downloadPosts());
echo "</pre>";


