<?php
/**
 * Created by PhpStorm.
 * User: Roger-PC
 * Date: 29-Jan-19
 * Time: 13:18
 */

function getFeed($feed_url) {

    $rss = simplexml_load_file($feed_url);
    $namespaces = $rss->getNamespaces(true);

    foreach($rss->channel->item as $item){
        $media_content = $item->children($namespaces['media']);

        $image = '';

        if ($media_content){
            foreach($media_content as $i){
                $image = (string)$i->attributes()->url;
            }
        }

        $descriptionString = html_entity_decode((string)$item->description);

        // replaces all tags with empty spaces, otherwise <p> tags in description don't get the description class
        // and won't be hidden in mobile view
        $description = preg_replace('/<[^>]*>/', ' ' , $descriptionString);

        echo '<div class="item"><div class="content"><a data-id=' . $item->link . '>' .
            (($image) ? '<img src=' . $image . ' class="thumb"/>' : '<img src=' . "images/no_image.png" .' class="thumb"/>')
            . '<h3 class="title">' . $item->title . '</h3><strong>Author : ' . $item->author . '</strong>
            <p class="description">' . $description . '</p></a></div></div>';

    }
}

if (isset($_GET['action']) && $_GET['action'] == 'callMercuryAPI'){
    $url = $_GET['url'];

    function callMercuryAPI($url){
        $curl = curl_init();
        $url = "https://mercury.postlight.com/parser?url=" . $url;

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'x-api-key: 6bWM0EembdPN1wtkrowmaeMvRIPI7N4AuzleFq2o',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    $result = json_encode(json_decode(callMercuryAPI($url), true));
    echo $result;
    exit;
}
?>