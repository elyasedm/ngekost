<?php
  session_start();
  $count = count($_SESSION);
  unset($_SESSION['admin']);
  if($count == 1){
      session_destroy();
  }
  echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = 'index.php'</script>";
?>