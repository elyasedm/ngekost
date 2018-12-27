<?php

session_start();
include "../../../config/koneksi.php";
// Input menu utama
if ($_GET[act] == 'input') {
    mysql_query("INSERT INTO periode(nama,
                                    aktif) 
                                 VALUES('$_POST[nama]',
                                     '0')");
}

// Update menu utama
elseif ($_GET[act] == 'edit') {
    mysql_query("UPDATE periode SET nama='$_POST[nama]'
               WHERE id = '$_POST[id]'");
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM periode WHERE id = '$_GET[id]'");
}

elseif ($_GET[act] == 'aktif') {
    mysql_query("UPDATE periode SET aktif=1
               WHERE id = '$_GET[id]'");
    
    mysql_query("UPDATE periode SET aktif=0
               WHERE id <> '$_GET[id]'");
}

header("Location:../../media.php?page=periode");
?>
