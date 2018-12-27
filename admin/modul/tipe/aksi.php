<?php

session_start();
include "../../../config/koneksi.php";
include "../../../config/upload.php";

$lokasi_file = $_FILES['file']['tmp_name'];
$tipe_file = $_FILES['file']['type'];
$nama_file = $_FILES['file']['name'];

// Input menu utama
if ($_GET[act] == 'input') {
    $nama_file = UploadImage($nama_file);
    mysql_query("INSERT INTO type_tempat(nama,gambar) VALUES('$_POST[nama]','$nama_file')");
}

// Update menu utama
elseif ($_GET[act] == 'edit') {
    if ($nama_file != "") {
        $nama_file = UploadImage($nama_file);
        mysql_query("UPDATE type_tempat SET nama='$_POST[nama]',
                gambar='$nama_file' 
               WHERE id = '$_POST[id]'");
    } else {
        mysql_query("UPDATE type_tempat SET nama='$_POST[nama]'
  				WHERE id = '$_POST[id]'");
    }
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    $data = mysql_fetch_array(mysql_query('SELECT gambar FROM type_tempat WHERE id=' . $_GET[id]));
    unlink('../../../maps/' . $data['gambar']);
    mysql_query("DELETE FROM type_tempat WHERE id = '$_GET[id]'");
}

header("Location:../../media.php?page=tipe&p=".$_SESSION['admin']['pagination']['tipe']);
?>
