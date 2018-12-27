<?php

session_start();
require_once '../config/koneksi.php';
include "../config/upload.php";

$nama_file = $_FILES['photo']['name'];
if (!empty($nama_file)) {
    $profil = mysql_fetch_array(mysql_query('SELECT photo from pelanggan WHERE id='.$_SESSION['member']['id']));
    $nama_file = UploadPhoto($nama_file);
    $fileUpdate = 'photo = "' . $nama_file . '",';
} else {
    $fileUpdate = '';
}

$pass = '';
if ($_POST[edit_pass] == 'ya') {
    if ($_SESSION['member']['password'] == md5($_POST[password]) && $_POST[password_new] == $_POST[password_conf]) {
        $pass = 'password = "' . md5($_POST[password_new]) . '",';
        $_SESSION['member']['password'] = md5($_POST[password_new]);
    }  else {
        echo '<script type="text/javascript">alert("Password Lama tidak sesuai");window.location = "../index.php?pages=edit_profile";</script>';
        die;
    }
}
$update = mysql_query("UPDATE pelanggan SET
            nama = '$_POST[nama]',
            ktp = '$_POST[ktp]',
            email = '$_POST[email]',
            alamat = '$_POST[alamat]',
            jenis_kelamin = '$_POST[jenis_kelamin]',
            no_hp = '$_POST[no_hp]',
            " . $fileUpdate . $pass . "
            kampus = '$_POST[kampus]'
            WHERE id ='".$_SESSION['member']['id']."'
        ");

if ($update) {
    unlink("../photos/".$profil['photo']);
    unlink("../photos/small_".$profil['photo']);
    header('Location:../index.php?pages=profile');
} else {
    header('Location:../index.php?pages=edit_profile');
}
?>
