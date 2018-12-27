<h2>Data Kost</h2>
<div class="half left">
    <input type=button class="tombol" value="Tambah kost" onclick="window.location.href='?page=add_kost'">
</div>
<div class="half right">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Nama Kost : 
        <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/>
        <input type="submit" value="Cari"/>
    </form>
</div>
<table>
    <tr>
        <th>No</th>
        <th>Nama kost</th>
        <th>Alamat</th>
        <th>Pemilik</th>
        <th>No. Handphone</th>
        <th>Email</th>
        <th>Status</th>
        <th width="130px">Aksi</th>
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
    $condition = 'WHERE kost.nama LIKE "%' . $_GET['nama'] . '%"';
    $tampil = mysql_query("SELECT kost.*,
                            pemilik.nama AS nama_pemilik,
                            pemilik.no_hp,
                            pemilik.email
                            FROM kost 
                                LEFT JOIN pemilik
                                    ON pemilik.id =kost.pemilik_id
                            $condition
                            LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
			<td>$no</td>
            <td>$r[nama]</td>
            <td>$r[alamat]</td>
            <td>$r[nama_pemilik]</td>
            <td>$r[no_hp]</td>
            <td>$r[email]</td>
            <td>";
        if ($r['aktif']) {
            echo "<a href='modul/$_GET[page]/aksi.php?act=n_aktif&id=$r[id]'><b>Aktif</b></a>";
        } else {
            echo "<a href='modul/$_GET[page]/aksi.php?act=aktif&id=$r[id]'><b>Non-Aktif</b></a>";
        }
        echo "</td>
            <td>
                <ul>    
                <li>- <a href=?page=photoview_kost&id=$r[id]><b>Photo Kost</b></a></li>
                <li>- <a href=?page=kamar&id=$r[id]><b>Data Kamar</b></a></li>
                <li>- <a href=?page=edit_kost&id=$r[id]><b>Edit</b></a></li>
                <li>- <a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a></li>
                </ul>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>
<?php
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM kost $condition"));
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
