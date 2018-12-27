<?php

session_start();
include "../../../config/koneksi.php";
// Input menu utama
if ($_GET[act] == 'input') {
    mysql_query("INSERT INTO bank(nama,
                                    no_rekening,
                                    nama_nasabah,
                                    aktif) 
                                 VALUES('$_POST[nama]',
                                     '$_POST[no_rekening]',
                                     '$_POST[nama_nasabah]',
                                     '$_POST[aktif]')");
}

// Update menu utama
elseif ($_GET[act] == 'edit') {
    mysql_query("UPDATE bank SET nama='$_POST[nama]',
                no_rekening='$_POST[no_rekening]',
                aktif='$_POST[aktif]',
                nama_nasabah = '$_POST[nama_nasabah]'
               WHERE id = '$_POST[id]'");
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM bank WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'n_aktif') {
    mysql_query("UPDATE bank SET aktif = 0 WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'aktif') {
    mysql_query("UPDATE bank SET aktif = 1 WHERE id = '$_GET[id]'");
}

header("Location:../../media.php?page=bank");
?>
