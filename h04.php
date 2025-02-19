<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ülesanded</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Jagamine</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="num1" class="sr-only">Arv 1</label>
        <input type="number" class="form-control" id="num1" name="num1" placeholder="Arv 1">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="num2" class="sr-only">Arv 2</label>
        <input type="number" class="form-control" id="num2" name="num2" placeholder="Arv 2">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Jaga</button>
</form>
<?php
if (!empty($_GET['num1']) && !empty($_GET['num2'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    if ($num2 == 0) {
        echo '<div class="alert alert-warning">Jagamine nulliga ei ole lubatud!</div>';
    } else {
        $result = $num1 / $num2;
        echo "<div class='alert alert-success'>$num1 jagatud $num2-ga on $result</div>";
    }
}
?>

<h2>Vanus</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="age1" class="sr-only">Vanus 1</label>
        <input type="number" class="form-control" id="age1" name="age1" placeholder="Vanus 1">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="age2" class="sr-only">Vanus 2</label>
        <input type="number" class="form-control" id="age2" name="age2" placeholder="Vanus 2">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Võrdle</button>
</form>
<?php
if (!empty($_GET['age1']) && !empty($_GET['age2'])) {
    $age1 = $_GET['age1'];
    $age2 = $_GET['age2'];
    if ($age1 > $age2) {
        echo "<div class='alert alert-success'>Esimene isik on vanem.</div>";
    } elseif ($age1 < $age2) {
        echo "<div class='alert alert-success'>Teine isik on vanem.</div>";
    } else {
        echo "<div class='alert alert-success'>Mõlemad on ühevanused.</div>";
    }
}
?>

<h2>Ristkülik või ruut</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="side1" class="sr-only">Külg 1</label>
        <input type="number" class="form-control" id="side1" name="side1" placeholder="Külg 1">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="side2" class="sr-only">Külg 2</label>
        <input type="number" class="form-control" id="side2" name="side2" placeholder="Külg 2">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Kontrolli</button>
</form>
<?php
if (!empty($_GET['side1']) && !empty($_GET['side2'])) {
    $side1 = $_GET['side1'];
    $side2 = $_GET['side2'];
    if ($side1 == $side2) {
        echo "<div class='alert alert-success'>See on ruut.</div>";
    } else {
        echo "<div class='alert alert-success'>See on ristkülik.</div>";
    }
}
?>

<h2>Juubel</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="birth_year" class="sr-only">Sünniaasta</label>
        <input type="number" class="form-control" id="birth_year" name="birth_year" placeholder="Sünniaasta">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Kontrolli</button>
</form>
<?php
if (!empty($_GET['birth_year'])) {
    $birth_year = $_GET['birth_year'];
    $current_year = date("Y");
    $age = $current_year - $birth_year;
    if ($age % 10 == 0) {
        echo "<div class='alert alert-success'>$age on juubeliaasta!</div>";
    } else {
        echo "<div class='alert alert-success'>$age ei ole juubeliaasta.</div>";
    }
}
?>

<h2>Hinne</h2>
<form method="get" class="form-inline">
    <div class="form-group mb-2">
        <label for="points" class="sr-only">Punktid</label>
        <input type="number" class="form-control" id="points" name="points" placeholder="Punktid">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Kontrolli</button>
</form>
<?php
if (!empty($_GET['points'])) {
    $points = $_GET['points'];
    switch (true) {
        case ($points > 10):
            echo "<div class='alert alert-success'>SUPER!</div>";
            break;
        case ($points >= 5 && $points <= 9):
            echo "<div class='alert alert-success'>TEHTUD!</div>";
            break;
        case ($points < 5):
            echo "<div class='alert alert-warning'>KASIN!</div>";
            break;
        default:
            echo "<div class='alert alert-danger'>SISESTA OMA PUNKTID!</div>";
            break;
    }
} else {
    echo "<div class='alert alert-danger'>SISESTA OMA PUNKTID!</div>";
}
?>

</body>
</html>