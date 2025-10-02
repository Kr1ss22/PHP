<?php
session_start();
$lehe_pealkiri = "Ostukorv";
include "pais.php";

$eduteade = "";
$veateade = "";

if (isset($_SESSION["teade"])) {
    $eduteade = $_SESSION["teade"];
    unset($_SESSION["teade"]);
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["eemaldamine"])) {
        $voti = $_GET["toote_voti"];
        unset($_SESSION["ostukorv"][$voti]);
        $eduteade = "Toode eemaldatud!";
    } elseif (isset($_GET["tyhjendamine"])) {
        $_SESSION["ostukorv"] = [];
        $eduteade = "Ostukorv tühjendatud!";
    } elseif (isset($_GET["koguse_muutmine"])) {
        $voti = $_GET["toote_voti"];
        $kogus = (int)$_GET["kogus"];
        if ($kogus > 0) {
            $_SESSION["ostukorv"][$voti]["kogus"] = $kogus;
            $eduteade = "Kogus muudetud!";
        } else {
            unset($_SESSION["ostukorv"][$voti]);
            $eduteade = "Toode eemaldatud!";
        }
    }
}


$kogusumma = 0;
if (!empty($_SESSION["ostukorv"])) {
    foreach ($_SESSION["ostukorv"] as $toode) {
        $kogusumma += $toode["hind"] * $toode["kogus"];
    }
}
?>
<main class="container my-5">
    <h1 class="text-center mb-4">Ostukorv</h1>

    <?php if ($eduteade): ?>
        <div class="alert alert-success"><?php echo $eduteade; ?></div>
    <?php endif; ?>
    <?php if ($veateade): ?>
        <div class="alert alert-danger"><?php echo $veateade; ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION["ostukorv"])): ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Toode</th>
                        <th>Hind</th>
                        <th>Kogus</th>
                        <th>Summa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION["ostukorv"] as $voti => $toode): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($toode["nimi"]); ?> <br>
                            <small class="text-muted"><?php echo $toode["yhik"]; ?></small></td>
                        <td><?php echo number_format($toode["hind"],2,","," "); ?>€</td>
                        <td>
                            <form method="GET" class="d-flex">
                                <input type="hidden" name="toote_voti" value="<?php echo $voti; ?>">
                                <input type="number" name="kogus" value="<?php echo $toode["kogus"]; ?>" min="0" class="form-control form-control-sm me-2" style="width:80px">
                                <button type="submit" name="koguse_muutmine" class="btn btn-sm btn-outline-primary">Uuenda</button>
                            </form>
                        </td>
                        <td><?php echo number_format($toode["hind"]*$toode["kogus"],2,","," "); ?>€</td>
                        <td>
                            <form method="GET">
                                <input type="hidden" name="toote_voti" value="<?php echo $voti; ?>">
                                <button type="submit" name="eemaldamine" class="btn btn-sm btn-outline-danger">Eemalda</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-primary">
                        <th colspan="3">KOKKU</th>
                        <th><?php echo number_format($kogusumma,2,","," "); ?>€</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            <form method="GET">
                <button type="submit" name="tyhjendamine" class="btn btn-outline-danger">Tühjenda</button>
            </form>
            <a href="tooted.php" class="btn btn-outline-primary">Jätka ostmist</a>
        </div>
    <?php else: ?>
        <div class="text-center">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h3>Ostukorv on tühi</h3>
            <a href="tooted.php" class="btn btn-primary">Vaata tooteid</a>
        </div>
    <?php endif; ?>
</main>
<?php include "jalus.php"; ?>
