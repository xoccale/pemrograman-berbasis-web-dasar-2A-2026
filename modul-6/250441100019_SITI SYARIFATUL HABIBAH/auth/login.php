<?php

session_start();

include '../config/koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username=?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){

        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id'] = $user['id'];

        header("Location: ../tasks/index.php");

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html id="htmlRoot">
<head>
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="min-h-screen flex items-center justify-center text-slate-800 transition duration-300">

<div class="main-card w-[90%] max-w-md bg-white/95 rounded-3xl shadow-2xl p-8 transition duration-300">

    <h2 class="text-4xl font-bold text-blue-700 mb-2 text-center">
        Login
    </h2>

    <p class="text-slate-500 text-center mb-6">
        Masuk ke Task Manager
    </p>

    <?php if(isset($error)) : ?>
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
            <?= $error ?>
        </div>
    <?php endif; ?>

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

        <button
            type="submit"
            name="login"
            class="w-full bg-blue-700 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition"
        >
            Login
        </button>

    </form>

    <p class="text-center mt-5 text-slate-600">
        Belum punya akun?
        <a href="register.php" class="text-blue-700 font-bold">
            Register
        </a>
    </p>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>