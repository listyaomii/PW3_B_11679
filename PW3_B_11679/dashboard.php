<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: ./login.php");
    exit;
}

if(!isset($_SESSION["room_list"])){
    $_SESSION["room_list"] = [];
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

        </style>
    </head>

    <body>
        <header class="fixed-top scrolled" id="navbar">
            <nav class="container nav-top py-2">
                <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn" style="background-color: #EE4D2D;">
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
                    <strong>Berhasil!</strong> <?php echo $_SESSION["Success"]; ?>
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
        </main>

        <script src="./assets/js/bootstrap.min.js"></script>
    </body>
</html>