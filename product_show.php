<?php
    require_once "inc/functions.inc.php";
    if(!empty($_GET)){
        $id_product = htmlentities($_GET['id_product']);
        $product = showProduct($id_product);
        if($_GET['id_product'] != $product['id_product']){
            header('location:index.php');
            exit();
        }
        
    }
    $contentDescription = "Red Yro's Art ". $product['title'];
    $title = "Produits ".$product['title'];

    require_once "inc/header.inc.php";

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="bg-blue-2">
<?php
    } else{
?>
    <main class="bg-red-2">
<?php
    }
?>
        <div class="row justify-content-evenly p-5 m-auto">
            <div class="col-lg-6 col-sm-12 col-12 d-flex m-auto img-product-size">
                <img src="<?=RACINE_SITE."/assets/".$product['image']?>" alt="<?=$product['alt']?>" class="img-product m-auto">
            </div>
            <div class="col-lg-6 col-sm-12 col-12 d-flex flex-column justify-content-evenly p-5">
                <div class="d-flex p-4">
                    <h2 class="p-2 m-auto text-center bg-blue-2 title-style-h2 w-75"><?=$product['title']?></h2>
                </div>
                <div class="d-flex p-4">
                    <p class="paragraphe-style paragraphe-color-red w-100 m-auto"><?=$product['description']?></p>
                </div>
                <div class="row">
                    <!-- formulaire d'ajout au panier -->
                    <div class="col-sm-12 col-12">
                        <form action="boutique/panier.php" method="post" enctype="multipart/form-data" class="w-50 m-auto row justify-content-center">
                        <!-- Dans le formulaire d'ajout au panier, on ajoute des champs cachés pour chaque information que l'on souhaite conserver du produit -->
                            <input type="hidden" name="id_product" value="<?= $product['id_product']?>">
                            <input type="hidden" name="title" value="<?= $product['title'] ?>">
                            <input type="hidden" name="image" value="<?= $product['image'] ?>">
                            <input type="hidden" name="description" value="<?= $product['description'] ?>">
                            <input type="hidden" name="category" value="<?= $product['category'] ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>"> 
                            <input type="hidden" name="alt" value="<?= $product['alt'] ?>">
                            <input class="w-75 m-auto btn fs-5 btn-style btn-color-red align-self-center" type="submit" value="Ajouter au panier" name="ajouter_panier">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    require_once "inc/footer.inc.php";
?>