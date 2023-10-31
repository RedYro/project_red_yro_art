<?php
    $contentDescription = "Red Yro's Art Panier";
    $title = "Panier";

    require_once "../inc/functions.inc.php";

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }
    if(isset($_POST['ajouter_panier'])){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        $productExist = false; // Pour vérifier si le produit existe
        foreach($_SESSION['cart'] as $key => $productExistence){
            if($productExistence['id_product'] == $_POST['id_product']){
                $_SESSION['cart'][$key]['quantity']++;
                $productExist = true;
                break;
            }
        }
        if($productExist == false){
            $newProduct = array(
                'id_product' => $_POST['id_product'],
                'title' => $_POST['title'],
                'image' => $_POST['image'],
                'description' => $_POST['description'],
                'category' => $_POST['category'],
                'quantity' => 1,
                'price' => $_POST['price'],
                'alt' => $_POST['alt'],
                );
                $_SESSION['cart'][] = $newProduct;
            }
        }

    // Vérification de la suppression d'un produit
    if(isset($_SESSION['cart'])){
        if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_POST['id_product'])){
            $idProductForDelete = $_POST['id_product'];
            // Parcours du panier à la recherche des produits correspondants à une suppression
            foreach ($_SESSION['cart'] as $key => $productExistence){
                if(isset($productExistence['id_product']) && $productExistence['id_product'] == $idProductForDelete){
                    // Supprimer un produit du panier
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexe le tableau après la suppression
                    if(empty($_SESSION['cart'])){
                        unset($_SESSION['cart']);
                    }
                }
            }
        }else if(isset($_GET['vider'])){
            unset($_SESSION['cart']);
        }
    }

    require_once "../inc/header.inc.php";

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="container-fluid bg-blue-2">
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-blue title-style-h1">Votre panier</h1>
        <div class="row justify-content-center m-auto p-5 w-100 panier-style-blue">
            <div class="row flex-column">
                <?php
                    $info = "";
                    if(empty($_SESSION['cart']) && !isset($_SESSION['cart'])){
                        $info = alert("Votre panier est vide", "secondary");
                        echo $info;
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-center align-items-center m-auto banner-panier-size">
                        <img src="<?=RACINE_SITE . "/assets/img/Blue_Hada_Red_Yro.png"?>" alt="Blue Hada & Red Yro" class="banner-panier">
                    </div>
                </div>
                <div class="row mt-5">
                    <a href="<?=RACINE_SITE?>/all_products.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-blue btn-size-2">Voir tous les produits</a>
                </div>
                <?php
                    } else{
                ?>
                <a href="?vider" class="btn btn-lg mb-5 fs-4 align-self-end btn-style btn-color-blue btn-size-1">Vider le panier</a>
                <?php
                    foreach($_SESSION['cart'] as $product){
                ?>
                <div class="col-sm 12 d-flex justify-content-evenly py-5 m-auto underline-panier">
                    <div class="d-flex p-1 img-panier-size">
                        <img src="<?=RACINE_SITE."/assets/".$product['image']?>" alt="<?=$product['alt']?>" class="img-panier">
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center">
                        <div class="d-flex p-4">
                            <p class="m-auto"><?=$product['title']?></p>
                        </div>
                        <div class="d-flex p-4">
                            <p class="m-auto">Quantité : <?=$product['quantity']?></p>
                        </div>
                        <div class="d-flex p-4">
                            <p class="m-auto">Prix : <?=$product['price']?> €</p>
                        </div>
                        <div class="d-flex p-4">
                            <form action="?action=supprimer" method="post">
                                <input type="hidden" name="id_product" value="<?= $product['id_product']?>">
                                <button class="btn fs-5 text-white" type="submit">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }   
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="total" value="<?=$total?>">
                    <button type="submit" class="btn mt-5 p-2 fs-4 w-25 btn-style btn-color-blue" id="checkout-button">Payer</button>
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </main>
<?php
    } else{
?>
    <main class="container-fluid bg-red-2">
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-red title-style-h1">Votre panier</h1>
        <div class="row justify-content-center m-auto p-5 w-100 panier-style-red">
            <div class="row flex-column">
                <?php
                    $info = "";
                    if(empty($_SESSION['cart']) && !isset($_SESSION['cart'])){
                        $info = alert("Votre panier est vide", "secondary");
                        echo $info;
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-center align-items-center m-auto banner-panier-size">
                        <img src="<?=RACINE_SITE . "/assets/img/Blue_Hada_Red_Yro.png"?>" alt="Blue Hada & Red Yro" class="banner-panier">
                    </div>
                </div>
                <div class="row mt-5">
                    <a href="<?=RACINE_SITE?>/all_products.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-red btn-size-2">Voir tous les produits</a>
                </div>
                <?php
                    } else{
                ?>
                <a href="?vider" class="btn btn-lg mb-5 fs-4 align-self-end btn-style btn-color-red btn-size-1">Vider le panier</a>
                <?php
                    foreach($_SESSION['cart'] as $product){
                ?>
                <div class="col-sm 12 d-flex justify-content-evenly py-5 m-auto underline-panier">
                    <div class="d-flex p-1 img-panier-size">
                        <img src="<?=RACINE_SITE."/assets/".$product['image']?>" alt="<?=$product['alt']?>" class="img-panier">
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center">
                        <div class="d-flex p-4">
                            <p class="m-auto"><?=$product['title']?></p>
                        </div>
                        <div class="d-flex p-4">
                            <p class="m-auto">Quantité : <?=$product['quantity']?></p>
                        </div>
                        <div class="d-flex p-4">
                            <p class="m-auto">Prix : <?=$product['price']?> €</p>
                        </div>
                        <div class="d-flex p-4">
                            <form action="?action=supprimer" method="post">
                                <input type="hidden" name="id_product" value="<?= $product['id_product']?>">
                                <button class="btn fs-5 text-white" type="submit">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }   
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="total" value="<?=$total?>">
                    <button type="submit" class="btn mt-5 p-2 fs-4 w-25 btn-style btn-color-red" id="checkout-button">Payer</button>
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </main>
<?php
    }

    require_once "../inc/footer.inc.php";
?>