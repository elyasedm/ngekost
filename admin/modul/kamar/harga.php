<?php
    $kost = mysql_fetch_array(mysql_query('SELECT kost.id FROM kamar LEFT JOIN kost ON kost.id = kamar.kost_id WHERE kamar.id = '.$_GET[id]));
?>
<h2>Data Harga Kamar</h2>
<input type=button class="tombol" value="Tambah Harga Kamar" onclick="window.location.href='?page=addharga_kamar&id=<?php echo $_GET[id] ?>'">
<input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=kamar&id=<?php echo $kost[id] ?>' "/>
<div class="clear"></div>
<table>
    <tr>
        <th>No</th>
        <th>Periode</th>
        <th>Jumlah Orang</th>
        <th>Harga</th>
        <th width="180px">Aksi</th>
    </tr> 
    <?php
    $batas = 10;
    $halaman = $_GET['p'];
    if (empty($halaman)) {
        $posisi = 0;
        $halaman = $no = 1;
    } else {
        $posisi = ($halaman - 1) * $batas;
        $no = $posisi + 1;
    }
    $tampil = mysql_query("SELECT harga_kamar.*,periode.nama
                            FROM harga_kamar
                                LEFT JOIN periode
                                    ON periode.id = harga_kamar.periode_id
                            WHERE kamar_id = " . $_GET[id] . " ORDER BY harga_kamar.id DESC LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama]</td>
            <td>$r[jumlah_orang]</td>
            <td>Rp. ".number_format($r[harga],2,',','.')." / $r[type]</td>
            <td>
                <a href=?page=editharga_kamar&id=$r[id]><b>Edit</b></a>
                &nbsp;&nbsp;&nbsp;<a href='modul/kamar/aksi.php?act=delete_harga&id=$r[id]&kamar_id=$_GET[id]'><b>Hapus</b></a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>
<?php
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM harga_kamar WHERE kamar_id = " . $_GET[id]));
$total_page = ceil($count[0] / $batas);
echo 'Halaman : ';
for ($i = 1; $i <= $total_page; $i++) {
    if ($i != $halaman) {
        echo '<a href="media.php?page=' . $_GET[page] . '&id=' . $_GET[id] . '&p=' . $i . '"> ' . $i . '</a> | ';
    } else {
        echo '<b>' . $i . '</b> | ';
    }
}
?>
