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
        "link" => $node->attr("href"),
        "gif-links" => [],
        "description" => ""
    ];
});

foreach ($exercices as $key => $exercice) {
    sleep(0.5);
    echo " -- Parsing Exercice: " . $exercice["name"] . " -- \n";

    // load page
    $crawler = $client->request('GET', $exercice["link"]);
    
    // gif
    $crawler->filter("div.post-main section.entry-content div.wp-block-image figure img")->each(function ($node) use (&$exercices, $key) {
        // downloadGif($node->attr("src"))
        $gifLink = $node->attr('src');
        if (preg_match("/(?<=\/)([a-zA-Z0-9-]+)\.gif$/", $gifLink, $matches)) {
            $exercices[$key]["gif-links"]["link"] = $gifLink;
            $exercices[$key]["gif-links"]["name"] = $matches[0];
        }
    });

    // textes
    $description = "";
    $crawler->filter("main#main article.type-post div.post-wrap div.post-main p")->each(function ($node) use (&$description) {
        $description .= $node->text() . "\n\n";
    });
    $exercices[$key]["description"] = trim(str_replace("Ne manquez aucun article ou étude publiés ! Suivre nos articles sur Google News", "", $description));

    print_r($exercices[$key]);
}



