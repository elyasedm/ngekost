<script type="text/javascript">
    function validasi(form_data){
        
        var email   = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var telp    = /^0[0-9]{8,12}$/;
        
        if (form_data.id.value == ""){
            alert("Anda belum mengisikan Username.");
            form_data.id.focus();
            return (false);
        }
        
        if($('#username-message').attr('data-id') == 'false'){
            alert("Username masih invalid.");
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
        
        if (form_data.password.value == ""){
            alert("Anda belum mengisikan Password.");
            form_data.password.focus();
            return (false);
        }

        if (form_data.k_password.value == ""){
            alert("Anda belum mengisikan Konfirmasi Password.");
            form_data.k_password.focus();
            return (false);
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
   
        if (form_data.password.value.length < 5){
            alert("Password kurang dari 5 karakter.");
            form_data.password.focus();
            return (false);
        }

        if (form_data.password.value != form_data.k_password.value){
            alert("Konfirmasi Password tidak sama dengan password.");
            form_data.k_password.focus();
            return (false);
        }
        
        return (true);
    }
    
    $(document).ready(function(){
        $('#username').focusout(function(){
            $.ajax({
                url: "../action/cek_username.php?table=admin&id="+$(this).val(),
                success: function(data){
                    if(parseInt(data) > 0 || $('#username').val() == ''){
                        $('#username-message').attr('class','red').html('Username Invalid').attr('data-id','false');
                    }else{
                        $('#username-message').attr('class','green').html('Username valid').attr('data-id','true');
                    }
                }
            });
        });
    });
</script>
<h2>Tambah admin</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data"/>
<table>
    <tr>
        <td width="200px">Username</td>
        <td> : <input id="username" type=text name='id' size='40' onkeypress="return isAlfabetAndNumberKeyOnly(event)"/><span style="margin-left: 20px;" id="username-message" data-id="false"></span></td>
    </tr>
    <tr>
        <td>Email</td>
        <td> : <input type=text name='email' size='40' onkeypress="return isEmail(event)"/></td>
    </tr>
    <tr>
        <td>Nama Admin</td>
        <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetKeyAndSpace(event)"></td>
    </tr>
    <tr>
        <td>No. Handphone</td>
        <td> : <input type=text name='no_hp' size='40' onkeypress="return isNumberKey(event)"></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td> : <input type="radio" name="jenis_kelamin" value="L" checked="checked"/>Laki-laki 
        <input type="radio" name="jenis_kelamin" value="P"/>Perempuan</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> : <textarea name="alamat" rows="5" cols="53"></textarea></td>
    </tr>
    <tr>
        <td>Status</td>
        <td> : 
            <input type="radio" name="aktif" value="1" checked="checked"/>Aktif 
            <input type="radio" name="aktif" value="0"/>Non-Aktif
        </td>
    </tr>
    <tr>
        <td>Password</td>
        <td> : <input type=password name='password' size='40'/></td>
    </tr>
    <tr>
        <td>Konfirmasi Password</td>
        <td> : <input type=password name='k_password' size='40'/></td>
    </tr>
    <tr>
        <td colspan=2>
            <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=admin' "/>
        </td>
    </tr>
</table>
</form>