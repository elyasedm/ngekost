<?php

require_once "../config/koneksi.php";

$pass = md5($_POST['password']);
$login = mysql_query("SELECT * FROM pelanggan WHERE email = '" . $_POST['username'] . "' AND password = '" . $pass . "'");
$ketemu = mysql_num_rows($login);
$r = mysql_fetch_array($login);
if (!isset($_GET['url'])) {
    $uri = '../index.php';
} else {
    $uri = $_GET[url];
}
if ($ketemu > 0) {
    if ($r['aktif']) {
        session_start();
        $_SESSION['member'] = array(
            'id' => $r['id'],
            'email' => $r['email'],
            'nama' => $r['nama'],
            'password' => $r['password'],
            'time' => date('Y-m-d H:i:s')
        );
        header('Location:'.$uri);
    } else {
        echo "<script>alert('Maaf User $r[nama] sedang Non-Aktif. Hubungi Administrator untuk mengaktifkan kembali.'); window.location = '../index.php?url=" . urlencode($uri) . "'</script>";
    }
} else {
    echo "<script>alert('Username dan Password Tidak Sesuai'); window.location = '../index.php?pages=login&url=" . urlencode($uri) . "'</script>";
}
?>
