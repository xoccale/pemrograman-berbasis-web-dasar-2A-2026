<?php

include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM tasks WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $prioritas = $_POST['prioritas'];
    $status = $_POST['status'];

    $update = "UPDATE tasks
               SET
               judul_task=?,
               deskripsi=?,
               deadline=?,
               prioritas=?,
               status_task=?
               WHERE id=?";

    $stmtUpdate = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param(
        $stmtUpdate,
        "sssssi",
        $judul,
        $deskripsi,
        $deadline,
        $prioritas,
        $status,
        $id
    );

    mysqli_stmt_execute($stmtUpdate);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html id="htmlRoot">
<head>
    <title>Edit Task</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="min-h-screen flex items-center justify-center text-slate-800 transition duration-300">

<div class="main-card w-[90%] max-w-xl bg-white/95 rounded-3xl shadow-2xl p-8 transition duration-300">

    <h2 class="text-4xl font-bold text-blue-700 mb-6 text-center">
        Edit Task
    </h2>

    <form method="POST" onsubmit="return validateTaskForm()">

        <input
            type="text"
            name="judul"
            value="<?= htmlspecialchars($data['judul_task']) ?>"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <textarea
            name="deskripsi"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        ><?= htmlspecialchars($data['deskripsi']) ?></textarea>

        <input
            type="date"
            name="deadline"
            id="deadline"
            value="<?= htmlspecialchars($data['deadline']) ?>"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            name="prioritas"
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="Rendah" <?= $data['prioritas'] == 'Rendah' ? 'selected' : '' ?>>
                Rendah
            </option>

            <option value="Sedang" <?= $data['prioritas'] == 'Sedang' ? 'selected' : '' ?>>
                Sedang
            </option>

            <option value="Tinggi" <?= $data['prioritas'] == 'Tinggi' ? 'selected' : '' ?>>
                Tinggi
            </option>
        </select>

        <select
            name="status"
            class="w-full border border-slate-300 rounded-xl p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="Belum Selesai" <?= $data['status_task'] == 'Belum Selesai' ? 'selected' : '' ?>>
                Belum Selesai
            </option>

            <option value="Selesai" <?= $data['status_task'] == 'Selesai' ? 'selected' : '' ?>>
                Selesai
            </option>
        </select>

        <button
            type="submit"
            name="update"
            class="w-full bg-blue-700 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition"
        >
            Update
        </button>

    </form>

    <a href="index.php" class="block text-center mt-5 text-blue-700 font-bold">
        Kembali ke Dashboard
    </a>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>