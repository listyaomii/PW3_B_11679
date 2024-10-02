<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: ./login.php");
    exit;
}

if(!isset($_SESSION["room_list"])){
    $_SESSION["room_list"] = [];
}

// Cek jika ada hapus
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
    $index = $_POST["index"]; 
    if (isset($_SESSION["room_list"][$index])) {
        unset($_SESSION["room_list"][$index]);
        $_SESSION["success"] = "Karyawan berhasil dihapus!";
    } else {
        $_SESSION["success"] = "Karyawan tidak ditemukan!";
    }
    header("Location: ./dashboard.php");
    exit;
}

$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restaurant & Bar",
    "page_title" => "Atma Kitchen Restaurant & Co",
    "logo" => "./assets/images/HatCook.png",
    "user" => "Komang Listya Omi Pradnyani/220711679"
];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $detail["page_title"]; ?></title>
        <meta name ="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="<?php echo $detail["logo"]; ?>" type="image/x-icon" />

        <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="./assets/css/poppins.min.css" rel="stylesheet">

        <link rel="stylesheet" href="./assets/css/style.css" />

        <style>
            .img-bukti-ngantor {
                width: 100%;
                aspect-ratio: 1 / 1;
                object-fit: cover;
            }

/* buat ngatur isi dari card employee nya */
            .employee-card{
                display: flex;
                border: 1px solid #bbb;
                border-radius: 5px;
                overflow: hidden;
                margin-bottom: 20px;
            }
            .employee-card img {
                width: 150px;
                height: 150px;
                object-fit: cover;
            }

            .employee-details {
                flex-grow: 1;
                padding: 15px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .employee-details h5 {
                margin: 0;
                font-size: 1.2rem;
                font-weight: bold;
            }

            .employee-details p {
                margin: 5px 0;
            }

            .btn-delete {
                background-color: #dc3545;
                border: none;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn-delete:hover {
                background-color: #c82333;
            }

            .line {
                border: 0;
                height: 4px;
                background-color: #bbb; 
                width: 100%; 
                margin: 10px 0; 
            }

        </style>
    </head>

    <body>
        <header class="fixed-top scrolled" id="navbar">
            <nav class="container nav-top py-2">

                <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn " style="background-color: #EE4D2D;">
                <img src="<?php echo $detail['logo']; ?>" class="crown-logo" />
                <div> 
                    <p class="mb-0 fs-5 fw-bold text-"><?php echo $detail['name']; ?></p>
                    <p class="small mb-0 text-white"><?php echo $detail['tagline']; ?></p>
                </div>
            </a>

                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="./" class="nav-link" style="color: #EE4D2D;">Home</a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="#" class="nav-link active" style="background-color: #EE4D2D;" aria-current="page">Admin Panel</a>
                    </li>

                    <li class="nav-item">
                        <a href="./processLogout.php" class="nav-link text-danger">Logout</a>
                    </li>
                </ul>
            </nav>
        </header>

        <main style="padding-top: 84px;" class="container">
            <h1 class="mt-5 mb-3 border-bottom fw-bold">Dashboard</h1>

            <?php if(isset($_SESSION["success"])){ ?>
                <div class="alert alert-success mb-4 text-start" role="alert">
                    <strong>Berhasil!</strong> <?php echo $_SESSION["success"]; ?>
                </div>
            <?php
                unset($_SESSION["success"]);
            } ?>

            <div class="row">
                <div class="col-lg-10">
                    <div class="card card-body h-100 justify-content-center">
                        <h4>Selamat datang,</h4>
                        <h1 class="fw-bold display-6 mb-3"><?php echo $_SESSION["user"]["username"]; ?></h1>

                        <p class="mb-0">Kamu sudah login sejak:</p>
                        <p class="fw-bold lead mb-0"><?php echo $_SESSION["user"]["login_at"]; ?></p>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="card card-body">
                        <p>Bukti sedang ngantor:</p>
                        <img 
                            src="<?php echo $_SESSION["user"]["bukti_ngantor"]; ?>"
                            class="img-fluid rounded img-bukti-ngantor" 
                            alt="Bukti ngantor (sudah dihapus)" />
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <h2 class="fw-bold">Daftar Jadwal Karyawan Atma Kitchen</h2>
                <p>Saat ini terdapat <?php echo count($_SESSION["room_list"]); ?> Jadwal Karyawan.</p>
                <a href="jadwal_karyawan.php" class="btn btn-success w-50">+ Tambah Jadwal Karyawan</a>
            </div>

            <?php if (count($_SESSION["room_list"]) > 0) { ?>
                    <div class="container">
                        <div class="row">
                            <?php foreach ($_SESSION["room_list"] as $index => $schedule) { ?>
                                <div class="col-md-12">
                                    <div class="employee-card">
                                        <!-- foto karyawan -->
                                        <img src="<?php echo $schedule["image"]; ?>" alt="Foto Karyawan">
                                        <!-- Detail Karyawan -->
                                        <div class="employee-details">
                                            <h3>Nama Karyawan: </h3>
                                            <h3>"<?php echo $schedule["nama_karyawan"]; ?>"</h3>
                                            <hr class="line">
                                            <p>Tanggal masuk Karyawan: </p>
                                            <p><strong><?php echo $schedule["tanggal_masuk"]; ?></strong></p>
                                            <p><strong>Gaji:</strong> Rp <?php echo number_format($schedule["gaji"], 0, ',', '.'); ?> Jam Kerja Karyawan: <strong><?php echo ucfirst($schedule["posisi"]); ?></strong></p>
                                            
                                            <!-- Tombol Hapus -->
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn-delete">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
            <p>Tidak ada jadwal karyawan.</p>
            <?php    } ?>
            </div>
        </main>
        <script src="./assets/js/bootstrap.min.js"></script>
    </body>
</html>