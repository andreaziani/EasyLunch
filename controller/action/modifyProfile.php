<?php
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Controller\Controller;

session_start();

function addIfIsSet($key, $data)
{
    if (isset($_POST[$key])) {
        $data[$key] = $_POST[$key];
    }
    return $data;
}

$data = array();
$data = addIfIsSet("Name", $data);
$data = addIfIsSet("Surname", $data);
$data = addIfIsSet("Birthdate", $data);
$data = addIfIsSet("PhoneNumber", $data);
$data = addIfIsSet("Email", $data);
if ($_SESSION["user"]->type == "PROVIDER") {
    $data = addIfIsSet("IVA", $data);
    $data = addIfIsSet("CityAddress", $data);
    $data = addIfIsSet("AddressStreet", $data);
    $data = addIfIsSet("AddressNumber", $data);
    $data = addIfIsSet("CompanyName", $data);
    Controller::getInstance()->updateProfileInformations($data, "Providers", $_SESSION["user"]->userName);
} else {
    Controller::getInstance()->updateProfileInformations($data, "Clients", $_SESSION["user"]->userName);
}
