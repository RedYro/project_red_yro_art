<?php
    $contentDescription = "Red Yro's Art S'inscrire";
    $title = "Inscription";

    require_once("inc/functions.inc.php");
    
    // Si utilisateur l'utilistateur est connecté , pas d'accès à la page register mais redirection vers la page compte
    if(!empty($_SESSION['user'])){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }
    
    $info = ""; // Variable qui recevra les messages d'alerte, déclaration dans le script en général avec une valeur vide pour ne pas engendrer d'erreur sur la page 
    
    if(!empty($_POST)){
        // debug($_POST);
        $verif = true;
        foreach($_POST as $key => $value){
            if(empty(trim($value))){
                $verif = false;
            }
        }
        if(!$verif){
            $info = alert("Veuillez renseigner tous les champs", "danger");
        } else{
            // Stockage des valeurs des champs dans des variables et en les passant dans la fonction "trim()"
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $pseudo = trim($_POST['pseudo']);
            $mail = trim($_POST['mail']);
            $password = trim($_POST['mdp']);
            $confirmPassword = trim($_POST['confirmMdp']);
            $address = trim($_POST['address']);
            $zip = trim($_POST['zip']);
            $city = trim($_POST['city']);
            $country = trim($_POST['country']);
            $genre = trim($_POST['genre']);
            
            if(!isset($firstName) || strlen($firstName) < 2 || preg_match('/[0-9]+/', $firstName)){
                $info .= alert("Veuillez vérifier votre prénom", "danger");
            }
            if(!isset($lastName) || strlen($lastName) < 2 || preg_match('/[0-9]+/', $lastName)){
                $info .= alert("Veuillez vérifier votre nom", "danger");
            }
            if(!isset($pseudo) || strlen($pseudo) < 2){
                $info .= alert("Veuillez vérifier votre pseudo", "danger");
            }
            if(!isset($mail) || strlen($mail) > 25 || !filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $info .= alert("Veuillez vérifier votre mail", "danger");
            }
            if(!isset($password) || strlen($password) < 5 || strlen($password) > 15){
                $info .= alert("Veuillez vérifier votre mot de passe", "danger");
            }
            if(!isset($confirmPassword) || $confirmPassword !== $password){
                $info .= alert("Veuillez vérifier la correspondance du mot de passe", "danger");
            }
            if(!isset($genre) || ($genre != 'f' && $genre != 'm')){
                $info .= alert("Veuillez vérifier le genre", "danger");
            }
            if(!isset($address) || strlen($address) < 5 || strlen($address) > 50){
                $info .= alert("Veuillez vérifier votre adresse", "danger");
            }
            if(!isset($zip) || !preg_match('/^[0-9]{5}$/', $zip)){ // preg_match vérifie si le code postal correspond à l'expression régulière précisée. 
                /* La regex s'écrit entre #
                Le ^ définit le début de l'expression
                Le $ définit la fin de l'expression     
                [0-9] définit l'intervalle des chiffres autorisés
                {2} définit si l'on en veut 2 précisément
                {3} définit si l'on en veut 3 précisément
                */
                $info .= alert("Veuillez vérifier votre code postal", "danger");
            }
            if(!isset($city) || strlen($city) > 30){
                $info .= alert("Veuillez vérifier votre ville", "danger");
            }
            if(!isset($country) || strlen($country) < 5 || strlen($country) > 50){
                $info .= alert("Veuillez vérifier votre pays", "danger");
            }
            
            // Vérification de l'adressse mail et pseudo => inexistants dans la DB (pour éviter l'insertion de plusieurs mails identiques ou pseudos)
            
            // Vérification de l'email dans la DB
            $mailExist = checkMailUsers($mail);
            if($mailExist){ // Vérification de l'email dans la DB, si elle existe
                $info .= alert("L'adresse mail est déjà existante ou vous avez déjà un compte !","danger");
            }
            $pseudoExist = checkPseudoUsers($pseudo);
            if($pseudoExist){
                $info .= alert("Le pseudo est déjà existant","danger");
            }
        }
        if(empty($info)){
            $password = password_hash($password, PASSWORD_DEFAULT); 
            // cette fonction prédéfinie permet de hasher le mot de passe : générer une chaîne de caractére unique à partire d'une entrée. c'est un mécanisme unidirectionnelle dont l'utilité est de ne pas déchifré un hash Il faudra lors de la connexion comparer le hash de la BDD avec celui du mdp de l'internaute.
            // PASSWORD_DEFAULT c'est un paramètre qui indique l'alogorithme utilisé pour effectuer le hashage c'est le plus recommandé
            inscriptionUser($firstName, $lastName, $pseudo, $mail, $password, $address, $zip, $city, $country, $genre);
            header('location:'.RACINE_SITE.'/authentification.php');
            exit();
        }
    }
    
    require_once("inc/header.inc.php");
    ?>
    <main class="bg-red-2"> 
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-red title-style-h1">Inscription</h1>
        <div class="w-75 m-auto form-inscription-style">
            <?php
                echo  $info; // pour afficher les messages
            ?>
            <form method="post" class="p-5">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="firstName" class="form-label mb-3">Prénom</label>
                        <input type="text" class="form-control fs-5" id="firstName" name="firstName" >
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="lastName" class="form-label mb-3">Nom</label>
                        <input type="text" class="form-control fs-5" id="lastName" name="lastName">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="pseudo" class="form-label mb-3">Pseudo</label>
                        <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="mail" class="form-label mb-3">Email</label>
                        <input type="text" class="form-control fs-5" id="mail" name="mail" placeholder="exemple.email@exemple.com">
                    </div>      
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="mdp" class="form-label mb-3">Mot de passe</label>
                        <input type="password" class="form-control fs-5" id="mdp" name="mdp"  placeholder="Entrer votre mot de passe">
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label for="confirmMdp" class="form-label mb-3">Confirmation mot de passe</label>
                        <input type="password" class="form-control fs-5 mb-3" id="confirmMdp" name="confirmMdp" placeholder="Confirmer votre mot de passe">
                        <input type="checkbox" onclick="mdpInscription()"><span class="inscription-text-color"> Afficher / masquer le mot de passe</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6 mb-5">
                        <label class="form-label mb-3">Civilité</label>     
                        <select class="form-select fs-5" name="genre">
                            <option value="m">Homme</option>
                            <option value="f">Femme</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <label for="address" class="form-label mb-3">Adresse</label>
                        <input type="text" class="form-control fs-5" id="address" name="address">
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <label for="zip" class="form-label mb-3">Code postal</label>
                        <input type="text" class="form-control fs-5" id="zip" name="zip">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                         <label for="city" class="form-label mb-3">Ville</label>
                        <input type="text" class="form-control fs-5" id="city" name="city">
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <label for="country" class="form-label mb-3">Pays</label>
                        <input type="text" class="form-control fs-5" id="country" name="country">
                    </div>
                </div>
                <div class="row mt-5">
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-blue" type="submit">S'inscrire</button>
                    <p class="mt-5 text-center">Vous avez dèjà un compte ? <a href="authentification.php" class="inscription-text-color-bis">Connectez-vous ici !</a></p>
                </div>
            </form>
        </div>
    </main>
<?php
    require_once("inc/footer.inc.php");
?>