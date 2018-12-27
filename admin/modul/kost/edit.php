<?php
$edit = mysql_query("SELECT * FROM kost WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
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
<h2>Edit kost</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=update" onSubmit="return validasi(this)" id="form_data">
    <input type="hidden" name="id" readonly="readonly" value="<?php echo $r[id]; ?>"/>
<table>
    <tr>
        <td>Nama Kost</td>
        <td> : <input type=text name='nama' size='40' value="<?php echo $r[nama]; ?>" onkeypress="return isAlfabetAndNumberKey(event)"/></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> : <textarea name="alamat" rows="5" cols="53"><?php echo $r[alamat]; ?></textarea></td>
    </tr>
    <tr>
        <td>Nama Pemilik</td>
        <td> : 
            <select name="pemilik_id">
                <option value="false">-- Pilih Pemilik --</option>
                <?php
                    $pemilik = mysql_query('SELECT * FROM pemilik');
                    while ($pmlk = mysql_fetch_array($pemilik)){
                        if($pmlk[id] = $r[pemilik_id]){
                            echo '<option value="'.$pmlk[id].'" selected="selected">'.$pmlk[nama].'</option>';
                        }else{
                            echo '<option value="'.$pmlk[id].'">'.$pmlk[nama].'</option>';
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td> : <textarea id="keterangan" name="keterangan" rows="5" cols="53"><?php echo $r[keterangan]; ?></textarea></td>
    </tr>
    <tr>
        <td>Fasilitas</td>
        <td>
            <ul class="fasilitas">
                <?php
                $fasilitas_kost = mysql_query('SELECT * FROM fasilitas_kost WHERE kost_id='.$_GET[id]);
                while ($r_fasilitas_kost = mysql_fetch_array($fasilitas_kost)){
                    $check[] = $r_fasilitas_kost['fasilitas_id'];
                }
                
                $q_fasilitas = mysql_query('SELECT * FROM fasilitas');
                while ($r_fasilitas = mysql_fetch_array($q_fasilitas)) {
                    if(in_array($r_fasilitas[id],$check)){
                        echo '<li><input type="checkbox" name="fasilitas[]" value="' . $r_fasilitas['id'] . '" checked="checked"/>';
                        echo '<span>' . $r_fasilitas['nama'] . '</span></li>';
                    }else{
                        echo '<li><input type="checkbox" name="fasilitas[]" value="' . $r_fasilitas['id'] . '"/>';
                        echo '<span>' . $r_fasilitas['nama'] . '</span></li>';
                    }
                }
                ?>
            </ul>
        </td>
    </tr>
        <tr>
            <td>Status</td>
            <td> : 
                <?php if ($r['aktif']) { ?>
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
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=kost' "/>
        </td>
    </tr>
</table>
</form>