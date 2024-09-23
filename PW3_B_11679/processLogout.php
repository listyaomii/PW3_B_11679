<?php
session_start();

if(isset($_SESSION["user"]["bukti_ngantor"])){
    unlink($_SESSION["user"]["bukti_ngantor"]);
}

session_destroy();
header("Location: ./login.php");