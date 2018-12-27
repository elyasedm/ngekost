<script type="text/javascript">
    function validasi(form_data){
        if (form_data.nama.value == ""){
            alert("Anda belum mengisikan Nama Kost.");
            form_data.nama.focus();
            return (false);
        }
          
        if (form_data.alamat.value == ""){
            alert("Anda belum mengisikan Alamat Kost.");
            form_data.alamat.focus();
            return (false);
        }

        if (form_data.pemilik_id.value == "false"){
            alert("Anda belum memilih nama pemilik.");
            form_data.pemilik_id.focus();
            return (false);
        }

   
        return (true);
    }
</script>
<style>
    ul.fasilitas {
        padding: 0;
    }
    ul.fasilitas li{
        width: 25%;
        padding: 0;
        float: left;
        list-style: none;
    }
</style>
<h2>Tambah kost</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data"/>
<table>
    <tr>
        <td>Nama Kost</td>
        <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetAndNumberKey(event)"/></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> : <textarea name="alamat" rows="5" cols="53"></textarea></td>
    </tr>
    <tr>
        <td>Nama Pemilik</td>
        <td> : 
            <select name="pemilik_id">
                <option value="false">-- Pilih Pemilik --</option>
                <?php
                $pemilik = mysql_query('SELECT * FROM pemilik');
                while ($pmlk = mysql_fetch_array($pemilik)) {
                    echo '<option value="' . $pmlk[id] . '">' . $pmlk[nama] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td> : <textarea id="keterangan" name="keterangan" rows="5" cols="53"></textarea></td>
    </tr>
    <tr>
        <td>Fasilitas</td>
        <td>
            <ul class="fasilitas">
                <?php
                $q_fasilitas = mysql_query('SELECT * FROM fasilitas');
                while ($r_fasilitas = mysql_fetch_array($q_fasilitas)) {
                    echo '<li><input type="checkbox" name="fasilitas[]" value="' . $r_fasilitas['id'] . '"/>';
                    echo '<span>' . $r_fasilitas['nama'] . '</span></li>';
                }
                ?>
            </ul>
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
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=kost' "/>
        </td>
    </tr>
</table>
</form>