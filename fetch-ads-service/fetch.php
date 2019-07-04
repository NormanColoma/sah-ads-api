<?php
$xml = file_get_contents("https://feeds.spotahome.com/mitula-UK-en.xml");
$json = json_encode(simplexml_load_string($xml));
$decoded_json = json_decode($json, TRUE);


function extractImageFromPictures($pictures) {
    if (array_key_exists('picture', $pictures)) {
        $pictures_found = array_column($pictures['picture'], 'picture_url');
        return empty($pictures_found) ? null : $pictures_found[0];
    }
    return null;
}

function createAdJsonPayload($ad) {
    return array(
        'id' => $ad['id'],
        'title' => $ad['title'],
        'link' => $ad['url'],
        'city' => $ad['city'],
        'image' =>  extractImageFromPictures($ad['pictures'])
    );
}

$ads = array_map(function ($ad) {
    return createAdJsonPayload($ad);
}, $decoded_json['ad']);


foreach ($ads as $payload) {
    $ch = curl_init('http://127.0.0.1:8000/ads');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);
}

/*$ch = curl_init('http://127.0.0.1:8000/ads');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ads[0]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_exec($ch);*/
