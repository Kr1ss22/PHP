<?php



$lehe_pealkiri = "Kontakt";


include "pais.php";


$eduteade = "";  
$veateade = "";  




if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["nimi"])) {

    
    
   
    $nimi = trim($_GET["nimi"]);          
    $email = trim($_GET["email"]);         
    $telefon = trim($_GET["telefon"]);     
    $teema = $_GET["teema"];               
    $sonum = trim($_GET["sonum"]);         
        
    
    
    
    if (!empty($nimi) && !empty($email) && !empty($sonum)) {
        
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            
            $kontakti_andmed = sprintf(
                "%s|%s|%s|%s|%s|%s\n",     
                date("Y-m-d H:i:s"),       
                $nimi,                     
                $email,                    
                $telefon,                  
                $teema,                    
                $sonum                     
            );
                        
           
            
        
            if (file_put_contents("teenused.txt", $kontakti_andmed, FILE_APPEND)) {
                $eduteade = "Sõnum edukalt saadetud!";
            } else {
                $veateade = "Viga sõnumi salvestamisel.";
            }
        } else {
            
            $veateade = "Palun sisestage korrektne e-posti aadress.";
        }
    } else {
        
        $veateade = "Palun täitke kõik kohustuslikud väljad.";
    }
}
?>


     

<main>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h1 class="text-center mb-5">Võtke meiega ühendust</h1>
                                
                
                <?php if (!empty($eduteade)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> <?php echo htmlspecialchars($eduteade); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                                
                
                <?php if (!empty($veateade)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($veateade); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                                
                <div class="row g-4">
                    
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    Ehituspood
                                </h5>
                                
                               
                                <div class="contact-info">
                                   
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-geo-alt text-primary me-3 fs-5"></i>
                                        <div>
                                            <strong>Aadress:</strong><br>
                                            Ehituse tänav 123<br>
                                            10115 Tallinn, Eesti
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone text-primary me-3 fs-5"></i>
                                        <div>
                                            <strong>Telefon:</strong><br>
                                            <a href="tel:+37212345678">+372 123 4567</a>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-envelope text-primary me-3 fs-5"></i>
                                        <div>
                                            <strong>E-post:</strong><br>
                                            <a href="mailto:info@ehituspood.ee">info@ehituspood.ee</a>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-flex mb-4">
                                        <i class="bi bi-clock text-primary me-3 fs-5"></i>
                                        <div>
                                            <strong>Lahtiolekuajad:</strong><br>
                                            Esmaspäev - Reede: 8:00-18:00<br>
                                            Laupäev: 9:00-15:00<br>
                                            Pühapäev: Suletud
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="map-container">
                                    <h6 class="mb-3">
                                        <i class="bi bi-map text-primary"></i> Leidke meid kaardilt
                                    </h6>
                                    
                                    <div class="ratio ratio-16x9">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2028.5234467890123!2d24.7514!3d59.4370!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTnCsDI2JzEzLjIiTiAyNMKwNDUnMDUuMCJF!5e0!3m2!1sen!2see!4v1696176000000!5m2!1sen!2see" 
                                            style="border:0; border-radius: 8px;" 
                                            allowfullscreen="" 
                                            loading="lazy" 
                                            referrerpolicy="no-referrer-when-downgrade">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                         
                    
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-envelope text-primary"></i> Saatke meile sõnum
                                </h5>
                                
                
                <form method="GET">
                    
                    
                    <div class="mb-3">
                        <label for="nimi" class="form-label">Nimi *</label>
                        <input type="text" class="form-control" id="nimi" name="nimi" required
                               value="<?php echo isset($_GET['nimi']) ? htmlspecialchars($_GET['nimi']) : ''; ?>">
                    </div>

                    
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posti aadress *</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                    </div>

                   
                    <div class="mb-3">
                        <label for="telefon" class="form-label">Telefon</label>
                        <input type="tel" class="form-control" id="telefon" name="telefon"
                               value="<?php echo isset($_GET['telefon']) ? htmlspecialchars($_GET['telefon']) : ''; ?>">
                    </div>                                   
                                    <div class="mb-3">
                                        <label for="teema" class="form-label">Teema</label>
                                        <select class="form-select" id="teema" name="teema">
                                            <option value="uldine" <?php echo (isset($_GET['teema']) && $_GET['teema'] == 'uldine') ? 'selected' : ''; ?>>Üldine päring</option>
                                            <option value="hinnaparing" <?php echo (isset($_GET['teema']) && $_GET['teema'] == 'hinnaparing') ? 'selected' : ''; ?>>Hinnapäring</option>
                                            <option value="transport" <?php echo (isset($_GET['teema']) && $_GET['teema'] == 'transport') ? 'selected' : ''; ?>>Transport</option>
                                            <option value="teenused" <?php echo (isset($_GET['teema']) && $_GET['teema'] == 'teenused') ? 'selected' : ''; ?>>Teenused</option>
                                            <option value="kaebus" <?php echo (isset($_GET['teema']) && $_GET['teema'] == 'kaebus') ? 'selected' : ''; ?>>Kaebus</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="mb-4">
                                        <label for="sonum" class="form-label">Sõnum *</label>
                                        <textarea class="form-control" id="sonum" name="sonum" rows="6" required 
                                                  placeholder="Kirjutage oma sõnum siia..."><?php echo isset($_GET['sonum']) ? htmlspecialchars($_GET['sonum']) : ''; ?></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send"></i> Saada sõnum
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
include "jalus.php"; 
?>