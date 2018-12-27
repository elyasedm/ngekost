<?php

session_start();
include "../../../config/koneksi.php";

if ($_GET[act] == 'konfirmasi') {
    mysql_query('UPDATE pembayaran SET konfirmasi = 1 WHERE id='.$_GET[id]);
    $pembayaran = mysql_fetch_array(mysql_query('
        SELECT SUM(jumlah) as total 
        FROM pembayaran 
        WHERE pemesanan_id IN (
            SELECT pemesanan_id
            FROM pembayaran
            WHERE id='.$_GET['id'].')'));
    
    $harga = mysql_fetch_array(mysql_query('
        SELECT harga_kamar.harga 
        FROM harga_kamar
            LEFT JOIN pemesanan
                ON pemesanan.harga_kamar_id = harga_kamar.id
        WHERE pemesanan.id IN (
            SELECT pemesanan_id
            FROM pembayaran
            WHERE id='.$_GET['id'].')'));
    $dp = $harga['harga'] * 10 / 100;
    if($pembayaran['total'] >= $dp){
        mysql_query('
            UPDATE kamar 
            SET status = "isi" 
            WHERE id IN (
                SELECT harga_kamar.kamar_id 
                FROM harga_kamar
                    LEFT JOIN pemesanan
                        ON pemesanan.harga_kamar_id = harga_kamar.id
                WHERE pemesanan.id IN (
                    SELECT pemesanan_id
                    FROM pembayaran
                    WHERE id='.$_GET['id'].'))');
    }
}

header("Location:../../media.php?page=pembayaran&p=".$_SESSION['admin']['pagination']['pembayaran']);
?>
