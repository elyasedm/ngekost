<?php
    $count = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS COUNT FROM gambar_tempat WHERE type="cover" AND tempat_id='.$_GET[tempat_id]));
?>
<script type="text/javascript">
    function validasi(form_data){
        if (form_data.image.value == ""){
            alert("Anda belum mengisikan Gambar.");
            form_data.image.focus();
            return (false);
        }
        return true;
    }
</script>

<h2>Tambah Gambar Tempat</h2>
<form onSubmit="return validasi(this)" id="form_data" action="modul/tempat/aksi.php?act=input_img" method="post" enctype="multipart/form-data">
    <input type="hidden" name="tempat_id" value="<?php echo $_GET[tempat_id] ?>"/>
    <table>
        <tr>
            <td>Gambar</td>
            <td> : <input type="file" name='image' size='40'></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td> : <textarea name="keterangan" cols="52" rows="5"></textarea></td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td> : 
                <?php if($count['COUNT'] > 0) { ?>
                    <input type="radio" name="type" value="cover"/>Cover 
                    <input type="radio" name="type" value="gallery" checked="checked"/>Gallery
                <?php } else { ?>
                    <input type="radio" name="type" value="cover" checked="checked"/>Cover 
                    <input type="radio" name="type" value="gallery"/>Gallery
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td> : 
                <input type="radio" name="aktif" value="1" checked="checked"/>Aktif 
                <input type="radio" name="aktif" value="0"/>Non-Aktif
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