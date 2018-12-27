<?php

session_start();
include "../../../config/koneksi.php";

$password = md5($_POST[password]);
// Input menu utama
if ($_GET[act] == 'input') {
    mysql_query("INSERT INTO admin(id,
                                    email,
                                    nama,
                                    no_hp,
                                    alamat,
                                    jenis_kelamin,
                                    password,
                                    aktif) 
                                VALUES('$_POST[id]',
                                    '$_POST[email]',
                                    '$_POST[nama]',
                                    '$_POST[no_hp]',
                                    '$_POST[alamat]',
                                    '$_POST[jenis_kelamin]',
                                    '$password',
                                    '$_POST[aktif]')
    ");
}

// Update menu utama
elseif ($_GET[act] == 'update') {
    if ($_POST[id] == $_SESSION['admin']['id']) {
        if($password == $_SESSION['admin']['password'] && $_POST[password_new] == $password[password_conf]){
            $password = md5($_POST[password_new]);
            $_SESSION['admin']['password'] = $password;
        }else{
            $_POST[password] = '';
        }
    }
    
    if ($_POST[password] != "") {
        mysql_query("UPDATE admin SET nama='$_POST[nama]',
               password='$password',
               no_hp = '$_POST[no_hp]',
               alamat = '$_POST[alamat]',
               jenis_kelamin = '$_POST[jenis_kelamin]',
               aktif = '$_POST[aktif]',
               email = '$_POST[email]'
               WHERE id = '$_POST[id]'");
    } else {
        mysql_query("UPDATE admin SET nama='$_POST[nama]',
               no_hp = '$_POST[no_hp]',
               alamat = '$_POST[alamat]',
               jenis_kelamin = '$_POST[jenis_kelamin]',
               aktif = '$_POST[aktif]',
               email = '$_POST[email]'
               WHERE id = '$_POST[id]'");
    }
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM admin WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'n_aktif') {
    mysql_query("UPDATE admin SET aktif = 0 WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'aktif') {
    mysql_query("UPDATE admin SET aktif = 1 WHERE id = '$_GET[id]'");
}
header("Location:../../media.php?page=admin");
?>
