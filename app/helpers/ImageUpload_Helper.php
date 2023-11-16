<?php

function uploadImage($img, $img_name, $location){
    $target = PBROOT . $location . $img_name;

    if (!file_exists($img)) {
        return false; 
    }

    $allowed_types = array('image/png', 'image/jpeg');
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    
    $mime_type = finfo_file($file_info, $img);
    finfo_close($file_info);

    if (!$mime_type || !in_array($mime_type, $allowed_types)) {
        return false; 
    }

    return move_uploaded_file($img, $target);
}


function updateImage($old,$img,$img_name,$location){
    unlink($old);
    $target=PBROOT.$location.$img_name;
    return move_uploaded_file($img,$target);
}

function deleteImage($img){
    if(unlink){
        return true;
    }
    else{
        return false;
    }
}