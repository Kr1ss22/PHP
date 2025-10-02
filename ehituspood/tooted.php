<?php
session_start();
$lehe_pealkiri = "Tooted";
include "pais.php";


$tooted = [
    ["nimi" => "Tellis", "hind" => 0.35, "yhik" => "tk"],
    ["nimi" => "Kivi", "hind" => 1.20, "yhik" => "kg"],
    ["nimi" => "Betoon", "hind" => 3.50, "yhik" => "kotitäis"],
    ["nimi" => "Puit", "hind" => 5.00, "yhik" => "jm"],
    ["nimi" => "Kipsplaat222", "hind" => 6.90, "yhik" => "tk"],
    ["nimi" => "Isolatsioonivill", "hind" => 4.50, "yhik" => "m²"],
    ["nimi" => "Metalltoru", "hind" => 2.30, "yhik" => "jm"],
    ["nimi" => "Vaskkaabel", "hind" => 1.10, "yhik" => "m"],
    ["nimi" => "Katusetõrv", "hind" => 8.75, "yhik" => "kg"],
    ["nimi" => "Plaat", "hind" => 2.40, "yhik" => "tk"],
    ["nimi" => "Naelad", "hind" => 0.05, "yhik" => "tk"],
    ["nimi" => "Kruvid22222", "hind" => 0.07, "yhik" => "tk"],
];
?>
<main class="container my-5">
    <h1 class="mb-4 text-center">Ehitusmaterjalid</h1>
    <div class="row">
        <?php foreach ($tooted as $toode): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://picsum.photos/200?random=<?php echo rand(1,1000); ?>" 
                     class="card-img-top" alt="Pilt">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($toode["nimi"]); ?></h5>
                    <p class="card-text">
                        Hind: <strong><?php echo number_format($toode["hind"],2,","," "); ?>€</strong><br>
                        Ühik: <?php echo htmlspecialchars($toode["yhik"]); ?>
                    </p>
                    <form method="GET" action="ostukorvi_lisamine.php">
                        <input type="hidden" name="toote_nimi" value="<?php echo $toode["nimi"]; ?>">
                        <input type="hidden" name="hind" value="<?php echo $toode["hind"]; ?>">
                        <input type="hidden" name="yhik" value="<?php echo $toode["yhik"]; ?>">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-cart-plus"></i> Lisa ostukorvi
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include "jalus.php"; ?>
