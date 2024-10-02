<?php
session_start();

// kita memeriksa apakah user sudah login atau belum
if(isset($_SESSION["user"])){
    //kalo sudah, maka redirect ke dashboard
    header("Location: ./dashboard.php");
    exit;
}

$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restauran& Bar",
    "page_title" => "Atma Kitchen Restaurat & Co",
    "logo" => "./assets/images/HatCook.png",
    "user" => "Komang Listya Omi Pradnyani/220711679"
];
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $detail["page_title"];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- icon tab -->
         <link rel="icon" href="<?php echo $detail["logo"];?>" type="image/x-icon" />

         <!-- bootsrap 5.3 css-->
          <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />

          <!-- poppins dari google fonts -->
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="./assets/css/poppins.min.css" rel="stylesheet">

           <!-- custom css -->
            <link rel="stylesheet" href="./assets/css/style.css" />

            <style>

                #formAuth {
                    max-width: 576px;
                    margin: 0 auto;
                }
            </style>
    </head>

    <body>
        <header class="fixed-top scrolled" id="navbar">
            <nav class="container nav-top py-2">
                <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn"
                    style="background-color: #EE4D2D;">
                    <img src="<?php echo $detail["logo"]; ?>" class="crown-logo" />
                    <div>
                        <p class="mb-0 fs-5 fw-bold"><?php echo $detail["name"]; ?></p>
                        <p class="small mb-0"><?php echo $detail["tagline"]; ?></p>
                    </div>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item "><a href="./" class="nav-link text" style="color: #EE4D2D;">Home</a></li>
                    <li class=" nav-item ms-3"><a href="#" class="nav-link active tet-white"
                    style="background-color: #EE4D2D;" aria-current="page">Admin Login</a></li>
                </ul>
            </nav>
        </header>

        <main style="padding-top: 84px;" class="container">
            <h1 class="text-center mt-5 display-4">Welcome Admin!</h1>
            <p class="text-center lead">Untuk memastikan identitas, silahkan isi form berikut: </p>

            <hr class="featurette-divider" />

            <form action="./processLogin.php" method="POST" id="formAuth" enctype="multipart/form-data">
                <div class="alert alert-indo mb-4 text-center" role="alert">
                    <strong>Info!</strong> Username dan password bebas, yang penting diisi.
                </div>

                <?php if (isset($_SESSION["error"])){ ?>
                    <div class="alert alert-danger mb-4 text-center" role="alert">
                        <strong>Error!</strong> <?php echo $_SESSION["error"]; ?>
                    </div>
                <?php
                    unset($_SESSION["error"]);
                } ?>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="inputUsername"placeholder="Username"name="username" />
                    <label for="inputUsername">Username</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="inputPassword"placeholder="Password"name="password" />
                    <label for="inputPassword">Password</label>
                </div>

                <div class="mb-4">
                    <label for="inputFile" class="form-label d-block text-center">Bukti Sedang ngantor:</label>
                    <input class="form-control" id="inputFile" type="file" accept=".jpg, .jpeg, .png" name="bukti_ngantor" />
                </div>

                <div>
                    <button type="submit" class="btn w-100 fw-bold text-light" style="background-color: #EE4D2D;">Login</button>
                    <input type="hidden" name="mencoba_login" value="1" />
                </div>
            </form>
        </main>

        <script src="./assets/js/bootstrap.min.js"></script>
    </body>
</html>