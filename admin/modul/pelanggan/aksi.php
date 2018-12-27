<?php

session_start();
include "../../../config/koneksi.php";

if ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM pelanggan WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'n_aktif') {
    mysql_query("UPDATE pelanggan SET aktif = 0 WHERE id = '$_GET[id]'");
} elseif ($_GET[act] == 'aktif') {
    mysql_query("UPDATE pelanggan SET aktif = 1 WHERE id = '$_GET[id]'");
}

header("Location:../../media.php?page=pelanggan&p=".$_SESSION['admin']['pagination']['pelanggan']);
?>
