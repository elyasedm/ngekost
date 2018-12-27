<h2>Data Fasilitas</h2>
<div class="half left">
    <input type=button class="tombol" value="Tambah Fasilitas" onclick="window.location.href='?page=add_fasilitas'">
</div>
<div class="half right">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Nama Fasilitas : 
        <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/>
        <input type="submit" value="Cari"/>
    </form>
</div>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Aksi</th>
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
    $condition = 'WHERE nama LIKE "%' . $_GET['nama'] . '%"';
    $tampil = mysql_query("SELECT * FROM fasilitas $condition LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama]</td>
            <td>$r[keterangan]</td>
            <td><a href=?page=edit_fasilitas&id=$r[id]><b>Edit</b></a>
			&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>
            </td>
		</tr>";
        $no++;
    }
    ?>
</table>
<?php
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fasilitas $condition"));
$total_page = ceil($count[0] / $batas);
echo 'Halaman : ';
for ($i = 1; $i <= $total_page; $i++) {
    if ($i != $halaman) {
        echo '<a href="media.php?page=' . $_GET[page] . '&p=' . $i . '&nama=' . $_GET['nama'] . '"> ' . $i . '</a> | ';
    } else {
        echo '<b>' . $i . '</b> | ';
    }
}
?>
