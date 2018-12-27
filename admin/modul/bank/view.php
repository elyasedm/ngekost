<h2>Data Bank</h2>
<input type=button class="tombol" value="Tambah Bank" onclick="window.location.href='?page=add_bank'">
<table>
    <tr>
        <th>No</th>
        <th>Nama Bank</th>
        <th>No. Rekening</th>
        <th>Nama Nasabah</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr> 
    <?php
    $tampil = mysql_query("SELECT * FROM bank");
    $no = 1;
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama]</td>
            <td>$r[no_rekening]</td>
            <td>$r[nama_nasabah]</td>
            <td>";
        if ($r['aktif']) {
            echo "<a href='modul/$_GET[page]/aksi.php?act=n_aktif&id=$r[id]'><b>Aktif</b></a>";
        } else {
            echo "<a href='modul/$_GET[page]/aksi.php?act=aktif&id=$r[id]'><b>Non-Aktif</b></a>";
        }
        echo "</td>
            <td><a href=?page=edit_bank&id=$r[id]><b>Edit</b></a>
			&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>
            </td>
		</tr>";
        $no++;
    }
    ?>
</table>
