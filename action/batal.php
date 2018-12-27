<?php
require_once '../config/koneksi.php';
mysql_query("UPDATE pemesanan SET aktif = 0 WHERE id = $_GET[id]");
mysql_query('
    UPDATE kamar SET status = "kosong"
    WHERE id IN (
        SELECT harga_kamar.kamar_id 
        FROM harga_kamar 
            LEFT JOIN pemesanan
                ON pemesanan.harga_kamar_id = harga_kamar.id
        WHERE pemesanan.id = '.$_GET[id].')
    ');
header("Location:../index.php?pages=transaksi");
?>
