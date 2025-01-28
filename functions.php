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