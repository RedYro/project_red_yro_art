<?php
    $contentDescription = "Red Yro's Art Accueil";
    $title = "Accueil";

    require_once "inc/functions.inc.php";
    require_once "inc/header.inc.php";

    $productsImg = allProducts();

    // Variable permettant de stocker toutes les images qui n'ont pas la catégorie "Logo" grâce à la fonction "array_filter()" qui exclue toutes les images qui ont la catégorie "Logo" 
    $productsImgFiltered = array_filter($productsImg, function($productImg){ // => Fonction de rappel qui détermine si un élément doit être inclus dans le tableau qui va résulter 
        return $productImg['category'] !== 'Logo'; // Pour retourner les images dont la catégorie est différente de "Logo"
    });

    $productsImgFilteredBis = array_filter($productsImg, function($productImg){
        return $productImg['category'] !== 'Illustration';
    });

    shuffle($productsImgFilteredBis);
    shuffle($productsImgFiltered); // "shuffle()" => permet de mélanger le tableau obtenu grâce à la fonction "allProducts" afin d'avoir des images aléatoires 
    
    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="container-fluid bg-blue-2">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="d-flex justify-content-center align-items-center m-auto banner-img-size">
                    <img src="<?=RACINE_SITE . "/assets/img/Blue_Hada_Light_Armor_banner_v1.png"?>" alt="Blue Light Armor classic" class="banner-img">
                </div>
            </div>
        </div>
        <h1 class="text-center mb-5 mt-5 p-2 m-auto bg-blue title-style-h1 title-size-3">Présentation</h1>
        <div class="d-flex">
            <p class="paragraphe-style paragraphe-color-blue w-75 m-auto">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/services.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-blue btn-size-1">Voir tous les services</a>
        </div>
        <div class="row pt-5 pb-5">
            <?php
                foreach ($productsImgFiltered as $key => $productImg){
                    if($key < 2){ // Pour afficher seulement 2 produits de catégorie "illustration" sur la page
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 p-3 m-auto">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 random-img-accueil-size">
                    <img src="<?=RACINE_SITE."/assets/".$productImg['image']?>" alt="<?=$productImg['alt']?>" class="random-img-accueil">
                </div>
            </div>
            <?php
                    } 
                }
            ?>
        </div>
        <div class="row pt-5 pb-5">
            <?php
                foreach ($productsImgFilteredBis as $key => $productImgBis){
                    if($key < 2){ // Pour afficher seulement 2 produits de catégorie "logo" sur la page
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 p-3 m-auto">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 random-img-accueil-bis-size">
                    <img src="<?=RACINE_SITE."/assets/".$productImgBis['image']?>" alt="<?=$productImgBis['alt']?>" class="random-img-accueil-bis">
                </div>
            </div>
            <?php
                    } 
                }
            ?>
        </div>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/all_products.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-red btn-size-1">Voir tous les produits</a>
        </div>
        <?php
            if(!empty($_SESSION['utilisateur'])){
        ?>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/profil/compte.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-blue btn-size-2">Voir le compte</a>
        </div>
        <?php
            } else{
        ?>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/register.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-blue btn-size-2">S'inscrire</a>
        </div>
        <?php
            }
        ?>
    </main>
<?php
    } else{
?>
    <main class="container-fluid bg-red-2">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="d-flex justify-content-center align-items-center m-auto banner-img-size">
                    <img src="<?=RACINE_SITE . "/assets/img/Blue_Hada_Light_Armor_banner_v2.png"?>" alt="Blue Red Version" class="banner-img">
                </div>
            </div>
        </div>
        <h1 class="text-center mb-5 p-2 m-auto bg-red title-style-h1">Présentation</h1>
        <div class="d-flex">
            <p class="paragraphe-style paragraphe-color-red w-75 m-auto">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/services.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-red btn-size-1">Voir tous les services</a>
        </div>
        <div class="row pt-5 pb-5 m-auto">
            <?php
                foreach ($productsImgFiltered as $key => $productImg) {
                    if($key < 2){ 
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 p-3 m-auto">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 random-img-accueil-size">
                    <img src="<?=RACINE_SITE."/assets/".$productImg['image']?>" alt="<?=$productImg['alt']?>" class="random-img-accueil">
                </div>
            </div>
            <?php
                    } 
                }
            ?>
        </div>
        <div class="row pt-5 pb-5">
            <?php
                foreach ($productsImgFilteredBis as $key => $productImgBis) {
                    if($key < 2){ 
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 p-3 m-auto">
                <div class="d-flex flex-column align-items-center justify-content-center m-auto p-2 mb-2 random-img-accueil-bis-size">
                    <img src="<?=RACINE_SITE."/assets/".$productImgBis['image']?>" alt="<?=$productImgBis['alt']?>" class="random-img-accueil-bis">
                </div>
            </div>
            <?php
                    } 
                }
            ?>
        </div>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/all_products.php" class="m-auto btn btn-lg fs-5 btn-style btn-color-red btn-size-1">Voir tous les produits</a>
        </div>
        <?php
            if(!empty($_SESSION['utilisateur'])){
        ?>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/profil/compte.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-blue btn-size-2">Voir le compte</a>
        </div>
        <?php
            } else{
        ?>
        <div class="row mt-5">
            <a href="<?=RACINE_SITE?>/register.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-blue btn-size-2">S'inscrire</a>
        </div>
        <?php
            }
        ?>
    </main>
<?php
    }

    require_once "inc/footer.inc.php";
?>