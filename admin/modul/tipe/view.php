<h2>Data Jenis Tempat</h2>
<div class="half left">
    <input type=button class="tombol" value="Tambah Jenis Tempat" onclick="window.location.href='?page=add_tipe'">
</div>
<div class="half right">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Nama Jenis Tempat : 
        <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/>
        <input type="submit" value="Cari"/>
    </form>
</div>
<table>
    <tr>
        <th>No</th>
        <th>Nama Jenis Tempat</th>
        <th>Icon Tempat</th>
        <th>Aksi</th>
    </tr> 
    <?php
    $batas=10;
    $halaman=$_GET['p'];
    if(empty($halaman)){
        $posisi=0;
        $halaman = $no =1;    
    }else{
        $posisi = ($halaman-1) * $batas;
        $no = $posisi + 1;
    }
    $condition = 'WHERE nama LIKE "%' . $_GET['nama'] . '%"';
    $tampil = mysql_query("SELECT * FROM type_tempat $condition LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>".$no."</td>
            <td>$r[nama]</td>
            <td><img src='../maps/$r[gambar]'/></td>
            <td><a href=?page=edit_tipe&id=$r[id]><b>Edit</b></a>
			&nbsp;&nbsp;&nbsp;<a href='modul/$_GET[page]/aksi.php?act=delete&id=$r[id]'><b>Hapus</b></a>
            </td>
		</tr>";
        $no++;
    }
    ?>
</table>
<?php
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM type_tempat $condition"));
    $total_page=ceil($count[0]/$batas);
    echo 'Halaman : ';
    for($i = 1; $i <= $total_page; $i++){
        if($i != $halaman){
            echo '<a href="media.php?page='.$_GET[page].'&p='.$i.'&nama=' . $_GET['nama'] . '"> '.$i.'</a> | ';
        }  else {
            echo '<b>'.$i.'</b> | ';
        }
    }
?>
