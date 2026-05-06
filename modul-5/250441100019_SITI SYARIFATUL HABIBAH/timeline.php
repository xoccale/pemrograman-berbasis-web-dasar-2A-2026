<?php
function tandai($tahun){
    if($tahun == "2026"){
        return "<span class='highlight'>$tahun</span>";
    }
    return "<span class='normal'>$tahun</span>";
}

$timeline = [
    ["tahun"=>"2024-Desember", "ket"=>"Mulai tertarik dengan dunia coding"],
    ["tahun"=>"2025-Agustus", "ket"=>"Mulai masuk kuliah / belajar coding"],
    ["tahun"=>"2025-September", "ket"=>"Mengenal logika Python dan algoritma dasar"],
    ["tahun"=>"2025-Oktober", "ket"=>"Mulai belajar Python"],
    ["tahun"=>"2026", "ket"=>"Belajar HTML, CSS, JavaScript, dan PHP"],
    ["tahun"=>"2026", "ket"=>"Belajar lebih lanjut tentang HTML, CSS, JavaScript, dan PHP"]
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Timeline</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #1E90FF, #7b28e8);
    color: white;
}

.header {
    text-align: center;
    padding: 28px 20px;
    font-size: 28px;
    font-weight: 700;
    color: white;
}

.timeline {
    position: relative;
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    padding: 20px;
}

.timeline::before {
    content: '';
    position: absolute;
    width: 3px;
    background: rgb(0, 0, 0);
    top: 0;
    bottom: 0;
    left: 20px;
}

.item {
    padding: 20px 20px 20px 70px;
    position: relative;
    margin-bottom: 20px;
}

.left {
    left: 0;
}

.right {
    left: 0;
}

.content {
    background: #ffffff;
    color: #1f2937;
    padding: 16px;
    border-radius: 12px;
    border-left: 4px solid #ff0000;
}

.circle {
    position: absolute;
    width: 16px;
    height: 16px;
    background: #ff0000;
    border: 3px solid #000000;
    border-radius: 50%;
    top: 28px;
    left: 12px;
    z-index: 1;
}

.left .circle {
    left: 12px;
}
.right .circle {
    left: 12px;
}

.highlight {
    background: #7b28e8;
    color: white;
    padding: 4px 10px;
    border-radius: 8px;
    font-weight: 700;
}
.normal {
    color: #000000;
    font-weight: 700;
}

.footer {
    text-align: center;
    margin: 30px;
}
.footer a {
    color: white;
    text-decoration: none;
    margin: 0 12px;
}
.footer a:hover {
    text-decoration: underline;
}
</style>

</head>

<body>

<div class="header">
    Cale's Timeline 🚀
</div>

<div class="timeline">

<?php foreach($timeline as $index => $t): ?>
    <div class="item <?= $index % 2 == 0 ? 'left' : 'right' ?>">
        
        <div class="circle"></div>

        <div class="content">
            <b><?= tandai($t['tahun']) ?></b>
            <p><?= $t['ket'] ?></p>
        </div>

    </div>
<?php endforeach; ?>

</div>

<div class="footer">
    <a href="index.php"> Kembali ke Profil</a> //
    <a href="blog.php">Ke Blog </a>
</div>

</body>
</html>