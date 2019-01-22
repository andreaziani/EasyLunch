<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/ProgettoTecWeb/view/template/header/style.css">
    <title>Easy Lunch</title>
</head>
<body>
    <header>
        <!--TODO: set the dimension of the icon with css-->
        <nav class="navbar navbar-default navbar-fixed-top .navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/ProgettoTecWeb/view/index.php"><img src="/ProgettoTecWeb/images/icons/easylunch.png" alt="brand logo" longdesc='/ProgettoTecWeb/images/icons/logodesc.txt'></a>
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
    } else if ($_SESSION["user"]->type == "ADMIN") {
        $base->requireFromWebSitePath('header/_adminheader.php');
    }
?>
            </div>
        </nav>
    </header>