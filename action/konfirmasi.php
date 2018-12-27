<?php
require_once '../config/koneksi.php';

$transaksi = mysql_query("
            SELECT harga_kamar.harga,
                SUM(pembayaran.jumlah) AS jumlah
            FROM pemesanan
                LEFT JOIN pembayaran
                    ON pembayaran.pemesanan_id = pemesanan.id
                INNER JOIN harga_kamar
                    ON harga_kamar.id = pemesanan.harga_kamar_id
            WHERE pemesanan.id = $_POST[id]
            ");
$r = mysql_fetch_array($transaksi);

if(empty($r[jumlah]) && $r[harga] > $_POST[jumlah]){
    $type = 'DP';
}elseif(!empty($r[jumlah]) && $r[harga] > ($_POST[jumlah] + $r[jumlah])){
    $type = 'cicilan';
}elseif (($_POST[jumlah] + $r[jumlah]) >= $r[harga]) {
    $type = 'lunas';
}

mysql_query("INSERT INTO pembayaran(pemesanan_id,
                                    jumlah,
                                    tanggal,
                                    tgl_transaksi,
                                    kode_transfer,
                                    bank_id,
                                    type)
                                VALUES('$_POST[id]',
                                    '$_POST[jumlah]',
                                    '$_POST[tanggal]',
                                    '".date('Y-m-d H:i:s')."',
                                    '$_POST[kode]',
                                    '$_POST[bank]',
                                    '$type')");
?>
<script type="text/javascript">
    alert('Tunggu konfirmasi dari admin paling lambat 24 jam setelah transaksi untuk dapat mencetak kuitansi');
    window.location = '../index.php?pages=detail_transaksi&id=<?php echo $_POST[id] ?>';
</script>
<?php die; ?>