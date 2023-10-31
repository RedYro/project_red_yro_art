<?php
    $contentDescription = "Red Yro's Art Produits";
    $title = "Produits";

    require_once "inc/functions.inc.php";
    require_once "inc/header.inc.php";

    $productsImg = allProducts();

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="container-fluid bg-blue-2">
        <h1 class="text-center mb-5 p-2 m-auto bg-blue title-style-h1 title-size-3">Tous les produits</h1>
        <div class="row pt-5 pb-5 align-items-center justify-content-center">
        <?php
            foreach ($productsImg as $key => $productImg) {
        ?>
            <div class="col-lg-6 col-sm-12 col-12 p-3">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 w-75">
                    <h2 class="text-center fs-4 title-style-h2 title-color-red p-2 mb-5 title-size-3"><?=$productImg['title']?></h2>
                    <div class="d-flex img-all-products-size">
                        <a href="<?=RACINE_SITE."/product_show.php?id_product=".$productImg['id_product']?>" class="img-all-products">
                            <img src="<?=RACINE_SITE."/assets/".$productImg['image']?>" alt="<?=$productImg['alt']?>" class="img-all-products">
                        </a>
                    </div>
                    <a href="<?=RACINE_SITE."/product_show.php?id_product=".$productImg['id_product']?>" class="mt-4 m-auto btn fs-4 btn-style btn-color-red mt-2 btn-size-2">Voir plus</a>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </main>
<?php
    } else{
?>
    <main class="container-fluid bg-red-2">
        <h1 class="text-center mb-5 p-2 m-auto bg-red title-style-h1 title-size-3">Tous les produits</h1>
        <div class="row pt-5 pb-5 align-items-center justify-content-center">
        <?php
            foreach ($productsImg as $key => $productImg) {
        ?>
            <div class="col-lg-6 col-sm-12 col-12 p-3">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 w-75 border-all-products">
                    <h2 class="text-center fs-4 title-style-h2 title-color-blue p-2 mb-5 title-size-3"><?=$productImg['title']?></h2>
                    <div class="d-flex img-all-products-size">
                        <a href="<?=RACINE_SITE."/product_show.php?id_product=".$productImg['id_product']?>" class="img-all-products">
                            <img src="<?=RACINE_SITE."/assets/".$productImg['image']?>" alt="<?=$productImg['alt']?>" class="img-all-products">
                        </a>
                    </div>
                    <a href="<?=RACINE_SITE."/product_show.php?id_product=".$productImg['id_product']?>" class="mt-4 m-auto btn fs-4 btn-style btn-color-red mt-2 btn-size-2">Voir plus</a>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </main>
<?php
    }
    require_once "inc/footer.inc.php";
?>