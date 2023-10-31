<?php
    $contentDescription = "Red Yro's Art Compte";
    $title = "Compte";

    require_once("../inc/functions.inc.php");

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }
    require_once("../inc/header.inc.php");

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
<main class="container-fluid bg-blue-2">
<?php
    } else{
?>
<main class="container-fluid bg-red-2">
<?php
    }
?>
    <?php
        if(isset($_SESSION['utilisateur']['pseudo']) && !empty($_SESSION['utilisateur']['pseudo'])){
    ?>
    <h1 class="text-center mb-5 p-2 m-auto bg-red title-style-h1 title-size-2"><?=$_SESSION['utilisateur']['pseudo']?></h1>
    <div class="w-50 m-auto">
        <div class="img-pp m-auto"></div>
        <a href="<?=RACINE_SITE?>/authentification.php?action=deconnexion" class="log-out-compte"><i class="bi bi-box-arrow-right"></i></a>
        <div class="row compte-style">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="nav nav-pills flex-column mb-auto pt-3 pb-3">
                    <li>
                        <p class="m-0 p-2">Nom : <?=$_SESSION['utilisateur']['last_name']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Prénom : <?=$_SESSION['utilisateur']['first_name']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Pseudo : <?=$_SESSION['utilisateur']['pseudo']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Mail : <?=$_SESSION['utilisateur']['mail']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Adresse : <?=$_SESSION['utilisateur']['address']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Code postal : <?=$_SESSION['utilisateur']['zip']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Ville : <?=$_SESSION['utilisateur']['city']?></p>
                    </li>
                    <hr>
                    <li>
                        <p class="m-0 p-2">Pays : <?=$_SESSION['utilisateur']['country']?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <a href="<?=RACINE_SITE?>/profil/modification_compte.php" class="btn btn-lg fs-5 w-50 m-auto mt-4 mb-4 btn-style btn-color-red">Modifier</a>
        </div>
    </div>
    <?php
        } else if(!isset($_SESSION['utilisateur']['pseudo']) && empty($_SESSION['utilisateur']['pseudo'])){
            header('location:'.RACINE_SITE.'authentification.php');
            exit();
        }
    ?>
</main>
<?php
    require_once("../inc/footer.inc.php");
?>