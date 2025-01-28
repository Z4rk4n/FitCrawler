<?php

function getHtmlFromUrl($url) {
    // Initialiser cURL
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
    curl_setopt($ch, CURLOPT_ENCODING, '');
    
    $html = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo "Erreur cURL : " . curl_error($ch);
    }

    curl_close($ch);
    
    return $html;
}

function downloadGif($url, $destination) {
    // Initialiser cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourner le contenu du fichier
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Suivre les redirections
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Vérifier le certificat SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);    // Vérifier l'hôte SSL

    // Exécuter la requête
    $data = curl_exec($ch);

    // Vérifier les erreurs cURL
    if (curl_errno($ch)) {
        die("Erreur lors du téléchargement : " . curl_error($ch));
    }

    curl_close($ch);

    file_put_contents($destination, $data);
}