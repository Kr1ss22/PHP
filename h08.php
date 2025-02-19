<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ülesanded</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Kuupäev ja kellaaeg</h2>
<?php
// Kuva kuupäev ja kellaaeg formaadis 20.03.2023 17:31
echo date("d.m.Y H:i");
?>

<h2>Vanus</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="birth_year" class="sr-only">Sünniaasta</label>
        <input type="number" class="form-control" id="birth_year" name="birth_year" placeholder="Sünniaasta">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Arvuta vanus</button>
</form>
<?php
if (!empty($_GET['birth_year'])) {
    $birth_year = $_GET['birth_year'];
    $current_year = date("Y");
    $age = $current_year - $birth_year;
    echo "Kasutaja on või saab sellel aastal $age aastat vanaks.";
}
?>

<h2>Kooliaasta lõpuni</h2>
<?php
// Mitu päeva on käesoleva kooliaasta lõpuni?
$today = new DateTime();
$end_of_school_year = new DateTime('2025-06-30');
$interval = $today->diff($end_of_school_year);
echo "2025 kooliaasta lõpuni on jäänud " . $interval->days . " päeva!";
?>

<h2>Aastaaeg</h2>
<?php
// Väljasta vastavalt aastaajale pilt (kevad, suvi, sügis, talv)
$month = date("n");
$season = "";

if ($month >= 3 && $month <= 5) {
    $season = "kevad";
} elseif ($month >= 6 && $month <= 8) {
    $season = "suvi";
} elseif ($month >= 9 && $month <= 11) {
    $season = "sügis";
} else {
    $season = "talv";
}

echo "<img src='images/$season.jpg' alt='$season' class='img-fluid'>";
?>

</body>
</html>