<?php

require("vendor/autoload.php");
require("functions.php");
$url = require("url.php");

use Goutte\Client;

$client = new Client();

$exercices = [];
$json = []; // final json

// get exercices with links 
$crawler = $client->request('GET', $url);
$crawler->filter('div.letter-section ul.az-columns li a')->each(function ($node) use (&$exercices) {
    $exercices[] = [
        "name" => $node->text(),
        "url" => $node->attr("href")
    ];
});


foreach ($exercices as $exercice) {
    sleep(1000);
    $exerciceName = $exercice["name"];
    echo " -- Parsing Exercice: " . $exercice["name"] . " -- \n";
}



