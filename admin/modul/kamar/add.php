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
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data"/>
<input type="hidden" name="kost_id" value="<?php echo $_GET[id] ?>"/>
<table>
    <tr>
        <td>Nama kamar</td>
        <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetAndNumberKey(event)"/></td>
    </tr>
        <tr>
            <td>Jenis</td>
            <td> : 
                <input type="radio" name="jenis" value="L" checked="checked"/>Putra 
                <input type="radio" name="jenis" value="P"/>Putri
            </td>
        </tr>
    <tr>
        <td>Keterangan</td>
        <td> : <textarea id="keterangan" name="keterangan" rows="5" cols="53"></textarea></td>
    </tr>
    <tr>
        <td colspan=2>
            <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=kamar&id=<?php echo $_GET[id] ?>' "/>
        </td>
    </tr>
</table>
</form>