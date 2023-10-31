<?php
    $contentDescription = "Red Yro's Art Gestion";
    $title = "Gestion produits";

    require_once("../inc/functions.inc.php");

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }

    if(isset($_GET['action']) && isset($_GET['id_product'])){
        // Suppression produits // 
        if(!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id_product'])){
            $idProduct = htmlentities($_GET['id_product']);
            deleteProduct($idProduct);
            header("location:dashboard.php?produits_php");
            exit();
        } else if(!empty($_GET['action']) && $_GET['action'] == 'update' && !empty($_GET['id_product'])){
            $idProduct = htmlentities($_GET['id_product']);
            $product= showProduct($idProduct);
        } else{
            header("location:dashboard.php?produits_php");
            exit();
        }
    }

    // $_POST => ne prends pas en compte les champs de type "file"
    // $_FILES => permet de prendre en compte les champs de type "file" 

    $info = ""; // Variable qui recevra les messages d'alerte, déclaration dans le script en général avec une valeur vide pour ne pas engendrer d'erreur sur la page 

    if(!empty($_POST)){
        $verif = true;
        foreach($_POST as $key => $value){
            if(empty(trim($value))){
                $verif = false;
            }
        }
        // superglobale "$_FILES" a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
        if(!empty($_FILES['image']['name'])){ // si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo
            $image = 'img/'.$_FILES['image']['name']; // $image contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.
            copy($_FILES['image']['tmp_name'], '../assets/'. $image);
            // enregistrement du fichier image qui se trouve à l'adresse contenue dans $_FILES['image']['tmp_name'] vers la destination qui est le dossier "img" à l'adresse "../assets/nom_du_fichier.jpg".
        }
        if(!$verif || empty($image)){ // vérification de la valeur final de la variable $verif et de la valeur de la variable $image : si $verif est false ou $image est vide je stock un message d'erreur dans $info
            $info = alert("Tous les champs sont requis", "danger");
        } else{
            //si tout est renseigné je commence la validation des champs
            /* on vérifie l'image : 
            // $_FILES['image']['name'] Nom
            // $_FILES ['image']['type'] Type
            // $_FILES ['image']['size'] Taille
            // $_FILES ['image']['tmp_name'] Emplacement temporaire
            // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné */

            if($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])){
                $info .= alert("Image non valide", "danger");
            }

            $titleProduct = trim($_POST['title']);
            $alt = trim($_POST['alt']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $category = trim($_POST['category']);

            if(strlen($titleProduct) < 2){
                $info .= alert("Champ Titre produit non valide", "danger");
            }
            if(strlen($alt) < 3){
                $info .= alert("Champ Alt image non valide", "danger");
            }
            if(strlen($description) < 25){ 
                $info .= alert("La description doit faire plus de 25 caractères", "danger");
            }
            if(!is_numeric($price)){
                $info .= alert("Le prix n'est pas valide", "danger");
            }
            // S'il n'y aucune erreur sur le formulaire
            if(empty($info)){
                $titleProduct = htmlentities($titleProduct);
                $description = htmlentities($description);
                $category = htmlentities($category); 
                $price = (float) htmlentities($price); // conversion de la valeur de la variable "$price" en "float"
                $alt = htmlentities($alt);
                if(isset($_GET['action']) && $_GET['action']=='update' && isset($_GET['id_product']) && !empty($_GET['id_product'])){ // on vérifie l'action dans l'url et l'id 
                    $idProduct = htmlentities($product['id_product']);
                    $result = updateProduct($idProduct, $titleProduct, $image, $description, $category, $price, $alt);
                    header("location:dashboard.php?produits_php");
                    exit();
                }else{
                    $result = addProduct($titleProduct, $image, $description, $category, $price, $alt);
                    header("location:dashboard.php?produits_php");
                    exit();
                }
            }
        }
    }
    
    require_once("../inc/header.inc.php");
?>
    <main class="bg-blue-2">
        <h1 class="text-center mb-5 p-2 w-50 m-auto title-style-h1 title-color-blue"><?=(isset($product)) ? 'Modifier produit' : 'Ajouter produit'?></h1>
        <?php
            echo $info;
        ?>
        <div class="w-75 m-auto form-gestion-product-style">
            <form method="post" enctype="multipart/form-data" class="p-5">
                <!-- "enctype" spécifie que le formulaire envoie des fichiers en plus des données "text" : permet d'uploader un fichier (image etc.) => obligatoire pour faire cela -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="title">Titre du produit</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?=$product['title'] ?? '';?>"> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" value="<?=RACINE_SITE."assets/".$product['image'] ?? '';?>">
                        <!-- "type=file" ne pas oublier attribut enctype="multipart/form-data" dans la balise form -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="alt">Alt image</label>
                        <input type="text" class="form-control" id="alt" name="alt" value="<?=$product['alt'] ?? '';?>">
                    </div>
                </div>
                <div class="row">                         
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="category">Catégorie</label>
                        <input type="text" class="form-control" id="category" name="category" value="<?=$product['category'] ?? '';?>">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <label for="price">Prix</label>
                        <div class=" input-group">
                            <input type="text" class="form-control" id="price" name="price" aria-label="Euros amount (with dot and two decimal places)" value="<?=$product['price'] ?? '';?>">
                            <span class="input-group-text">€</span>
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="10"><?=$product['description'] ?? '';?></textarea>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-blue mt-5"><?=(isset($product)) ? 'Modifier produit' : 'Ajouter produit'?></button>
                </div>
            </form>
        </div>
    </main>
<?php
    require_once("../inc/footer.inc.php");
?>