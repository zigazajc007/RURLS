<?php

if(isset($_POST["old_url"]) && isset($_POST["new_url"])){
    $old_url = filter_var($_POST["old_url"], FILTER_SANITIZE_URL);
    if (filter_var($old_url, FILTER_VALIDATE_URL)) {
        $data = json_decode(file_get_contents("urls.json"), true);
        if(!array_key_exists($data["new_url"])){
            $data[$_POST["new_url"]] = $old_url;
            file_put_contents("urls.json", json_encode($data));
            header("Location: index.php?color=success&info=URL is shortened!&newurl=" . $_POST["new_url"]);
        }else{
            header("Location: index.php?color=danger&info=URL is already taken!");
        }
    }else{
        header("Location: index.php?color=danger&info=URL is invalid!");
    }
}else{
    header("Location: index.php");
}

?>
