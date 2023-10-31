<?php
    $contentDescription = "Red Yro's Art Utilisateurs";
    $title = "Utilisateurs";
    
    require_once("../inc/functions.inc.php");
    
    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }
    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }
    if(isset($_GET['action']) && isset($_GET['id_user'])){
        if(!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id_user'])){
            $idUser = htmlentities($_GET['id_user']);
            deleteUser($idUser);
            header('location:dashboard.php?users_php');
            exit();
        }
    }
    $users = allUsers();
    
    require_once("../inc/header.inc.php");
?>
    <div class="row m-auto w-100">
        <div class="col-sm-12 col-12 col-lg-12 col-md-12 d-flex flex-column m-auto mt-5">
            <h1 class="text-center mb-3 p-2 w-50 m-auto title-style-h1 title-color-blue">Liste utilisateurs</h1>
            <?php
                foreach($users as $key => $user){
            ?>
                <div class="accordion m-auto w-100" id="accordion">
                    <div class="accordion-item bg-blue-2">
                        <h2 class="accordion-header bg-blue-2" id="heading<?=$user['id_user']?>" style="width: 100%;">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <?=$user['first_name'] . ' ' . $user['last_name']?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <a href="users.php?action=delete&id_user=<?=$user['id_user']?>" style="text-decoration: none; color: #fff; border:#fff solid 2px; padding: 5px;"><i class="bi bi-trash3-fill text-white"></i> Supprimer</a>
                                <li class="text-white mt-3" style="border-bottom:#fff solid 2px;">ID : <?=$user['id_user']?></i></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Prénom : <?=$user['first_name']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Nom : <?=$user['last_name']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Pseudo : <?=$user['pseudo']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Mail : <?=$user['mail']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Civilité : <?=$user['genre']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Addresse : <?=$user['address']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Code postal : <?=$user['zip']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Ville : <?=$user['city']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Rôle : <?=$user['role']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Image de profil : <img src="<?=RACINE_SITE."/assets/".$user['image_profil']?>" alt="Image profil utilisateur <?=$user['pseudo']?>" class="product-img-dashboard m-auto"></li>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>