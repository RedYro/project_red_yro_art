<?php
    $contentDescription = "Red Yro's Art Liste produits";
    $title = "Liste produits";

    require_once("../inc/functions.inc.php");

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }
    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }
    $products = allProducts();

    require_once("../inc/header.inc.php");
?>
    <div class="row m-auto w-100">
        <div class="col-sm-12 col-12 col-lg-12 col-md-12 d-flex flex-column m-auto mt-5">
            <h1 class="text-center mb-3 p-2 w-50 m-auto title-style-h1 title-color-blue">Liste Produit</h1>
            <a href="gestion.php" class="m-auto fs-4 p-2 mb-4 btn btn-style btn-color-blue">Ajouter produit</a>
            <div class="accordion m-auto w-100" id="accordionPanelsStayOpen">
            <?php
                foreach($products as $key => $product){
            ?>
                    <div class="accordion-item bg-blue-2">
                        <h2 class="accordion-header" id="heading<?=$product['id_product']?>" style="width: 100%;">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <?=$product['title']?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <a href="gestion.php?action=delete&id_product=<?=$product['id_product']?>" style="text-decoration: none; color: #fff; border:#fff solid 2px; padding: 5px;"><i class="bi bi-trash3-fill text-white"></i> Supprimer</a>
                                <a href="gestion.php?action=update&id_product=<?=$product['id_product']?>" style="text-decoration: none; color: #fff; border:#fff solid 2px; padding: 5px;"><i class="bi bi-pencil-fill text-white"></i> Modifier</a>
                                <li class="text-white p-3 mt-3" style="border-bottom:#fff solid 2px;">ID : <?=$product['id_product']?></i></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Titre : <?=$product['title']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Image du produit : <img src="<?=RACINE_SITE."/assets/".$product['image']?>" alt="<?=$product['alt']?>" class="product-img-dashboard m-auto"></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Description : <?=substr($product['description'], 0, 20)?> ...</li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Catégorie : <?=$product['category']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Prix : <?=$product['price']?></li>
                                <li class="text-white p-3" style="border-bottom:#fff solid 2px;">Image Alt : <?=$product['alt']?></li>
                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>
            </div>
        </div>
    </div>