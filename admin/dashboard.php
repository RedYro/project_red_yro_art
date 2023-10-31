<?php
    $contentDescription = "Red Yro's Art Dashboard";
    $title = "Back-office";
    
    require_once("../inc/functions.inc.php");
    // 2 conditions pour éviter d'accéder au dashboard sans compte ou en tant que rôle "user" 

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/index.php');
        exit();
    }
    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }
    
    require_once("../inc/header.inc.php");
?>
    <main class="bg-blue-2">
        <div class="container-fluid">
            <div class="row">    
                <div class="col-sm-6 col-6 col-lg-2 col-md-4">
                    <div class="d-flex flex-column mt-5 p-3 dashboard-style">
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li>
                                <a href="?dashboard_php" class="nav-link text-light">Back-office</a>
                            </li>
                            <li>
                                <a href="?users_php" class="nav-link text-light">Utilisateurs</a>
                            </li>
                            <li>
                                <a href="?produits_php" class="nav-link text-light">Produits</a>
                            </li>
                        </ul>
                        <hr>
                    </div>
                </div>
                <div class="col-lg-10 col-sm-12 col-12 col-md-12 p-5">
                    <div class="d-flex justify-content-center align-items-center m-auto banner-dashboard-img-size">
                        <img src="<?=RACINE_SITE . "/assets/img/red_blue_v1.png"?>" alt="Blue & Red" class="banner-dashboard-img m-auto">
                    </div>
                </div>
                <?php
                    /*
                    * $_GET représente les données qui transitent par l'URL, c'est une superglobal et comme toutes autres 'superglobal' c'est un tableau (array)
                    * "superglobal" signifie que cette variable est disponible partout dans le script y compris au sein des fonctions
                    * Transition des informations dans l'URL selon la syntaxe suivante : 
                    *  - exemple : page.php?indice1=valeur1&indice2=valeur2&indiceN=valeurN
                    * Quand on réceptionne les données, "$_GET" est remplie selon le schéma suivant :
                    *  $_GET = array(
                    *      'indice1' => 'valeur1',
                    *      'indice2' => 'valeur2',
                    *      'indiceN' => 'valeurN',
                    * )
                    */
                    if(!empty($_GET)){ // Si la variable "$_GET" n'est pas vide cela veut dire que l'on a cliqué sur un lien de la side barre, l'index de "$_GET" change selon le lien indiqué dans les balises "a"
                        if(isset($_GET['produits_php'])){
                            require_once("produits.php"); // Si index films_php existe dans $_GET, on appel le fichier films.php
                        } else if(isset($_GET['users_php'])){
                            require_once("users.php"); // Si index users_php existe dans $_GET, on appel le fichier users.php
                        } else{
                            require_once("dashboard.php"); // Si index dashboard_php existe dans $_GET, on appel le fichier dashboard.php
                        }
                    }
                ?>
                </div>
        </div>
    </main>
<?php
    require_once("../inc/footer.inc.php");
?>