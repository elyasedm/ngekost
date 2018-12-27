<h2>Data Pemilik</h2>
<div class="half left">
    <input type=button class="tombol" value="Tambah Pemilik" onclick="window.location.href='?page=add_pemilik'">
</div>
<div class="half right">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Nama Pemilik : 
        <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/>
        <input type="submit" value="Cari"/>
    </form>
</div>
<table>
    <tr>
        <th>No</th>
        <th>Nama pemilik</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>No. Handphone</th>
        <th>Status</th>
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
    $tampil = mysql_query("SELECT * FROM pemilik $condition LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
			<td>$no</td>
            <td>$r[nama]</td>
            <td>$r[email]</td>
            <td>$r[alamat]</td>
            <td>";
        if ($r[jenis_kelamin] == 'L') {
            echo 'Laki-Laki';
        } else {
            echo 'Perempuan';
        }
        echo "</td>
            <td>$r[no_hp]</td>
            <td>";
        if ($r['aktif']) {
            echo "<a href='modul/$_GET[page]/aksi.php?act=n_aktif&id=$r[id]'><b>Aktif</b></a>";
        } else {
            echo "<a href='modul/$_GET[page]/aksi.php?act=aktif&id=$r[id]'><b>Non-Aktif</b></a>";
        }
        echo "</td>
            <td><a href=?page=edit_pemilik&id=$r[id]><b>Edit</b></a>";
        echo "&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>";
        echo "</td>
		</tr>";
        $no++;
    }
    ?>
</table>
<?php
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM pemilik $condition"));
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
