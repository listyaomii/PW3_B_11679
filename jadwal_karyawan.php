<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ./login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // gamabr disesuaikan dengan posisinya karyawan
    $image = '';
    switch ($_POST["posisi"]) {
        case 'daily-worker':
            $image = './assets/images/image3.jpg'; // Gambar untuk daily worker
            break;
        case 'part-timer':
            $image = './assets/images/image2.jpg'; // Gambar untuk part-timer
            break;
        case 'full-timer':
            $image = './assets/images/image1.jpg'; // Gambar untuk full-timer
            break;
    }


    $new_schedule = [
        "tanggal_masuk" => $_POST["tanggal_masuk"],
        "posisi" => $_POST["posisi"],
        "gaji" => $_POST["gaji"],
        "pajak_gaji" => $_POST["pajak_gaji"],
        "nama_karyawan" => $_POST["nama_karyawan"],
        "deskripsi" => $_POST["deskripsi"],
        "image" => $image
    ];

  
    $_SESSION["room_list"][] = $new_schedule;


    $_SESSION["success"] = "Jadwal Karyawan berhasil ditambahkan!";
    header("Location: ./dashboard.php");
    exit;
}

$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restaurant & Bar",
    "page_title" => "Tambah Jadwal Karyawan",
    "logo" => "./assets/images/HatCook.png",
    "user" => "Komang Listya Omi Pradnyani/220711679"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $detail["page_title"]; ?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="./assets/css/poppins.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        .crown-logo {
            max-width: 45px;
            height: auto;
        }
    </style>
</head>

<body>
    <header class="fixed-top" id="navbar">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn" style="background-color: #EE4D2D;">
                <img src="<?php echo $detail['logo']; ?>" class="crown-logo" />
                <div>
                    <p class="mb-0 fs-5 fw-bold text-"><?php echo $detail['name']; ?></p>
                    <p class="small mb-0"><?php echo $detail['tagline']; ?></p>
                </div>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="./" class="nav-link" style="color: #EE4D2D;">Home</a>
                </li>
                <li class="nav-item ms-3">
                    <a href="./tambah_karyawan.php" class="nav-link active" style="background-color: #EE4D2D;" aria-current="page">Admin Panel</a>
                </li>
                <li class="nav-item">
                    <a href="./processLogout.php" class="nav-link text-danger">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container" style="padding-top: 84px;">
        <h1 class="mt-5 mb-3 border-bottom fw-bold">Tambah Jadwal Karyawan</h1>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk Karyawan</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>

            <div class="mb-3">
                <label for="posisi" class="form-label">Jadwal Karyawan</label>
                <select class="form-select" name="posisi" id="posisi" required>
                    <option value="">Pilih Posisi</option>
                    <option value="full-timer">Full-Timer</option>
                    <option value="part-timer">Part-Timer</option>
                    <option value="daily-worker">Daily Worker</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="gaji" class="form-label">Gaji</label>
                <input type="number" class="form-control" id="gaji" name="gaji" required>
            </div>

            <div class="mb-3">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
            </div>
            <button type="submit" class="btn btn-danger">Simpan</button>
        </form>
    </main>

    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>
