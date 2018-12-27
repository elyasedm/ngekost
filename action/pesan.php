<?php

require_once '../config/koneksi.php';
session_start();
$jenis = mysql_query("SELECT * FROM harga_kamar WHERE id = $_POST[jenis]");
$r_jenis = mysql_fetch_array($jenis);

if ($r_jenis['type'] == 'bulan') {
    $days = 30;
} elseif ($r_jenis['type'] == '6 bulan') {
    $days = 30 * 6;
} elseif ($r_jenis['type'] == 'tahun') {
    $days = 365;
}

$keluar = date('Y-m-d', strtotime('+' . $days . ' day', strtotime("$_POST[masuk]")));
mysql_query("INSERT INTO pemesanan(harga_kamar_id,
                                    tanggal,
                                    batas_akhir,
                                    aktif,
                                    pelanggan_id,
                                    tgl_masuk,
                                    tgl_keluar)
                                VALUES('$_POST[jenis]',
                                    '" . date('Y-m-d H:i:s') . "',
                                    '" . date('Y-m-d H:i:s', strtotime('+2 days')) . "',
                                    1,
                                    '".$_SESSION['member']['id']."',
                                    '$_POST[masuk]',
                                    '$keluar')");
mysql_query('UPDATE kamar SET status = "dipesan" WHERE id='.$r_jenis['kamar_id']);

?>
<script type="text/javascript">
    alert('Pemesanan anda akan aktif selama 2 hari, jika sudah 2 hari belum melakukan konfirmasi pembayaran maka transaksi akan kami anggap batal. Terima Kasih.'); 
    window.location = '../index.php?pages=kost'
</script>
