<?php
$data = mysql_fetch_array(mysql_query('SELECT * FROM kamar WHERE id='.$_GET[id]));
?>
<script type="text/javascript">
    function validasi(form_data){
        if (form_data.nama.value == ""){
            alert("Anda belum mengisikan Nama Kamar.");
            form_data.nama.focus();
            return (false);
        }
          
        if (form_data.jenis.value == ""){
            alert("Anda belum mengisikan Jenis Kamar.");
            form_data.jenis.focus();
            return (false);
        }
   
        return (true);
    }
</script>
<h2>Tambah Kamar</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=update" onSubmit="return validasi(this)" id="form_data"/>
<input type="hidden" name="id" value="<?php echo $data[id] ?>"/>
<input type="hidden" name="kost_id" value="<?php echo $data[kost_id] ?>"/>
<table>
    <tr>
        <td>Nama kamar</td>
        <td> : <input type=text name='nama' size='40' value="<?php echo $data[nama] ?>" onkeypress="return isAlfabetAndNumberKey(event)"/></td>
    </tr>
        <tr>
            <td>Jenis</td>
            <td> : 
                <?php if($data[jenis] == 'L') {?>
                <input type="radio" name="jenis" value="L" checked="checked"/>Putra 
                <input type="radio" name="jenis" value="P"/>Putri
                <?php } else{ ?>
                <input type="radio" name="jenis" value="L"/>Putra 
                <input type="radio" name="jenis" value="P" checked="checked"/>Putri
                <?php } ?>
            </td>
        </tr>
    <tr>
        <td>Keterangan</td>
        <td> : <textarea id="keterangan" name="keterangan" rows="5" cols="53"><?php echo $data[keterangan] ?></textarea></td>
    </tr>
    <tr>
        <td colspan=2>
            <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=kamar&id=<?php echo $data[kost_id] ?>' "/>
        </td>
    </tr>
</table>
</form>