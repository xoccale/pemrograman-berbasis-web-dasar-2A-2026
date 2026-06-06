<?php>

// SELECT WHERE
$stmt = $conn->prepare("SELECT * FROM guru WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
// DELETE
$stmt = $conn->prepare("DELETE FROM guru WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

session_start(); // Mulai/lanjutkan session — WAJIB di awal file
$_SESSION['user_id'] = 7; // Simpan data ke session
echo $_SESSION['user_id']; // Baca data dari session
session_destroy(); // Hancurkan session (logout)

// Saat REGISTER — simpan hash
$hash = password_hash("rahasia123", PASSWORD_DEFAULT);
// Saat LOGIN — verifikasi
if (password_verify($password_input, $hash_dari_database)) {
// Password benar
}

