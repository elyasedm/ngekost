<?php
$edit = mysql_query("SELECT * FROM type_tempat WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 5); ?>/validasi.js"></script>
<h2>Edit Jenis Tempat</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=edit" enctype="multipart/form-data" onSubmit="return validasi(this)" id="form_data">
    <input type="hidden" readonly="readonly" name="id" value="<?php echo $r[id] ?>"/>
    <table>
        <tr>
            <td>Nama Jenis Tempat</td>
            <td> : <input type=text name='nama' size='40' value="<?php echo $r[nama] ?>" onkeypress="return isAlfabetKeyAndSpace(event)"></td>
        </tr>
        <tr>
            <td>Icon Jenis Tempat</td>
            <td> : <input type=file name='file' size='40'></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=tipe' "/>
            </td>
        </tr>
    </table>
</form>