<?php

include '../auth/cek_login.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak");
}

$id = $_GET['id'];

$query = "DELETE FROM tasks WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

header("Location: index.php");

?>