<?php
$image = mysql_fetch_array(mysql_query('SELECT * FROM gambar_kost WHERE id=' . $_GET['id']));
?>
<script type="text/javascript">
    $('.edit').live('click',function(){
        $('.hidden').hide();
        if($(this).val() == 'ya'){
            $('.hidden').show();
        }
    })
</script>
<h2>Edit Gambar Kost</h2>
<form action="modul/kost/aksi.php?act=edit_img" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $image['id'] ?>"/>
    <input type="hidden" name="kost_id" value="<?php echo $image['kost_id'] ?>"/>
    <img src="../images/small_<?php echo $image['lokasi'] ?>" style="border: #000 solid 2px; margin-bottom: 20px;"/>
    <table>
        <tr>
            <td>Ganti gambar</td>
            <td>
                <input type="radio" class="edit" value="ya" name="edit"/>Ya 
                <input type="radio" class="edit" value="tidak" name="edit" checked="checked"/>Tidak
            </td>
        </tr>
        <tr class="hidden">
            <td></td>
            <td> : <input type="file" name='image' size='40'></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td> : <textarea name="keterangan" cols="52" rows="5"><?php echo $image['keterangan'] ?></textarea></td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td> : 
                <?php if ($image['type'] == 'cover') { ?>
                    <input type="radio" name="type" value="cover" checked="checked"/>Cover 
                    <input type="radio" name="type" value="gallery"/>Gallery
                <?php } else { ?>
                    <input type="radio" name="type" value="cover"/>Cover 
                    <input type="radio" name="type" value="gallery" checked="checked"/>Gallery
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td> : 
                <?php if ($image['aktif']) { ?>
                    <input type="radio" name="aktif" value="1" checked="checked"/>Aktif 
                    <input type="radio" name="aktif" value="0"/>Non-Aktif
                <?php } else { ?>
                    <input type="radio" name="aktif" value="1"/>Aktif 
                    <input type="radio" name="aktif" value="0" checked="checked"/>Non-Aktif
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Batal onclick=self.history.back()>
            </td>
        </tr>
    </table>
</form>