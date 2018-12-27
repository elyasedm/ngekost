<?php
require_once '../config/koneksi.php';
include "../config/upload.php";

$nama_file = $_FILES['photo']['name'];
if(!empty($nama_file)){
    $nama_file = UploadPhoto($nama_file);
}
if (!empty($_POST['password']) && ($_POST['password'] == $_POST['k_password'])) {
    $password = md5($_POST['password']);
    $user = mysql_query("SELECT * FROM pelanggan WHERE email = '" . $_POST['email'] . "'");
    $data = mysql_fetch_array($user);
    $ketemu = mysql_num_rows($user);
    if ($ketemu == 0) {
        $insert = mysql_query("INSERT INTO pelanggan(nama,
                                        email,
                                        ktp,
                                        password,
                                        alamat,
                                        jenis_kelamin,
                                        no_hp,
                                        kampus,
                                        photo,
                                        aktif)
                                   VALUE('$_POST[nama]',
                                        '$_POST[email]',
                                        '$_POST[ktp]',
                                        '$password',
                                        '$_POST[alamat]',
                                        '$_POST[jk]',
                                        '$_POST[no_hp]',
                                        '$_POST[kampus]',
                                        '$nama_file',
                                        '1')");
        if($insert){
            echo "<script>alert('Selamat User $_POST[nama] ($_POST[email]) berhasil didaftarkan.');</script>";
        }else{
            echo "<script>alert('Maaf User $_POST[nama] ($_POST[email]) gagal didaftarkan.');</script>";
        }
    } else {
        echo "<script>alert('Maaf User ".$data['nama']." (".$data['email'].") sudah terdaftar.'); window.location = '../index.php?pages=register'</script>";
    }
}
if (!isset($_GET['url'])) {
        echo "<script>window.location = '../index.php?pages=login'</script>";
} else {
        echo "<script>window.location = '../index.php?pages=login&url=".urlencode ($_GET['url'])."'</script>";
}
?>
