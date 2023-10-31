<?php
    $contentDescription = "Red Yro's Art Modification des informations du compte";
    $title = "Modification du compte";

    require_once("../inc/functions.inc.php");

    if(empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/authentification.php');
        exit();
    }

    $info = "";

    if(!empty($_POST)){
        // Conditions pour vérifier les données envoyées du formulaire //

        // Pour vérifier si les 2 champs pour changer le pseudo correspondent bien et si ils sont supérieurs à 2 caractères.
        if(!empty(($_POST['newPseudo'])) && !empty(($_POST['confirmNewPseudo'])) && strlen($_POST['newPseudo']) > 2 && strlen($_POST['confirmNewPseudo'] > 2)){
            if($_POST['newPseudo'] === $_POST['confirmNewPseudo']){
                $pseudo = trim($_POST['newPseudo']);
            } else{
                $info .= alert("Le pseudo et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $pseudo = $_SESSION['utilisateur']['pseudo'];
        }

        // Pour vérifier si les 2 champs pour changer le mail correspondent bien, si ils sont inférieurs ou égals à 25 caractères et si ceux-ci sont bien des adresses mails.
        if(!empty(($_POST['newMail'])) && !empty(($_POST['confirmNewMail'])) && strlen($_POST['newMail']) <= 25 && strlen($_POST['confirmNewMail']) && filter_var(($_POST['newMail']), FILTER_VALIDATE_EMAIL) && filter_var(($_POST['confirmNewMail']), FILTER_VALIDATE_EMAIL)){
            if($_POST['newMail'] === $_POST['confirmNewMail']){
                $mail = trim($_POST['newMail']);
            } else{
                $info .= alert("Le mail et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $mail = $_SESSION['utilisateur']['mail'];
        }

        // Pour vérifier si les 2 champs pour changer l'adresse correspondent bien et que le nombre de caractères est bien supérieur à 5 mais inférieur à 50.
        if(!empty(($_POST['newAddress'])) && !empty(($_POST['confirmNewAddress'])) && strlen($_POST['newAddress']) > 5 && strlen($_POST['confirmNewAddress']) > 5 && strlen($_POST['newAddress']) < 50 && strlen($_POST['confirmNewAddress']) < 50){
            if($_POST['newAddress'] === $_POST['confirmNewAddress']){
                $address = trim($_POST['newAddress']);
            } else{
                $info .= alert("L'adresse et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $address = $_SESSION['utilisateur']['address'];
        }

        // Pour vérifier si les 2 champs pour changer le code postal correspondent bien et que ceux-ci contiennent bien 5 chiffres.
        if(!empty(($_POST['newZip'])) && !empty(($_POST['confirmNewZip'])) && preg_match('/^[0-9]{5}$/', ($_POST['newZip'])) && preg_match('/^[0-9]{5}$/', ($_POST['newZip']))){
            if($_POST['newZip'] === $_POST['confirmNewZip']){
                $zip = trim($_POST['newZip']);
            } else{
                $info .= alert("Le code postal et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $zip = $_SESSION['utilisateur']['zip'];
        }

        // Pour vérifier si les 2 champs pour changer la ville correspondent bien et que le nombre de caractères soit inférieur ou égal à 30.
        if(!empty(($_POST['newCity'])) && !empty(($_POST['confirmNewCity'])) && strlen($_POST['newCity']) <= 30 && strlen($_POST['confirmNewCity']) <= 30){
            if($_POST['newCity'] === $_POST['confirmNewCity']){
                $city = trim($_POST['newCity']);
            } else{
                $info .= alert("La ville et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $city = $_SESSION['utilisateur']['city'];
        }

        // Pour vérifier si les 2 champs pour changer le pays correspondent bien, que le nombre de caractères est bien supérieur à 5 mais inférieur à 50.
        if(!empty(($_POST['newCountry'])) && !empty(($_POST['confirmNewCountry'])) && strlen($_POST['newCountry']) > 5 && strlen($_POST['confirmNewCountry']) > 5 && strlen($_POST['newCountry']) < 50 && strlen($_POST['confirmNewCountry']) < 50){
            if($_POST['newCountry'] === $_POST['confirmNewCountry']){
                $country = trim($_POST['newCountry']);
            } else{
                $info .= alert("Le pays et sa confirmation ne correspondent pas", "danger");
            }
        } else{ // Si ceux-ci sont vides, on reprend la valeur initiale stockée dans "$_SESSION"
            $country = $_SESSION['utilisateur']['country'];
        }

        // Pour vérifier si les 2 champs pour le mot de passe correspondent bien.
        if(!empty(($_POST['passwordModif'])) && !empty(($_POST['passwordModifConfirm']))){
            if($_POST['passwordModif'] === $_POST['passwordModifConfirm']){
                $password = trim($_POST['passwordModif']);
            } else{
                $info .= alert("Votre mot de passe est incorrect !", "danger");
            }
        }

        $userId = $_SESSION['utilisateur']['id_user'];
        $user = checkUserId($userId);
        if($user){
            if(password_verify($password, $user['password'])){
                updateUserInfo($userId, $pseudo, $mail, $address, $zip, $city, $country);
                // Stockage des nouvelles ou anciennes valeurs dans $_SESSION afin de mettre à jour le compte avec les nouvelles informations sans avoir à se déconnecter
                $_SESSION['utilisateur']['pseudo'] = $pseudo;
                $_SESSION['utilisateur']['mail'] = $mail;
                $_SESSION['utilisateur']['address'] = $address;
                $_SESSION['utilisateur']['zip'] = $zip;
                $_SESSION['utilisateur']['city'] = $city;
                $_SESSION['utilisateur']['country'] = $country;
                header('location:'.RACINE_SITE.'/profil/compte.php');
                exit();
            } 
        }
    }

    require_once("../inc/header.inc.php");

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="container-fluid bg-blue-2">
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-blue title-style-h1">Modification des informations du compte</h1>
        <div class="w-75 m-auto p-5 form-authentification-style">
            <form method="post">
                <div class="row mb-3">
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newPseudo" class="form-label mb-3">Nouveau pseudo</label>
                        <input type="text" class="form-control fs-5" id="newPseudo" name="newPseudo">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="confirmNewPseudo" class="form-label mb-3">Confirmation votre nouveau Pseudo</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewPseudo" name="confirmNewPseudo" placeholder="Confirmer votre nouveau pseudo">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newMail" class="form-label">Nouveau mail</label>
                        <input type="text" class="form-control fs-5" id="newMail" name="newMail" placeholder="exemple.email@exemple.com">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewMail" class="form-label mb-3">Confirmation votre nouveau mail</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewMail" name="confirmNewMail" placeholder="Confirmer votre nouveau mail">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newAddress" class="form-label">Nouvelle adresse</label>
                        <input type="text" class="form-control fs-5" id="newAddress" name="newAddress">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewAddress" class="form-label mb-3">Confirmation votre nouvelle adresse</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewAddress" name="confirmNewAddress" placeholder="Confirmer votre nouvelle adresse">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newZip" class="form-label">Nouveau code postal</label>
                        <input type="text" class="form-control fs-5" id="newZip" name="newZip">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewZip" class="form-label mb-3">Confirmation votre nouveau code postal</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewZip" name="confirmNewZip" placeholder="Confirmer votre nouveau code postal">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newCity" class="form-label">Nouvelle ville</label>
                        <input type="text" class="form-control fs-5" id="newCity" name="newCity">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewCity" class="form-label mb-3">Confirmation votre nouvelle ville</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewCity" name="confirmNewCity" placeholder="Confirmer votre nouvelle ville">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newCountry" class="form-label">Nouveau pays</label>
                        <input type="text" class="form-control fs-5" id="newCountry" name="newCountry">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewCountry" class="form-label mb-3">Confirmation votre nouveau pays</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewCountry" name="confirmNewCountry" placeholder="Confirmer votre nouveau pays">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                            <label for="password" class="form-label mb-3">Mot de passe</label>
                            <input type="password" class="form-control fs-5 mb-3" id="passwordModif" name="passwordModif" required>
                        </div>
                        <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                            <label for="password" class="form-label mb-3">Confirmer le mot de passe</label>
                            <input type="password" class="form-control fs-5 mb-3" id="passwordModifConfirm" name="passwordModifConfirm" required>
                            <input type="checkbox" onclick="showPasswordModif()"> <span class="inscription-text-color-bis">Afficher / masquer le mot de passe</span>
                        </div>
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-blue" type="submit">Modifier le profil</button>
                </div>
            </form>
        </div>
    </main>
<?php
    } else{
?>
    <main class="container-fluid bg-red-2">
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-red title-style-h1">Modification des informations du compte</h1>
        <div class="w-75 m-auto p-5 form-authentification-style">
            <form action="" method="post">
                <div class="row mb-3">
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newPseudo" class="form-label mb-3">Nouveau pseudo</label>
                        <input type="text" class="form-control fs-5" id="newPseudo" name="newPseudo">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewPseudo" class="form-label mb-3">Confirmation votre nouveau Pseudo</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewPseudo" name="confirmNewPseudo" placeholder="Confirmer votre nouveau pseudo">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newMail" class="form-label">Nouveau mail</label>
                        <input type="text" class="form-control fs-5" id="newMail" name="newMail" placeholder="exemple.email@exemple.com">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewMail" class="form-label mb-3">Confirmation votre nouveau mail</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewMail" name="confirmNewMail" placeholder="Confirmer votre nouveau mail">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newAddress" class="form-label">Nouvelle adresse</label>
                        <input type="text" class="form-control fs-5" id="newAddress" name="newAddress">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewAddress" class="form-label mb-3">Confirmation votre nouvelle adresse</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewAddress" name="confirmNewAddress" placeholder="Confirmer votre nouvelle adresse">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newZip" class="form-label">Nouveau code postal</label>
                        <input type="text" class="form-control fs-5" id="newZip" name="newZip">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewZip" class="form-label mb-3">Confirmation votre nouveau code postal</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewZip" name="confirmNewZip" placeholder="Confirmer votre nouveau code postal">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newCity" class="form-label">Nouvelle ville</label>
                        <input type="text" class="form-control fs-5" id="newCity" name="newCity">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewCity" class="form-label mb-3">Confirmation votre nouvelle ville</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewCity" name="confirmNewCity" placeholder="Confirmer votre nouvelle ville">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                        <label for="newCountry" class="form-label">Nouveau pays</label>
                        <input type="text" class="form-control fs-5" id="newCountry" name="newCountry">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="confirmNewCountry" class="form-label mb-3">Confirmation votre nouveau pays</label>
                        <input type="text" class="form-control fs-5 mb-3" id="confirmNewCountry" name="confirmNewCountry" placeholder="Confirmer votre nouveau pays">
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                            <label for="password" class="form-label mb-3">Mot de passe</label>
                            <input type="password" class="form-control fs-5 mb-3" id="passwordModif" name="passwordModif" required>
                        </div>
                        <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-5">
                            <label for="password" class="form-label mb-3">Confirmer le mot de passe</label>
                            <input type="password" class="form-control fs-5 mb-3" id="passwordModifConfirm" name="passwordModifConfirm" required>
                            <input type="checkbox" onclick="showPasswordModif()"> <span class="authentification-text-color">Afficher / masquer le mot de passe</span>
                        </div>
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-red" type="submit">Modifier le profil</button>
                </div>
            </form>
        </div>
    </main>
<?php
    }

    require_once("../inc/footer.inc.php");
?>