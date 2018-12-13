<script language="javascript">
    function validasi(form_data){
        var email   = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var telp    = /^0[0-9]{8,12}$/;
        
        if (form_data.nama.value == ""){
            alert("Anda belum mengisikan Nama.");
            form_data.nama.focus();
            return (false);
        }
     
        if (form_data.ktp.value == ""){
            alert("Anda belum mengisikan No. KTP.");
            form_data.ktp.focus();
            return (false);
        }
     
        if (form_data.email.value == ""){
            alert("Anda belum mengisikan Email.");
            form_data.email.focus();
            return (false);
        }

        if (form_data.no_hp.value == ""){
            alert("Anda belum mengisikan No. Handphone.");
            form_data.no_hp.focus();
            return (false);
        }
     
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

<div class="contact">
    <?php
    $user = mysql_query('SELECT * FROM pelanggan WHERE id = "' . $_SESSION['member']['id'] . '"');
    $r = mysql_fetch_array($user);
    ?>
    <h1>Edit Profile User</h1>
    <div class="content-table">
        <form onSubmit="return validasi(this)" id="form_data" method="post" action="action/edit_profile.php" enctype="multipart/form-data" >
            <table>
                <tr>
                    <th width="200px">Nama <span class="red">*</span></th>
                    <td><input type="text" name="nama" size="40" value="<?php echo $r[nama] ?>" onkeypress="return isAlfabetKeyAndSpace(event)"/></td>
                    <td rowspan="7" width="235px">
                        <img src="
                        <?php
                        if (empty($r[photo])) {
                            echo "photos/na.jpg";
                        } else {
                            echo 'photos/small_' . $r[photo];
                        }
                        ?>
                             " style="width: 215px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;border:2px solid #000;"/>
                    </td>
                </tr>
                <tr>
                    <th>No. KTP <span class="red">*</span></th>
                    <td><input type="text" name="ktp" size="40" value="<?php echo $r[ktp] ?>" onkeypress="return isNumberKey(event)"/></td>
                </tr>
                <tr>
                    <th>Email <span class="red">*</span></th>
                    <td><input type="text" name="email" size="40" value="<?php echo $r[email] ?>" readonly="readonly" onkeypress="return isEmail(event)"/></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><textarea name="alamat" rows="3" cols="56"><?php echo $r[alamat] ?></textarea></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <?php if ($r[jenis_kelamin] == 'L') { ?>
                        <td>
                            <input type="radio" name="jenis_kelamin" value="L" checked="checked"/> Laki-laki 
                            <input type="radio" name="jenis_kelamin" value="P"/> Perempuan                            
                        </td>
                    <?php } else { ?>
                        <td>
                            <input type="radio" name="jenis_kelamin" value="L"/> Laki-laki 
                            <input type="radio" name="jenis_kelamin" value="P" checked="checked"/> Perempuan                            
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <th>No. Handphone <span class="red">*</span></th>
                    <td><input type="text" name="no_hp" size="40" value="<?php echo $r[no_hp] ?>" onkeypress="return isNumberKey(event)"/></td>
                </tr>
                <tr>
                    <th>Kampus</th>
                    <td><input type="text" name="kampus" size="40" value="<?php echo $r[kampus] ?>"/></td>
                </tr>
                <tr>
                    <th>Edit Password</th>
                    <td>
                        <input type="radio" class="edit_pass" value="ya" name="edit_pass"/>Ya 
                        <input type="radio" class="edit_pass" value="tidak" name="edit_pass" checked="checked"/>Tidak
                    </td>
                    <td><input type="file" name="photo" size="10"/></td>
                </tr>
                <tr class="password" style="display: none">
                    <th>Password Lama</th>
                    <td colspan="2"><input type="password" size="40" name="password"/></td>
                </tr>
                <tr class="password" style="display: none">
                    <th>Password Baru</th>
                    <td colspan="2"><input type="password" size="40" name="password_new"/></td>
                </tr>
                <tr class="password" style="display: none">
                    <th>Konfirmasi Password</th>
                    <td colspan="2"><input type="password" size="40" name="password_conf"/></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th align="center" colspan="2"><input type="submit" value="Simpan"/></th>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('.edit_pass').live('click',function(){
        $('.password').hide();
        if($(this).val() == 'ya'){
            $('.password').show();
        }
    })
</script>