<?php

function restimage($webroot, $res){
    $dir = 'images/restaurants/';
    $pic = $res['Restaurant']['picture'];
    if (!$pic || !file_exists($dir . $pic)) {
        $pic = 'default.png';
    }
    return $webroot . $dir . $pic;
}

function findrestuarant($restaurants, $ID){
    foreach($restaurants as $restaurant){
        if ($restaurant['Restaurants']['id'] == $ID){
            return $restaurant['Restaurants'];
        }
    }
}

function get($key, $default = ""){
    if (isset($_POST[$key])) { return $_POST[$key];}
    if (isset($_GET[$key])) { return $_GET[$key];}
    return $default;
}
?>