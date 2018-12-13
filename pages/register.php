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

        if(!form_data.email.value.match(email)){
            alert("Penulisan Email Salah.");
            form_data.email.focus();
            return false;
        }
   
        if($('#email-message').attr('data-id') == 'false'){
            alert("Email masih invalid.");
            form_data.email.focus();
            return (false);
        }

        if (form_data.no_hp.value == ""){
            alert("Anda belum mengisikan No. Handphone.");
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
        var email   = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        $('#email').focusout(function(){
            $.ajax({
                url: "action/cek_username.php?table=pelanggan&id="+$(this).val(),
                success: function(data){
                    if(parseInt(data) > 0 || $('#email').val() == '' || !($('#email').val()).match(email)){
                        $('#email-message').attr('class','red').html('Username Invalid').attr('data-id','false');
                    }else{
                        $('#email-message').attr('class','green').html('Username valid').attr('data-id','true');
                    }
                }
            });
        });
    });
</script>

<div class="contact">
    <div class="content-table">
        <center>
            <h1>Register Pelanggan</h1>
            <form onSubmit="return validasi(this)" id="form_data" enctype="multipart/form-data" action="action/register.php<?php if (isset($_GET['url'])) echo '?url=' . urlencode($_GET['url']) ?>" method="post">
                <table style="width: 800px">
                    <tr>
                        <th width="180px"><label for="nama">Nama <span class="red">*</span></label></th>
                        <td><input type="text" name="nama" id="nama" size="40" onkeypress="return isAlfabetKeyAndSpace(event)"/></td>
                    </tr>
                    <tr>
                        <th><label for="ktp">No. KTP <span class="red">*</span></label></th>
                        <td><input type="text" name="ktp" id="ktp" size="40" onkeypress="return isNumberKey(event)"/></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email <span class="red">*</span></label></th>
                        <td><input type="text" name="email" id="email" size="40" onkeypress="return isEmail(event)"/><span style="margin-left: 20px;" id="email-message" data-id="false"></span></td>
                    </tr>
                    <tr>
                        <th><label for="alamat">Alamat</label></th>
                        <td><textarea name="alamat" rows="3" cols="56"></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="jk">Jenis Kelamin <span class="red">*</span></label></th>
                        <td>
                            <input type="radio" name="jk" id="l" value="L" checked="checked"/><label for="l">Laki-laki</label>
                            <input type="radio" name="jk" id="p" value="P"/><label for="p">Perempuan</label>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hp">No. Handphone <span class="red">*</span></label></th>
                        <td><input type="text" name="no_hp" id="hp" size="40" onkeypress="return isNumberKey(event)"/></td>
                    </tr>
                    <tr>
                        <th><label for="kampus">Kampus</label></th>
                        <td><input type="text" name="kampus" id="kampus" size="40" onkeypress="return isAlfabetKeyAndSpace(event)"/></td>
                    </tr>
                    <tr>
                        <th><label for="password">Password <span class="red">*</span></label></th>
                        <td><input type="password" name="password" id="password" size="40"/></td>
                    </tr>
                    <tr>
                        <th><label for="k_password">Password Konfirmasi <span class="red">*</span></label></th>
                        <td><input type="password" name="k_password" id="k_password" size="40"/></td>
                    </tr>
                    <tr>
                        <th><label for="photo">Foto</label></th>
                        <td><input type="file" name="photo" id="photo" size="40"/></td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td><input type="submit" value="Daftar"/></td>
                    </tr>
                </table>
            </form>
            <h2><a href="?pages=login<?php if (isset($_GET['url'])) echo '&url=' . urlencode($_GET['url']) ?>">Login</a></h2>
        </center>
    </div>
</div>