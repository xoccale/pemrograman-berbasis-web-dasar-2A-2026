<?php
session_start();
function tampilkanData($data) {
    echo "<table class='hasil-table'>";
    foreach ($data as $key => $value) {
        echo "<tr>
                <td><b>$key</b></td>
                <td>$value</td>
              </tr>";
    }
    echo "</table>";
}

$pesan = "";
$data = null;

if (!isset($_SESSION['data_list'])) {
    $_SESSION['data_list'] = [];
}

if (isset($_POST['submit'])) {

    $framework   = $_POST['framework'] ?? '';
    $pengalaman  = $_POST['pengalaman'] ?? '';
    $tools       = $_POST['tools'] ?? [];
    $minat       = $_POST['minat'] ?? '';
    $skill       = $_POST['skill'] ?? '';

    if ($framework == "" || $pengalaman == "" || $minat == "" || $skill == "") {
        $pesan = "Semua input wajib diisi!";
    } else {

        $frameworkArray = explode(",", $framework);

        if (count($frameworkArray) > 2) {
            $pesan = "Skill Anda cukup luas di bidang development!";
        }

        $data = [
            "Framework"   => implode(", ", $frameworkArray),
            "Tools"       => !empty($tools) ? implode(", ", $tools) : '-',
            "Minat"       => $minat,
            "Skill Level" => $skill,
            "Pengalaman"  => $pengalaman
        ];

        $_SESSION['data_list'][] = $data;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profil Developer</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f4f7ff;
    color: #1f2937;
}

.header {
    background: transparent;
    color: #1f2937;
    padding: 24px 20px 10px;
    text-align: center;
    font-size: 26px;
    font-weight: 700;
}

.main {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    padding: 20px;
    max-width: 1080px;
    margin: 0 auto;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    flex: 1 1 320px;
    min-width: 280px;
}
.card h3 {
    text-align: center;
    margin-top: 0;
}

.profile-table,
.hasil-table {
    width: 100%;
    border-collapse: collapse;
}
.profile-table td,
.hasil-table td {
    border: 1px solid #e2e8f0;
    padding: 10px;
}

input[type="text"], textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 8px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 12px;
    background: #4f46e5;
    border: none;
    color: white;
    font-weight: 700;
    border-radius: 10px;
    cursor: pointer;
}
button:hover {
    background: #4338ca;
}

.nav-links {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 20px;
}

.nav-links a {
    display: inline-block;
    padding: 12px 20px;
    background: #2563eb;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
}

.nav-links a:hover {
    background: #1d4ed8;
}

.pesan {
    margin-top: 12px;
    padding: 12px;
    background: #fee2e2;
    color: #b91c1c;
    border-radius: 10px;
}

.section {
    margin-bottom: 16px;
}
</style>

</head>

<body>

<div class="header">
    Profil Developer Interaktif 🚀
</div>

<div class="main">

<div class="card">
    <h3>Data Diri</h3>
    <table class="profile-table">
        <tr><td>Nama</td><td>Siti Syarifatul habibah</td></tr>
        <tr><td>ID Developer</td><td>DEV 0409</td></tr>
        <tr><td>Kota/Tgl Lahir</td><td>Surabaya, 4 Januari 2007</td></tr>
        <tr><td>Email</td><td>rrmantio@email.com</td></tr>
        <tr><td>No WA</td><td>08819053239</td></tr>
    </table>
</div>

<div class="card">
    <h3>Form Input</h3>

    <form method="POST">

    <div class="section">
        Framework:
        <input type="text" name="framework">
    </div>

    <div class="section">
        Pengalaman:
        <textarea name="pengalaman"></textarea>
    </div>

    <div class="section">
        Tools:<br>
        <input type="checkbox" name="tools[]" value="VS Code"> VS Code
        <input type="checkbox" name="tools[]" value="GitHub"> GitHub
        <input type="checkbox" name="tools[]" value="Figma"> Figma
        <input type="checkbox" name="tools[]" value="Postman"> Postman
    </div>

    <div class="section">
        Minat:<br>
        <input type="radio" name="minat" value="Frontend"> Frontend
        <input type="radio" name="minat" value="Backend"> Backend
        <input type="radio" name="minat" value="Fullstack"> Fullstack
    </div>

    <div class="section">
        Skill:
        <select name="skill">
            <option value="">--Pilih--</option>
            <option>Dasar</option>
            <option>Cukup</option>
            <option>Profesional</option>
        </select>
    </div>

    <button type="submit" name="submit">Kirim</button>

    </form>

    <?php
    if (!empty($data)) {
        echo "<h3>Hasil Terbaru</h3>";
        tampilkanData($data);
        echo "<p><b>Pengalaman:</b> $pengalaman</p>";
    }

    if (!empty($_SESSION['data_list'])) {
        echo "<h3>Riwayat Hasil</h3>";
        foreach ($_SESSION['data_list'] as $item) {
            tampilkanData($item);
            echo "<p><b>Pengalaman:</b> " . ($item['Pengalaman'] ?? 'Tidak ada') . "</p>";
            echo "<hr>";
        }
    }

    if ($pesan != "") {
        echo "<div class='pesan'>$pesan</div>";
    }
    ?>
</div>

</div>

<div class="nav-links">
    <a href="timeline.php">Lihat Timeline</a>
</div>

</body>
</html>