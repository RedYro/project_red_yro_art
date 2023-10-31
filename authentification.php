<?php
    $contentDescription = "Red Yro's Art Authentification";
    $title = "Authentification";

    require_once("inc/functions.inc.php");

    if(!empty($_SESSION['utilisateur'])){
        header('location:'.RACINE_SITE.'/profil/compte.php');
        exit();
    }

    $info = "";

    if(!empty($_POST)){
        $verif = true;
        foreach($_POST as $key => $value){
            if(empty(trim($value))){
                $verif = false;
            }
        }
        if(!$verif){
            $info = alert("Veuillez renseigner tous les champs !", "danger");
        } else{
            $pseudo = trim($_POST['pseudo']);
            $mail = trim($_POST['mail']);
            $mdp = trim($_POST['password']);
            // Vérification des données passées dans le formulaire dans la DB, récupération de celles-ci dans la DB si elles existent
            $user = checkUser($pseudo, $mail);
            // On vérifie si le mot de passe est bon
            // password_verify() pour vérifier si un mot de passe correspond à un mot de passe haché créé par "password_hash()"
            // Si le "hash" du mot de passe de la DB correspond au mot de passe du formulaire, alors "password_verify" retourne true
            if($user){
                if(password_verify($mdp, $user['password'])){
                    /* 
                    Suite à la connexion on va créer une session :
                    Principe des sessions : un fichier temporaire appelé "session" est créé sur le serveur, avec un identifiant unique. Les sessions constituent un moyen de stocker les données sur le serveur. Cette session est liée à un internaute car ces données sont propres à ce dernier,  Les données du fichier de session sont accessibles et manipulables à partir de la superglobale $_SESSION, elle est mêmoriser par le serveur et est disponible tant que la session de l'utilsateur est maintenu sur le serveur.
                    Quand une session est créée sur le serveur, ce dernier envoie son identifiant (unique) au client sous forme d'un cookie.
                    un cookie est déposé sur le poste de l'internaute avec l'identifiant (au nom de PHPSESSID). Ce cookie se détruit lorsqu'on quitte le navigateur.      
                    */
                    // Création ou ouverture d'une session :
                    // Une variable de session est une variable superglobale du nom de $_SESSION, c'est un tableau associatif
                    // Stockage des données dans cette session
                    $_SESSION['utilisateur'] = $user; // On crée une session avec les infos de l'utilisateur provenant de la DB. Cette variable créée et affectée dans cette page sera accessible partout dans le site une fois que la fonction "session_start" est appelée
                    // Redirection vers la page du compte
                    header('location:'.RACINE_SITE.'/profil/compte.php');
                    exit();
                } else{
                    $info = alert("Les identifiants sont incorrects", "danger");
                }
            } else{
                $info = alert("Les identifiants sont incorrects", "danger");
            }
        }
    }

    require_once("inc/header.inc.php");
?>
    <main class="bg-red-2"> 
        <h1 class="text-center mb-5 p-2 w-50 m-auto bg-red title-style-h1">Se connecter</h1>
        <div class="w-75 m-auto p-5 form-authentification-style">
            <?php
                echo($info);  // Pour afficher les messages de vérification
            ?>
            <form method="post" class="p-5" >  
                <div class="row mb-3">
                    <div class="col-sm-12 col-12 col-lg-12 col-md-12 mb-5">
                        <label for="pseudo" class="form-label mb-3">Pseudo</label>
                        <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                    </div>
                    <div class="col-sm-12 col-12 col-lg-12 col-md-12 mb-5">
                        <label for="mail" class="form-label">Mail</label>
                        <input type="mail" class="form-control fs-5" id="mail" name="mail" placeholder="exemple.email@exemple.com">
                    </div>
                     <div class="col-sm-12 col-12 col-lg-12 col-md-12 mb-5">
                        <label for="password" class="form-label mb-3">Mot de passe</label>
                        <input type="password" class="form-control fs-5 mb-3" id="password" name="password">
                        <!-- "onclick" pour indiquer l'event JS avec la fonction à éxécuter quand l'action est faite -->
                        <input type="checkbox" onclick="showPasswordLogIn()"> <span class="authentification-text-color">Afficher / masquer le mot de passe</span>
                    </div>
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-red" type="submit">Se connecter</button>
                    <p class="mt-5 text-center">Vous n'avez pas encore de compte ? <a href="register.php" class="authentification-text-color">Créez en un ici !</a></p>
                </div>
            </form>
        </div>
    </main>
<?php
    require_once("inc/footer.inc.php");
?>