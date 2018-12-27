<h2>Data Kamar</h2>
<input type=button class="tombol" value="Tambah Kamar" onclick="window.location.href='?page=add_kamar&id=<?php echo $_GET[id] ?>'">
<input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=kost' "/>
<div class="clear"></div>
<table>
    <tr>
        <th>No</th>
        <th>Nama kamar</th>
        <th>Jenis</th>
        <th>Status</th>
        <th width="250px">Aksi</th>
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
    $tampil = mysql_query("SELECT *
                            FROM kamar
                            WHERE kost_id = " . $_GET[id] . " ORDER BY nama LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
			<td>$no</td>
            <td>$r[nama]</td>
            <td>";
        if ($r[jenis] == 'L')
            echo 'Putra';
        else
            echo 'Putri';
        echo "</td>
            <td>$r[status]</td>
            <td>
                <a href=?page=edit_kamar&id=$r[id]><b>Edit</b></a>
                &nbsp;&nbsp;&nbsp;<a href=?page=photoview_kamar&id=$r[id]><b>Photo</b></a>
                &nbsp;&nbsp;&nbsp;<a href=?page=harga_kamar&id=$r[id]><b>Harga</b></a>
                &nbsp;&nbsp;&nbsp;<a href=?page=pemesanan_kamar&id=$r[id]><b>Pemesanan</b></a>
                &nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]&kost_id=$_GET[id]'><b>Hapus</b></a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>
<?php
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM kamar WHERE kost_id = " . $_GET[id]));
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
