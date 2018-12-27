<?php

require_once "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/library.php";

$_POST['password'] = md5($_POST['password']);
$login = mysql_query("SELECT * FROM admin WHERE id = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'");
$ketemu = mysql_num_rows($login);
$r = mysql_fetch_array($login);
if ($ketemu > 0) {
    if ($r[aktif]) {
        session_start();
        $_SESSION['admin'] = array(
            'id' => $r['id'],
            'nama' => $r['nama'],
            'email' => $r['email'],
            'password' => $r['password'],
            'role' => $r['batasan'],
            'login_time' => $hari_ini . ', ' . tgl_indo(date("Y m d")) . ' | ' . date("H:i:s") . ' WIB',
            'login' => date('Y-m-d H:i:s')
        );
        header('Location:media.php');
    } else {
        echo "<script>alert('Maaf User $r[nama] sedang Non-Aktif. Hubungi Administrator untuk mengaktifkan kembali.'); window.location = 'index.php'</script>";
    }
} else {
    echo "<script>alert('Username dan Password Tidak Sesuai'); window.location = 'index.php'</script>";
}
?>
