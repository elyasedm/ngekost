<h2>Data Admin</h2>
<?php if ($_SESSION['admin']['role'] == 'super admin') { ?>
    <div class="half left">
        <input type=button class="tombol" value="Tambah Admin" onclick="window.location.href='?page=add_admin'">
    </div>
    <div class="half right">
        <form method="get" action="media.php">
            <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
            Nama Admin : 
            <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/>
            <input type="submit" value="Cari"/>
        </form>
    </div>
<?php } ?>
<table>
    <tr>
        <th>No</th>
        <th>Nama Admin</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>No. Handphone</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr> 
    <?php
    if ($_SESSION['admin']['role'] == 'super admin') {
        $condition = 'WHERE nama LIKE "%' . $_GET['nama'] . '%"';
        $tampil = mysql_query("SELECT * FROM admin $condition ORDER BY batasan DESC, nama ASC");
    } else {
        $tampil = mysql_query("SELECT * FROM admin WHERE id='" . $_SESSION['admin']['id'] . "'");
    }
    $no = 1;
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
            <td><a href=?page=edit_admin&id=$r[id]><b>Edit</b></a>";
        if ($r[id] != $_SESSION['admin']['id']) {
            echo "&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>";
        }
        echo "</td>
		</tr>";
        $no++;
    }
    ?>
</table>
