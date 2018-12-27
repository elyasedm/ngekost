<?php

session_start();
include "../../../config/koneksi.php";

if ($_GET[act] == 'konfirmasi') {
    mysql_query('UPDATE pembayaran SET konfirmasi = 1 WHERE id='.$_GET[id]);
}

header("Location:../../media.php?page=detail_pemesanan&id=$_GET[pemesanan_id]&p=".$_SESSION['admin']['pagination']['detail_pemesanan']);
?>
