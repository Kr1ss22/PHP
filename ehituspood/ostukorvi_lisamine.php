<?php
session_start();

if (isset($_GET["toote_nimi"], $_GET["hind"], $_GET["yhik"])) {
    if (!isset($_SESSION["ostukorv"])) {
        $_SESSION["ostukorv"] = [];
    }

    $toote_voti = md5($_GET["toote_nimi"] . $_GET["yhik"]);

    if (isset($_SESSION["ostukorv"][$toote_voti])) {
        $_SESSION["ostukorv"][$toote_voti]["kogus"]++;
    } else {
        $_SESSION["ostukorv"][$toote_voti] = [
            "nimi"  => $_GET["toote_nimi"],
            "hind"  => (float)$_GET["hind"],
            "yhik"  => $_GET["yhik"],
            "kogus" => 1
        ];
    }

    $_SESSION["teade"] = $_GET["toote_nimi"] . " lisati ostukorvi!";
}

header("Location: tooted.php");
exit;
