<script language="javascript">
    function validasi(form_data){
        if (form_data.username.value == ""){
            alert("Anda belum mengisikan Username.");
            form_data.username.focus();
            return (false);
        }
     
        if (form_data.password.value == ""){
            alert("Anda belum mengisikan Password.");
            form_data.password.focus();
            return (false);
        }
        return true;
    }
</script>
<div class="contact">
    <div class="content-table">
        <center>
            <h1>Login Pelanggan</h1>
            <form action="action/validasi.php<?php if (isset($_GET['url'])) echo '?url=' . urlencode($_GET['url']) ?>" method="post" onSubmit="return validasi(this)" id="form_data" >
                <table style="width: 400px">
                    <tr>
                        <th><label for="username">Email</label></th>
                        <td><input type="text" name="username" id="username"/></td>
                    </tr>
                    <tr>
                        <th><label for="password">Password</label></th>
                        <td><input type="password" name="password" id="password"/></td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td><input type="submit" value="Login"/></td>
                    </tr>
                </table>
            </form>
            <h2><a href="?pages=register<?php if (isset($_GET['url'])) echo '&url=' . urlencode($_GET['url']) ?>">Register</a></h2>
        </center>
    </div>
</div>