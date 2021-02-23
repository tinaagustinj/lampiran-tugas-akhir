<?php
session_start(); // Start session nya

include "koneksi.php"; // Load file koneksi.php

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($connect, "SELECT username, password FROM user WHERE username=BINARY'$username' AND password=MD5('$password')");
//$sql = mysqli_query($connect, "select * from user where username='$username' and password='$password'");

$data = mysqli_fetch_array($sql);

// Cek apakah variabel $data ada datanya atau tidak
if( ! empty($data)){ // Jika tidak sama dengan empty (kosong)
  $_SESSION['username'] = $data['username']; // Set session untuk username (simpan username di session)
  $_SESSION['password'] = $data['password']; // Set session untuk nama (simpan nama di session)
  
  setcookie("message","delete",time()-1); // Kita delete cookie message
  
  header("location:index.php"); // Kita redirect ke halaman welcome.php
}else{ // Jika $data nya kosong
  // Buat sebuah cookie untuk menampung data pesan kesalahan
  setcookie("message", "Maaf, Username atau Password salah", time()+3600);
  
  header("location:login.php?pesan=gagal"); // Redirect kembali ke halaman index.php
}
?>
