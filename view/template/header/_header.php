<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Easy Lunch</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
</head>
<body>
    <header>
        <!--TODO: set the dimension of the icon with css-->
        <a href="../../index.php">Easy Lunch</a>
        <nav>
            <a href=#>Shop</a>

<?php 
use Utils\PathManager;
    session_start();
    $base = new PathManager();
    if (!isset($_SESSION["user"])) {
        $base->requireFromWebSitePath('header/_access_header.php');
    } else if ($_SESSION["user"]->type == "CLIENT") {
        $base->requireFromWebSitePath('header/_clientheader.php');
    } else if ($_SESSION["user"]->type == "PROVIDER") {
        $base->requireFromWebSitePath('header/_providerheader.php');
    }
?>
        </nav>
    </header>