<?php

session_start();
include "../../../config/koneksi.php";
// Input menu utama
if ($_GET[act] == 'input') {
    mysql_query("INSERT INTO fasilitas(nama,
                                    keterangan) 
                                 VALUES('$_POST[nama]',
                                     '$_POST[keterangan]')");
}

// Update menu utama
elseif ($_GET[act] == 'edit') {
    mysql_query("UPDATE fasilitas SET nama='$_POST[nama]',
                keterangan = '$_POST[keterangan]'
               WHERE id = '$_POST[id]'");
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM fasilitas WHERE id = '$_GET[id]'");
}

header("Location:../../media.php?page=fasilitas&p=".$_SESSION['admin']['pagination']['fasilitas']);
?>
