<?php

include '../auth/cek_login.php';
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $prioritas = $_POST['prioritas'];
    $status = $_POST['status'];
    $user_id = $_SESSION['id'];

    $query = "INSERT INTO tasks
              (judul_task, deskripsi, deadline, prioritas, status_task, user_id)
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $judul,
        $deskripsi,
        $deadline,
        $prioritas,
        $status,
        $user_id
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html id="htmlRoot">
<head>
    <title>Tambah Task</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="min-h-screen flex items-center justify-center text-slate-800 transition duration-300">

<div class="main-card w-[90%] max-w-xl bg-white/95 rounded-3xl shadow-2xl p-8 transition duration-300">

    <h2 class="text-4xl font-bold text-blue-700 mb-6 text-center">
        Tambah Task
    </h2>

    <form method="POST" onsubmit="return validateTaskForm()">

        <input
            type="text"
            name="judul"
            placeholder="Judul Task"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <textarea
            name="deskripsi"
            placeholder="Deskripsi"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>

        <input
            type="date"
            name="deadline"
            id="deadline"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            name="prioritas"
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="Rendah">Rendah</option>
            <option value="Sedang">Sedang</option>
            <option value="Tinggi">Tinggi</option>
        </select>

        <select
            name="status"
            class="w-full border border-slate-300 rounded-xl p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="Belum Selesai">Belum Selesai</option>
            <option value="Selesai">Selesai</option>
        </select>

        <button
            type="submit"
            name="simpan"
            class="w-full bg-blue-700 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition"
        >
            Simpan
        </button>

    </form>

    <a href="index.php" class="block text-center mt-5 text-blue-700 font-bold">
        Kembali ke Dashboard
    </a>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>

