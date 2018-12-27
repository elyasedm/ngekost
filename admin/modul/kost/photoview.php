<h2>Gallery Kost</h2>
<input type=button class="tombol" value="Tambah Gambar" onclick="window.location.href='?page=addimg_kost&kost_id=<?php echo $_GET[id] ?>'">
            <input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=kost' "/>
<div class="clear"></div>
<ul class="gallery">
    <?php
    $query = mysql_query('SELECT * FROM gambar_kost WHERE kost_id =' . $_GET[id]);
    while ($r = mysql_fetch_array($query)) {
        echo '<li><img src="../images/small_' . $r[lokasi] . '"/><span><a href="?page=editimg_kost&id='.$r['id'].'">Edit</a> | <a href="modul/kost/aksi.php?act=delete_img&id=' . $r[id] . '&kost_id='.$_GET[id].'">Delete</a></span></li>';
    }
    ?>
</ul>