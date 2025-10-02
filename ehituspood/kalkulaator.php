<?php
$lehe_pealkiri = "Kalkulaator";

include "pais.php";


$arvutuse_tulemus = null;  

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pindala"])) {
   
    $sisestatud_pindala = floatval($_GET["pindala"]);   
    $valitud_tyyp = $_GET["tyyp"];                       
    $pusikliendi_soodustus = isset($_GET["pusiklient"]); 
    
    
    if ($sisestatud_pindala > 0) {
        
        $materjalide_nimekiri = [];
        
       
        switch($valitud_tyyp) {
           
            case "vundament":
                $materjalide_nimekiri = [
                    ["nimi" => "Betoon", "kogus" => $sisestatud_pindala * 0.3, "yhik" => "m³", "hind" => 95.00],
                    ["nimi" => "Armatuur", "kogus" => $sisestatud_pindala * 8, "yhik" => "m", "hind" => 1.85],
                ];
                break;
                
            
            case "seinad":
                $materjalide_nimekiri = [
                    ["nimi" => "Plokid", "kogus" => $sisestatud_pindala * 12.5, "yhik" => "tk", "hind" => 3.20],
                    ["nimi" => "Krohv", "kogus" => $sisestatud_pindala * 3, "yhik" => "kg", "hind" => 8.90],
                ];
                break;
                
             
            case "katus":
                $materjalide_nimekiri = [
                    ["nimi" => "Katuseplaadid", "kogus" => $sisestatud_pindala * 1.15, "yhik" => "m²", "hind" => 15.75],
                    ["nimi" => "Puitmaterjal", "kogus" => $sisestatud_pindala * 0.8, "yhik" => "m³", "hind" => 4.20],
                ];
                break;
        }
        
        $kogu_summa = 0;    
        $algne_summa = 0;   
        
        
        foreach ($materjalide_nimekiri as &$yks_materjal) {
            $yks_materjal["summa"] = $yks_materjal["kogus"] * $yks_materjal["hind"];
            $algne_summa += $yks_materjal["summa"];
        }
        
        
        if ($pusikliendi_soodustus) {
            $kogu_summa = $algne_summa * 0.9;
        } else {
            $kogu_summa = $algne_summa;
        }
        
        
        $arvutuse_tulemus = [
            "materjalid" => $materjalide_nimekiri,
            "algne_summa" => $algne_summa,
            "kogusumma" => $kogu_summa,
            "pindala" => $sisestatud_pindala,
            "tyyp" => $valitud_tyyp,
            "pusiklient" => $pusikliendi_soodustus
        ];
        
        
        $salvestamise_rida = date("Y-m-d H:i:s") . "|" .
                            $sisestatud_pindala . " m²|" .
                            ucfirst($valitud_tyyp) . "|" .
                            number_format($kogu_summa, 2) . "€|" .
                            ($pusikliendi_soodustus ? "Püsiklient" : "Tavaline") . "\n";
        
        file_put_contents("orders.txt", $salvestamise_rida, FILE_APPEND);
    }
}
?>

<main>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-5">Ehitusmaterjalide kalkulaator</h1>
                
                <div class="card mb-4">
                    <div class="card-body">
                       
                        <form method="GET">
                          
                            <div class="mb-3">
                                <label for="pindala" class="form-label">Pindala (m²) *</label>
                                <input type="number" class="form-control" id="pindala" name="pindala" 
                                       step="0.1" min="1" max="1000" required 
                                       value="<?php echo isset($_GET["pindala"]) ? $_GET["pindala"] : ""; ?>">
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="tyyp" class="form-label">Ehituse tüüp *</label>
                                <select class="form-select" id="tyyp" name="tyyp" required>
                                    <option value="">Vali tüüp...</option>
                                    <option value="vundament" <?php echo (isset($_GET["tyyp"]) && $_GET["tyyp"] == "vundament") ? "selected" : ""; ?>>Vundament</option>
                                    <option value="seinad" <?php echo (isset($_GET["tyyp"]) && $_GET["tyyp"] == "seinad") ? "selected" : ""; ?>>Seinad</option>
                                    <option value="katus" <?php echo (isset($_GET["tyyp"]) && $_GET["tyyp"] == "katus") ? "selected" : ""; ?>>Katus</option>
                                </select>
                            </div>
                            
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pusiklient" name="pusiklient" 
                                           <?php echo (isset($_GET["pusiklient"])) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="pusiklient">
                                        <strong class="text-success">Püsikliendi soodustus -10%</strong>
                                    </label>
                                </div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-calculator"></i> Arvuta materjalid
                            </button>
                        </form>
                    </div>
                </div>
                
                <?php if ($arvutuse_tulemus): ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Kalkulatsiooni tulemused</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            <strong>Pindala:</strong> <?php echo $arvutuse_tulemus["pindala"]; ?> m² | 
                            <strong>Tüüp:</strong> <?php echo ucfirst($arvutuse_tulemus["tyyp"]); ?>
                            <?php if ($arvutuse_tulemus["pusiklient"]): ?>
                                | <span class="badge bg-success">Püsiklient</span>
                            <?php endif; ?>
                        </p>
                        
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Materjal</th>
                                        <th>Kogus</th>
                                        <th>Ühik</th>
                                        <th>Hind</th>
                                        <th>Summa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arvutuse_tulemus["materjalid"] as $materjal): ?>
                                    <tr>
                                        <td><?php echo $materjal["nimi"]; ?></td>
                                        <td><?php echo number_format($materjal["kogus"], 2, ",", " "); ?></td>
                                        <td><?php echo $materjal["yhik"]; ?></td>
                                        <td><?php echo number_format($materjal["hind"], 2, ",", " "); ?>€</td>
                                        <td><strong><?php echo number_format($materjal["summa"], 2, ",", " "); ?>€</strong></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <?php if ($arvutuse_tulemus["pusiklient"]): ?>
                                    <tr>
                                        <th colspan="4">Summa enne soodustust:</th>
                                        <th><?php echo number_format($arvutuse_tulemus["algne_summa"], 2, ",", " "); ?>€</th>
                                    </tr>
                                    <tr class="table-success">
                                        <th colspan="4">Püsikliendi soodustus (-10%):</th>
                                        <th>-<?php echo number_format($arvutuse_tulemus["algne_summa"] - $arvutuse_tulemus["kogusumma"], 2, ",", " "); ?>€</th>
                                    </tr>
                                    <?php endif; ?>
                                    <tr class="table-primary">
                                        <th colspan="4">KOKKU:</th>
                                        <th><?php echo number_format($arvutuse_tulemus["kogusumma"], 2, ",", " "); ?>€</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i> Kalkulatsioon on salvestatud!
                            </div>
                            <p class="text-muted"><small>* Hinnad on orienteeruvad ja võivad muutuda.</small></p>
                            <a href="tooted.php" class="btn btn-success">
                                <i class="bi bi-box"></i> Vaata tooteid
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php include "jalus.php"; ?>
