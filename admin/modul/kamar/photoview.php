<?php
    $kost = mysql_fetch_array(mysql_query('SELECT kost.id FROM kamar LEFT JOIN kost ON kost.id = kamar.kost_id WHERE kamar.id = '.$_GET[id]));
?>
<h2>Gallery Kamar</h2>
<input type=button class="tombol" value="Tambah Gambar" onclick="window.location.href='?page=addimg_kamar&kamar_id=<?php echo $_GET[id]?>'">
<input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=kamar&id=<?php echo $kost[id] ?>' "/>
<div class="clear"></div>
<ul class="gallery">
    <?php
        $query = mysql_query('SELECT * FROM gambar_kamar WHERE kamar_id ='.$_GET[id]);
        while ($r = mysql_fetch_array($query)){
            echo '<li><img src="../images/small_'.$r[lokasi].'"/><span><a href="?page=editimg_kamar&id='.$r['id'].'">Edit</a> | <a href="modul/kamar/aksi.php?act=delete_img&id='.$r[id].'&kamar_id='.$_GET[id].'">Delete</a></span></li>';
        }
    ?>
</ul>