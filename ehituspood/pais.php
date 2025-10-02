<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <title>Ehituspood - <?php echo isset($lehe_pealkiri) ? $lehe_pealkiri : 'Avaleht'; ?></title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                
                <img src="https://picsum.photos/40/40?random=20" 
                     alt="Ehituspood Logo" 
                     class="rounded-circle me-2" 
                     style="width: 32px; height: 32px; object-fit: cover;">
                
                <span class="d-none d-sm-inline">Ehituspood</span>  
                <span class="d-sm-none">EM</span>                   
            </a>
            
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="bi bi-house"></i> Avaleht
                        </a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'tooted.php' ? 'active' : ''; ?>" href="tooted.php">
                            <i class="bi bi-box"></i> Tooted
                        </a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'kalkulaator.php' ? 'active' : ''; ?>" href="kalkulaator.php">
                            <i class="bi bi-calculator"></i> Kalkulaator
                        </a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'kontakt.php' ? 'active' : ''; ?>" href="kontakt.php">
                            <i class="bi bi-envelope"></i> Kontakt
                        </a>
                    </li>
                </ul>
                </ul>
                
               
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="ostukorv.php">
                            <i class="bi bi-cart3"></i> Ostukorv 
                            <?php 
                            
                            if (isset($_SESSION['ostukorv']) && count($_SESSION['ostukorv']) > 0): 
                            ?>
                            
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                   
                                    <?php echo count($_SESSION['ostukorv']); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>