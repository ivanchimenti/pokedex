<?php

function validate_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}


function upload_image($file)
{
    $target_dir = "./assets/pkmnImages/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_name = uniqid() . '.' . $imageFileType;


    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {

        if ($file["size"] > 500000) {
            return false;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            return false;
        }

        if (move_uploaded_file($file["tmp_name"], $target_dir . $image_name)) {
            return "/pokedex/assets/pkmnImages/" . $image_name;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
