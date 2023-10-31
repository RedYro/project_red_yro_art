<?php
    require_once "functions.inc.php"; // Pour assurer qu'un fichier n'est inclus qu'une seule fois, permet aussi d'éviter des problèmes de redondance.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=RACINE_SITE . "/assets/css/style.css"?>">
    <link rel="stylesheet" href="<?=RACINE_SITE . "/assets/css/responsive.css"?>">
    <!-- Icônes Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- "$contentDescription" => permet de gérer la description du meta sur les différentes pages -->
    <meta name="description" content="<?=$contentDescription?>">
    <meta name="author" content="Grégory Lyfoung">
    <!-- Condition qui permet de changer le logo rouge en bleu si le rôle = ADMIN -->
    <?php
        if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
    ?>
    <link rel="shortcut icon" href="<?=RACINE_SITE . "/assets/img/logo_blue_2.png"?>" type="image/x-icon">
    <?php
        } else{
    ?>
    <link rel="shortcut icon" href="<?=RACINE_SITE . "/assets/img/logo_red_2.png"?>" type="image/x-icon">
    <?php
        }
    ?>
    <!-- "$title" => permet de gérer le titre du site sur les différentes pages -->
    <title><?=$title?></title>
</head>

<body>
    <div id="loader" class="d-flex justify-content-center align-items-center loader-bg">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="d-flex justify-content-center align-items-center m-auto logo-loader-size">
                    <img src="<?=RACINE_SITE . "/assets/img/logo_red_2.png"?>" alt="Logo RedYro's Art" class="logo-loader-img">
                </div>
            </div>
        </div>
    </div>
    <header>
        <!-- Condition pour gérer le style de la navbar si le rôle = ADMIN  -->
        <?php
            if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
        ?>
        <nav class="navbar navbar-expand-lg bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=RACINE_SITE?>/index.php">
                    <img src="<?=RACINE_SITE . "/assets/img/logo_blue.png"?>" alt="RedYro's Art" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-offcanvas-blue" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item text-center logo-show"><a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php"><img src="<?=RACINE_SITE . "/assets/img/logo_blue.png"?>" alt="RedYro's Art" class="logo"></a></li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php">Accueil</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/all_products.php">Produits</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/services.php">Services</a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?=RACINE_SITE?>/admin/dashboard.php" class="nav-link nav-link-font-color fs-4 me-3">Back-office</a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?=RACINE_SITE?>/profil/compte.php" class="nav-link nav-link-font-color fs-4 me-3">Compte</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/contact.php">Contact</a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?=RACINE_SITE?>/authentification.php?action=deconnexion" class="nav-link nav-link-font-color fs-4 me-3">Se déconnecter</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link" href="<?=RACINE_SITE?>/boutique/panier.php"><i class="bi bi-basket-fill text-white"><?=(!empty($_SESSION['cart']) && !empty($_SESSION['utilisateur'])) ? count($_SESSION['cart']) : ""?></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php
            } else if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
        ?>
        <nav class="navbar navbar-expand-lg bg-red">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=RACINE_SITE?>/index.php">
                    <img src="<?=RACINE_SITE . "/assets/img/logo_red.png"?>" alt="RedYro's Art" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-offcanvas-red" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item text-center logo-show"><a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php"><img src="<?=RACINE_SITE . "/assets/img/logo_red.png"?>" alt="RedYro's Art" class="logo"></a></li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php">Accueil</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/all_products.php">Produits</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/services.php">Services</a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?=RACINE_SITE?>/profil/compte.php" class="nav-link nav-link-font-color fs-4 me-3">Compte</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/contact.php">Contact</a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?=RACINE_SITE?>/authentification.php?action=deconnexion" class="nav-link nav-link-font-color fs-4 me-3">Se déconnecter</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link" href="<?=RACINE_SITE?>/boutique/panier.php"><i class="bi bi-basket-fill text-white"><?=(!empty($_SESSION['cart']) && !empty($_SESSION['utilisateur'])) ? count($_SESSION['cart']) : ""?></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php
            } else{
        ?>
        <nav class="navbar navbar-expand-lg bg-red">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=RACINE_SITE?>/index.php">
                    <img src="<?=RACINE_SITE . "/assets/img/logo_red.png"?>" alt="RedYro's Art" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-offcanvas-red" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item text-center logo-show"><a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php"><img src="<?=RACINE_SITE . "/assets/img/logo_red.png"?>" alt="RedYro's Art" class="logo"></a></li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/index.php">Accueil</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/all_products.php">Produits</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/services.php">Services</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/register.php">S'inscrire</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/authentification.php">Se connecter</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link nav-link-font-color fs-4 me-3" href="<?=RACINE_SITE?>/contact.php">Contact</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link" href="<?=RACINE_SITE?>/boutique/panier.php"><i class="bi bi-basket-fill text-white"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php
            }
        ?>
    </header>