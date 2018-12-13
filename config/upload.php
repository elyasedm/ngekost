<?php

function UploadImage($fupload_name) {
    //direktori gambar
    $vdir_upload = "../../../maps/";
    $rand = rand(000000, 999999);
    $vfile_upload = $vdir_upload . $rand . '_' . $fupload_name;

    if (!in_array($_FILES["file"]["type"], array('image/gif', 'image/jpg', 'image/jpeg', 'image/png'))) {
        echo '<script type="text/javascript">alert("Type File yang diupload bukan image");history.back();</script>';
        die;
    }
    
    $size = getimagesize($_FILES["file"]["tmp_name"]);
    if($size[0] > 64 || $size[1] > 64){
        echo '<script type="text/javascript">alert("Ukuran Image Maksimal 64x64 pixels");history.back();</script>';
        die;
    }
    
    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload);
    return $rand . '_' . $fupload_name;
}

function UploadPhoto($fupload_name) {
    //direktori gambar
    $vdir_upload = "../photos/";
    $rand = rand(000000, 999999);
    $vfile_upload = $vdir_upload . $rand . '_' . $fupload_name;
    
    move_uploaded_file($_FILES["photo"]["tmp_name"], $vfile_upload);

    switch ($_FILES["photo"]["type"]) {
        case 'image/gif' :
            $im_src = imagecreatefromgif($vfile_upload);
            break;
        case 'image/jpeg' :
        case 'image/jpg' :
            $im_src = imagecreatefromjpeg($vfile_upload);
            break;
        case 'image/png' :
            $im_src = imagecreatefrompng($vfile_upload);
            break;
        default :
            echo '<script type="text/javascript">alert("Type File yang diupload bukan image");history.back();</script>';
            die;
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);
    //Simpan dalam versi small 110 pixel
    //Set ukuran gambar hasil perubahan
    if ($src_width < $src_height) {
        $dst_width = 215;
        $dst_height = ($dst_width / $src_width) * $src_height;
    } else {
        $dst_height = 215;
        $dst_width = ($dst_height / $src_height) * $src_width;
    }
    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    switch ($_FILES["photo"]["type"]) {
        case 'image/gif' :
            imagegif($im, $vdir_upload . "small_" .$rand . '_' . $fupload_name);
            break;
        case 'image/jpeg' :
        case 'image/jpg' :
            imagejpeg($im, $vdir_upload . "small_" . $rand . '_' . $fupload_name);
            break;
        case 'image/png' :
            imagepng($im, $vdir_upload . "small_" . $rand . '_' . $fupload_name);
            break;
    }

    return $rand . '_' . $fupload_name;
}

function uploadImageResize($fupload_name) {

    $time = date('Y-m-d++H-i-s');
    $rand = rand(000000, 999999);
    $fupload_name = $time . '_' . $rand . '_' . $fupload_name;

    //direktori gambar
    $vdir_upload = "../../../images/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["image"]["tmp_name"], $vfile_upload);

    //identitas file asli
    switch ($_FILES["image"]["type"]) {
        case 'image/gif' :
            $im_src = imagecreatefromgif($vfile_upload);
            break;
        case 'image/jpeg' :
        case 'image/jpg' :
            $im_src = imagecreatefromjpeg($vfile_upload);
            break;
        case 'image/png' :
            $im_src = imagecreatefrompng($vfile_upload);
            break;
        default :
            echo '<script type="text/javascript">alert("Type File yang diupload bukan image");history.back();</script>';
            die;
    }

    //$im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 110 pixel
    //Set ukuran gambar hasil perubahan
    if ($src_width < $src_height) {
        $dst_width = 135;
        $dst_height = ($dst_width / $src_width) * $src_height;
    } else {
        $dst_height = 135;
        $dst_width = ($dst_height / $src_height) * $src_width;
    }
    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    switch ($_FILES["image"]["type"]) {
        case 'image/gif' :
            imagegif($im, $vdir_upload . "small_" . $fupload_name);
            break;
        case 'image/jpeg' :
        case 'image/jpg' :
            imagejpeg($im, $vdir_upload . "small_" . $fupload_name);
            break;
        case 'image/png' :
            imagepng($im, $vdir_upload . "small_" . $fupload_name);
            break;
    }


    //Simpan dalam versi medium 360 pixel
    //Set ukuran gambar hasil perubahan
    if ($src_width < $src_height) {
        $dst_width2 = 570;
        $dst_height2 = ($dst_width2 / $src_width) * $src_height;
    } else {
        $dst_height2 = 570;
        $dst_width2 = ($dst_height2 / $src_height) * $src_width;
    }

    //proses perubahan ukuran
    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    //Simpan gambar
    switch ($_FILES["image"]["type"]) {
        case 'image/gif' :
            imagegif($im2, $vdir_upload . "medium_" . $fupload_name);
            break;
        case 'image/jpeg' :
        case 'image/jpg' :
            imagejpeg($im2, $vdir_upload . "medium_" . $fupload_name);
            break;
        case 'image/png' :
            imagepng($im2, $vdir_upload . "medium_" . $fupload_name);
            break;
    }

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
    return $fupload_name;
}

?>
