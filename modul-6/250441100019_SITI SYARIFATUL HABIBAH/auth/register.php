<?php
include '../config/koneksi.php';

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(username,password,role)
              VALUES(?,?,?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $username,
        $passwordHash,
        $role
    );

    mysqli_stmt_execute($stmt);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html id="htmlRoot">
<head>
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="min-h-screen flex items-center justify-center text-slate-800 transition duration-300">

<div class="main-card w-[90%] max-w-md bg-white/95 rounded-3xl shadow-2xl p-8 transition duration-300">

    <h2 class="text-4xl font-bold text-blue-700 mb-2 text-center">
        Register
    </h2>

    <p class="text-slate-500 text-center mb-6">
        Buat akun Task Manager
    </p>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Username"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            class="w-full border border-slate-300 rounded-xl p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            name="role"
            class="w-full border border-slate-300 rounded-xl p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button
            type="submit"
            name="register"
            class="w-full bg-blue-700 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition"
        >
            Register
        </button>

    </form>

    <p class="text-center mt-5 text-slate-600">
        Sudah punya akun?
        <a href="login.php" class="text-blue-700 font-bold">
            Login
        </a>
    </p>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>
