<?php

function uploadImage($img,$img_name,$location){
    $target=PBROOT.$location.$img_name;

    return move_uploaded_file($img,$target);
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