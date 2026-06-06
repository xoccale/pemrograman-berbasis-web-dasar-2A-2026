<?php

include '../auth/cek_login.php';
include '../config/koneksi.php';


if($_SESSION['role'] == 'admin'){

    $query = "SELECT * FROM tasks ORDER BY id DESC";

    $result = mysqli_query($conn, $query);

} else {

    $user_id = $_SESSION['id'];

    $query = "SELECT * FROM tasks
              WHERE user_id=?
              ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $user_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
}

if($_SESSION['role'] == 'admin'){

    $totalQuery = mysqli_query(
        $conn,
        "SELECT COUNT(*) as total FROM tasks"
    );

    $selesaiQuery = mysqli_query(
        $conn,
        "SELECT COUNT(*) as selesai FROM tasks WHERE status_task='Selesai'"
    );

    $belumQuery = mysqli_query(
        $conn,
        "SELECT COUNT(*) as belum FROM tasks WHERE status_task='Belum Selesai'"
    );

    $tinggiQuery = mysqli_query(
        $conn,
        "SELECT COUNT(*) as tinggi FROM tasks WHERE prioritas='Tinggi'"
    );

} else {

    $user_id = $_SESSION['id'];

    $totalQuery = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) as total FROM tasks WHERE user_id=?"
    );

    mysqli_stmt_bind_param($totalQuery, "i", $user_id);
    mysqli_stmt_execute($totalQuery);
    $totalQuery = mysqli_stmt_get_result($totalQuery);


    $selesaiQuery = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) as selesai FROM tasks
         WHERE status_task='Selesai' AND user_id=?"
    );

    mysqli_stmt_bind_param($selesaiQuery, "i", $user_id);
    mysqli_stmt_execute($selesaiQuery);
    $selesaiQuery = mysqli_stmt_get_result($selesaiQuery);


    $belumQuery = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) as belum FROM tasks
         WHERE status_task='Belum Selesai' AND user_id=?"
    );

    mysqli_stmt_bind_param($belumQuery, "i", $user_id);
    mysqli_stmt_execute($belumQuery);
    $belumQuery = mysqli_stmt_get_result($belumQuery);


    $tinggiQuery = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) as tinggi FROM tasks
         WHERE prioritas='Tinggi' AND user_id=?"
    );

    mysqli_stmt_bind_param($tinggiQuery, "i", $user_id);
    mysqli_stmt_execute($tinggiQuery);
    $tinggiQuery = mysqli_stmt_get_result($tinggiQuery);
}

$totalTask = mysqli_fetch_assoc($totalQuery);
$taskSelesai = mysqli_fetch_assoc($selesaiQuery);
$taskBelum = mysqli_fetch_assoc($belumQuery);
$taskTinggi = mysqli_fetch_assoc($tinggiQuery);

?>

<!DOCTYPE html>
<html id="htmlRoot">

<head>

    <title>Dashboard Task</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="min-h-screen text-slate-800 transition duration-300">

<div class="main-card w-[90%] max-w-6xl mx-auto mt-10 bg-white/95 rounded-3xl shadow-2xl p-8 transition duration-300">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-4xl font-bold text-blue-700">
                Task Manager
            </h1>

            <p class="text-slate-500 mt-2">
                Login sebagai:
                <b><?= htmlspecialchars($_SESSION['username']) ?></b>
                (<?= htmlspecialchars($_SESSION['role']) ?>)
            </p>

        </div>

        <div class="flex gap-3 items-center">

            <button
                type="button"
                class="dark-toggle"
                onclick="toggleDarkMode()"
            >
                <span class="toggle-ball">☀️</span>
                <span class="toggle-label">LIGHT</span>
            </button>

            <a
                href="tambah.php"
                class="bg-violet-700 text-white px-5 py-3 rounded-xl font-bold hover:bg-violet-600 transition"
            >
                Tambah Task
            </a>

            <a
                href="../auth/logout.php"
                class="bg-red-600 text-white px-5 py-3 rounded-xl font-bold hover:bg-red-700 transition"
            >
                Logout
            </a>

        </div>

    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="stat-card bg-blue-600 text-white rounded-2xl p-5 shadow-lg">
            <p class="text-sm opacity-80">
                Total Task
            </p>

            <h2 class="text-3xl font-bold">
                <?= $totalTask['total'] ?>
            </h2>
        </div>

        <div class="stat-card bg-green-600 text-white rounded-2xl p-5 shadow-lg">
            <p class="text-sm opacity-80">
                Selesai
            </p>

            <h2 class="text-3xl font-bold">
                <?= $taskSelesai['selesai'] ?>
            </h2>
        </div>

        <div class="stat-card bg-red-600 text-white rounded-2xl p-5 shadow-lg">
            <p class="text-sm opacity-80">
                Belum Selesai
            </p>

            <h2 class="text-3xl font-bold">
                <?= $taskBelum['belum'] ?>
            </h2>
        </div>

        <div class="stat-card bg-yellow-500 text-white rounded-2xl p-5 shadow-lg">
            <p class="text-sm opacity-80">
                Prioritas Tinggi
            </p>

            <h2 class="text-3xl font-bold">
                <?= $taskTinggi['tinggi'] ?>
            </h2>
        </div>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-2xl">

        <table class="w-full border-collapse overflow-hidden rounded-2xl">

            <thead>

                <tr class="bg-blue-700 text-white">

                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">📝 Tugas</th>
                    <th class="p-4 text-left">📢 Deadline</th>
                    <th class="p-4 text-left">💢 Prioritas</th>
                    <th class="p-4 text-left">💡 Status</th>
                    <th class="p-4 text-left">✏️ Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php
            $no = 1;
            while($row = mysqli_fetch_assoc($result)) :
            ?>

                <tr class="border-b border-slate-200 hover:bg-slate-100 transition">

                    <td class="p-4">
                        <?= $no++ ?>
                    </td>

                    <td class="p-4">
                        <?= htmlspecialchars($row['judul_task']) ?>
                    </td>

                    <td class="p-4">
                        <?= htmlspecialchars($row['deadline']) ?>
                    </td>

                    <td class="p-4">
                        <?= htmlspecialchars($row['prioritas']) ?>
                    </td>

                    <td class="p-4">
                        <?= htmlspecialchars($row['status_task']) ?>
                    </td>

                    <td class="p-4">

                        <div class="flex gap-2">

                            <a
                                href="edit.php?id=<?= $row['id'] ?>"
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition"
                            >
                                Edit
                            </a>

                            <?php if($_SESSION['role'] == 'admin') : ?>

                            <a
                                href="hapus.php?id=<?= $row['id'] ?>"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition"
                                onclick="return confirmDelete()"
                            >
                                Hapus
                            </a>

                            <?php endif; ?>

                        </div>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<footer class="text-center text-white py-6">
    <p>&copy; 2026 Task Manager. All rights reserved. | SSR Developer</p>
</footer>

<script src="../assets/js/script.js"></script>

</body>
</html>