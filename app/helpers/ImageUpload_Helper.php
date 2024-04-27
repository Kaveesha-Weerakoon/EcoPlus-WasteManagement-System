<?php

function uploadImage($img, $img_name, $location) {
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


function updateImage($old, $img, $img_name, $location) {
    
    if (!file_exists($img)) {
        return false;
    }

    $allowed_types = ['image/png', 'image/jpeg'];
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($file_info, $img);
    finfo_close($file_info);

    if (!$mime_type || !in_array($mime_type, $allowed_types)) {
        return false;
        die();
    }
    if (file_exists($old)) {
        unlink($old);
    }

    $target = PBROOT . $location . $img_name;

    return move_uploaded_file($img, $target);
}


function deleteImage($img) {
    if (basename($img) === 'profile.png') {
        die();
        return false; // Don't delete if the filename is "profile.png"
    }

    if (unlink($img)) {
        return true;
    } else {
        return false;
    }
}