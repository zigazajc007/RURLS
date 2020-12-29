<?php

include "settings.php";

if(isset($_POST["old_url"]) && isset($_POST["new_url"])){
    $old_url = filter_var($_POST["old_url"], FILTER_SANITIZE_URL);
    if (filter_var($old_url, FILTER_VALIDATE_URL)) {
        $data = json_decode(file_get_contents("urls.json"), true);
        if($random_url_generator){
            $new_url = substr(str_shuffle($rug_charset), 0, $rug_length);
            while (array_key_exists($new_url, $data)) $new_url = substr(str_shuffle($rug_charset), 0, $rug_length);
            $data[$new_url] = $old_url;
            file_put_contents("urls.json", json_encode($data));
            header("Location: index.php?color=success&info=URL is shortened!&newurl=" . $new_url);
        }else{
            $new_url = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST["new_url"]);
            if(array_key_exists($new_url, $data)){
                header("Location: index.php?color=danger&info=URL is already taken!");
            }else{
                $data[$new_url] = $old_url;
                file_put_contents("urls.json", json_encode($data));
                header("Location: index.php?color=success&info=URL is shortened!&newurl=" . $new_url);
            }
        }
    }else{
        header("Location: index.php?color=danger&info=URL is invalid!");
    }
}else{
    header("Location: index.php");
}

?>
