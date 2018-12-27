<h2>Data Periode</h2>
<input type=button class="tombol" value="Tambah Periode" onclick="window.location.href='?page=add_periode'">
<table>
    <tr>
        <th>No</th>
        <th>Nama periode</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr> 
    <?php
    $tampil = mysql_query("SELECT * FROM periode");
    $no = 1;
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama]</td>
            <td>";
        if ($r['aktif']) {
            echo "<b>Aktif</b>";
        } else {
            echo "<a href='modul/$_GET[page]/aksi.php?act=aktif&id=$r[id]'><b>Non-Aktif</b></a>";
        }
        echo "</td>
            <td><a href=?page=edit_periode&id=$r[id]><b>Edit</b></a>
			&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>
            </td>
		</tr>";
        $no++;
    }
    ?>
</table>
