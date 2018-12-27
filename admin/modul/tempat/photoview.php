<h2>Gallery Tempat</h2>
<input type=button class="tombol" value="Tambah Gambar" onclick="window.location.href='?page=addimg_tempat&tempat_id=<?php echo $_GET[id] ?>'">
<input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=tempat' "/>
<div class="clear"></div>
<ul class="gallery">
    <?php
    $query = mysql_query('SELECT * FROM gambar_tempat WHERE tempat_id =' . $_GET[id]);
    while ($r = mysql_fetch_array($query)) {
        echo '<li><img src="../images/small_' . $r[lokasi] . '"/><span><a href="?page=editimg_tempat&id='.$r['id'].'">Edit</a> | <a href="modul/tempat/aksi.php?act=delete_img&id=' . $r[id] . '&tempat_id='. $_GET[id].'">Delete</a></span></li>';
    }
    ?>
</ul>