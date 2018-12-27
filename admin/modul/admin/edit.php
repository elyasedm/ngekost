<?php
$edit = mysql_query("SELECT * FROM admin WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<script type="text/javascript">
    function validasi(form_data){
        var email   = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var telp    = /^0[0-9]{8,12}$/;
        
        if (form_data.id.value == ""){
            alert("Anda belum mengisikan Username.");
            form_data.id.focus();
            return (false);
        }

        if (form_data.email.value == ""){
            alert("Anda belum mengisikan Email.");
            form_data.email.focus();
            return (false);
        }
          
        if (form_data.nama.value == ""){
            alert("Anda belum mengisikan Nama.");
            form_data.nama.focus();
            return (false);
        }

        if (form_data.no_hp.value == ""){
            alert("Anda belum mengisikan No. HP.");
            form_data.no_hp.focus();
            return (false);
        }
        
        <?php if ($r[id] == $_SESSION['admin']['id']) { ?>
        if (form_data.password.value != ""){

            if (form_data.password_new.value == ""){
                alert("Anda belum mengisikan Password Baru.");
                form_data.password_new.focus();
                return (false);
            }
            
            if (form_data.password_new.value.length < 5){
                alert("Password Baru kurang dari 5 karakter.");
                form_data.password_new.focus();
                return (false);
            }

            if (form_data.password_conf.value == ""){
                alert("Anda belum mengisikan Konfirmasi Password.");
                form_data.password_conf.focus();
                return (false);
            }
            
            if (form_data.password_new.value != form_data.password_conf.value){
                alert("Konfirmasi Password tidak sama dengan password Baru.");
                form_data.password_conf.focus();
                return (false);
            }
        }
        <?php }else{ ?>
        if (form_data.password.value != ""){

            if (form_data.password.value.length < 5){
                alert("Password Baru kurang dari 5 karakter.");
                form_data.password.focus();
                return (false);
            }

            if (form_data.password_conf.value == ""){
                alert("Anda belum mengisikan Konfirmasi Password.");
                form_data.password_conf.focus();
                return (false);
            }
            
            if (form_data.password.value != form_data.password_conf.value){
                alert("Konfirmasi Password tidak sama dengan password Baru.");
                form_data.password_conf.focus();
                return (false);
            }
        }
        <?php } ?>
            
        if(!form_data.email.value.match(email)){
            alert("Penulisan Email Salah.");
            form_data.email.focus();
            return false;
        }
   
        if(!form_data.no_hp.value.match(telp)){
            alert("Penulisan No. Handphone salah.");
            form_data.no_hp.focus();
            return false;
        }
   
        return (true);
    }
</script>
<h2>Edit Admin</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=update" onSubmit="return validasi(this)" id="form_data">
    <table>
        <tr>
            <td width="180px;">Username</td>
            <td> : <input type=text name='id' size='40' value="<?php echo $r['id'] ?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td>Email</td>
            <td> : <input type=text name='email' size='40' value="<?php echo $r['email'] ?>"/></td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetKey(event)" value="<?php echo $r['nama'] ?>"></td>
        </tr>
        <tr>
            <td>No. Handphone</td>
            <td> : <input type=text name='no_hp' size='40' onkeypress="return isNumberKey(event)" value="<?php echo $r['no_hp'] ?>"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td> :
                <?php if ($r['jenis_kelamin'] == 'L') { ?>
                    <input type="radio" name="jenis_kelamin" value="L" checked="checked"/>Laki-laki 
                    <input type="radio" name="jenis_kelamin" value="P"/>Perempuan
                <?php } else { ?>
                    <input type="radio" name="jenis_kelamin" value="L"/>Laki-laki 
                    <input type="radio" name="jenis_kelamin" value="P" checked="checked"/>Perempuan
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td> : <textarea name="alamat" rows="5" cols="53"><?php echo $r['alamat'] ?></textarea></td>
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
            <td>Edit Password</td>
            <td>
                <input type="radio" class="edit_pass" value="ya" name="edit_pass"/>Ya 
                <input type="radio" class="edit_pass" value="tidak" name="edit_pass" checked="checked"/>Tidak
            </td>
        </tr>
        <?php if ($r[id] == $_SESSION['admin']['id']) { ?>
            <tr class="password" style="display: none">
                <td>Password Lama</td>
                <td> : <input type="password" size="40" name="password"/></td>
            </tr>
            <tr class="password" style="display: none">
                <td>Password Baru</td>
                <td> : <input type="password" size="40" name="password_new"/></td>
            </tr>
            <tr class="password" style="display: none">
                <td>Konfirmasi Password</td>
                <td> : <input type="password" size="40" name="password_conf"/></td>
            </tr>
        <?php } else { ?>
            <tr class="password" style="display: none">
                <td>Password Baru</td>
                <td> : <input type=password name='password' size='40'></td>
            </tr>
            <tr class="password" style="display: none">
                <td>Konfirmasi Password</td>
                <td> : <input type="password" size="40" name="password_conf"/></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=admin' "/>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $('.edit_pass').live('click',function(){
        $('.password').hide();
        if($(this).val() == 'ya'){
            $('.password').show();
        }
    })
</script>