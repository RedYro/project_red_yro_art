<?php
    //------ Session Start ------//
    session_start(); // Pour démarrer une nouvelle session ou reprendre une session déjà existante

    //------ Constante pour définir le chemin du site ------//

    define("RACINE_SITE", "/redyro_art"); // Constante définissant les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partir de "localhost" (ne pas prendre "localhost"), on écrit ainsi tous les chemins (exemple : src, href) en absolu avec cette constante

    //------ Fonction debug ------//

    function debug($var){
        echo "<pre class=\"border border-dark bg-light text-primary w-50 p-3\">"; // Balise "pre" avec des classes Bootstrap pour mieux voir les informations
        var_dump($var); // Permet d'afficher les informations d'une variable
        echo "</pre>";
    }

    //------ Fonction "Log out" ------//
    function logOutUser(){
        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == 'deconnexion'){
            unset($_SESSION['utilisateur']); // Suppression de l'indice "user" de la session pour se déconnecter, cette fonction détruit les variables stockées comme 'fisrt_name' par exemple.
            // or
            // session_destroy(); // Supprime toutes les données de la session déjà établie, cette fonction détruit la session sur le serveur
            header('location:'.RACINE_SITE.'/authentification.php');
            exit();
        }
    }
    logOutUser();

    //------ Fonction "alert" ------//

    function alert(string $contenu, string $class){
        return "<div class=\"alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5 mt-5\" role=\"alert\">$contenu<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>"; // Affiche un message pour alerter un utilisateur
    }

    //------ Fonction création et connexion DB ------//

    // constante du serveur => localhost
    define("DBHOST", "localhost");

    // constante utilisateur de la DB (serveur local) => root
    define("DBUSER", "root");

     // constante mot de passe (serveur local) => empty
    define("DBPASSWORD","");

    // constante nom DB
    define("DBNAME","redyro_art"); 

    function creationConnectionDB(){
        // DSN (Data Source Name)
        $dsn = "mysql:host=". DBHOST . ";charset=utf8";
        try{
            $pdo = new PDO($dsn, DBUSER, DBPASSWORD); // Instanciation de la classe PDO en utilisant le constructeur avec les constantes et variables déclarées plus tôt
            // "PDO::ATTR_ERRMODE" => Constante qui permet de spécifier l'attribut à configurer, ici en mode "error"
            // "PDO::ERRMODE_EXCEPTION" => Constante qui permet de spécifier la valeur à attribuer de l'attribut de la constante "PDO::ATTR_ERRMODE"
            // Déclaration des constantes => "PDO::ERRMODE_EXCEPTION" comme telle pour une meilleure organisation et éviter les conflits avec d'autres constantes
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Utilisation de la méthode "setAttribute" de la classe PDO avec la "->", permet de configurer l'instanciation de la classe pour lancer des exceptions quand une erreur se présente 
            // "PDO::ATTR_DEFAULT_FETCH_MODE" => Constante qui permet de spécifier l'attribut à configurer, ici en mode par défaut pour la récupération des données
            // "PDO::FETCH_ASSOC" => Constante qui permet de spécifier la valeur à attribuer de l'attribut de la constante "PDO::ATTR_DEFAULT_FETCH_MODE"
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Requête qui permet de créer une base de données si elle n'exsite pas 
            $sql = "CREATE DATABASE IF NOT EXISTS ". DBNAME;
            $pdo->exec($sql);
            // Connexion à la base de données créée
            $pdo = new PDO($dsn . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            die($e->getMessage());
        }
        return $pdo; // Utilisation de "return" pour récupérer l'objet de la fonction afin de l'appeler en dehors de la fonction
    }
    creationConnectionDB();

    //------ Fonction pour créer des tables ------//

    // table "users" //

    function creationTableUsers(){
        $pdo = creationConnectionDB();
        $sql = "CREATE TABLE IF NOT EXISTS users (id_user INT PRIMARY KEY AUTO_INCREMENT, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, pseudo VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(50) NOT NULL, zip VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, genre ENUM('f','m'), role ENUM('USER','ADMIN') DEFAULT 'USER'); image_profil VARCHAR(255))";
        $pdo->exec($sql);
    }
    // creationTableUsers();

    // table "orders" //

    function creationTableOrders(){
        $pdo = creationConnectionDB();
        $sql = "CREATE TABLE IF NOT EXISTS orders (id_order INT PRIMARY KEY AUTO_INCREMENT, price FLOAT NOT NULL, user_id INT NOT NULL)";
        $pdo->exec($sql);
    }
    // creationTableOrders();

    // table "products" //

    function creationTableProducts(){
        $pdo = creationConnectionDB();
        $sql = "CREATE TABLE IF NOT EXISTS products (id_product INT PRIMARY KEY AUTO_INCREMENT, title VARCHAR(50) NOT NULL, image VARCHAR(100) NOT NULL, description TEXT NOT NULL, category VARCHAR(50) NOT NULL, price FLOAT NOT NULL, alt VARCHAR(50) NOT NULL)";
        $pdo->exec($sql);
    }
    // creationTableProducts();

    // table "deliveries" //

    function creationTableDeliveries(){
        $pdo = creationConnectionDB();
        $sql = "CREATE TABLE IF NOT EXISTS deliveries (id_delivery INT PRIMARY KEY AUTO_INCREMENT, delivery_driver VARCHAR(50) NOT NULL, order_id INT NOT NULL)";
        $pdo->exec($sql);
    }
    // creationTableDeliveries();

    // Fonction pour créer la table de jointure //

    // table "products_orders" //

    function creationTableProductsOrders(){
        $pdo = creationConnectionDB();
        $sql = "CREATE TABLE IF NOT EXISTS products_orders (product_id INT NOT NULL, order_id INT NOT NULL, PRIMARY KEY (product_id, order_id))";
        $pdo->exec($sql);
    }
    // creationTableProductsOrders();


        //------ Fonction création "foreign key" ------//

    // $tableForeign : table où l'on va créer la clé étrangère
    // $tablePrimary : table à partir de laquelle on récupère la clé primaire
    // $foreign : nom de la clé étrangère
    // $primary : nom de la clé primaire

    function createForeignKey(string $tableForeign, string $foreign, string $tablePrimary, string $primary){
        $pdo = creationConnectionDB();
        $sql = "ALTER TABLE $tableForeign ADD CONSTRAINT FOREIGN KEY ($foreign) REFERENCES $tablePrimary ($primary)";
        $pdo->exec($sql);
    }

    // Pour créer la clé étrangère entre la table "orders" et "users"
    // createForeignKey("orders", "user_id", "users", "id_user"); 

    // Pour créer la clé étrangère entre la table "deliveries" et "orders"
    // createForeignKey("deliveries", "order_id", "orders", "id_order"); 

    // Pour créer la clé étrangère entre la table "products" et la table de jointure "products_orders"
    // createForeignKey("products_orders", "product_id", "products", "id_product");  

    // Pour créer la clé étrangère entre la table "orders" et la table de jointure "products_orders"
    // createForeignKey("products_orders", "order_id", "orders", "id_order"); 

    //------ Fonction inscription user ------//

    function inscriptionUser(string $firstName, string $lastName, string $pseudo, string $mail, string $password, string $address, string $zip, string $city, string $country, string $genre,) :void{
        $pdo = creationConnectionDB();
        $sql = "INSERT INTO users (first_name, last_name, pseudo, mail, password, address, zip, city, country, genre) VALUES (:firstName, :lastName, :pseudo, :mail, :password, :address, :zip, :city, :country, :genre)";
        $request = $pdo->prepare($sql); // Pour préparer la requête (compilation de celle-ci sans l'exécuter), permet d'éviter les injections SQL
        $request->execute(array( // Exécution de la requête préparée en fournissant les valeurs des paramètres
            ':firstName'=> $firstName,
            ':lastName' => $lastName,
            ':pseudo' => $pseudo,
            ':mail' => $mail,
            ':password' => $password,
            ':address'=> $address,
            ':zip' => $zip,
            ':city' => $city,
            ':country' => $country,
            ':genre' => $genre,
        ));
    }

    //------ Fonction pour la vérification d'un email dans la DB ------//

    function checkMailUsers(string $mail) :mixed{ // "mixed" => précise que le retour de la fonction peut être en boolean ou array  
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users WHERE mail = :mail";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':mail' => $mail
        ));
        $result = $request->fetch();
        return $result;
    }

    //------ Fonction pour la vérification d'un pseudo dans la DB ------//

    function checkPseudoUsers(string $pseudo) :mixed{
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':pseudo' => $pseudo
        ));
        $result = $request->fetch();
        return $result;
    }

    //------ Fonction pour vérifier si le mail et le pseudo d'un utilisateur sont présents dans la DB ------//

    function checkUser(string $pseudo, string $mail) :mixed{
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND mail = :mail";  ;
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':pseudo' => $pseudo,
            ':mail' => $mail
        ));
        $result = $request->fetch();
        return $result;
    }

    //------ Fonction pour vérifier si le mail et le pseudo d'un utilisateur sont présents dans la DB ------//

    function checkUserId(int $id) :mixed{
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users WHERE id_user = :id";  ;
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':id' => $id
        ));
        $result = $request->fetch();
        return $result;
    }

    //------ Fonction all users ------//

    function allUsers(): array {
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users";
        $request = $pdo->query($sql);
        $result = $request->fetchAll(); // Utilisation de "fetchAll()" pour récuperer toutes les lignes à la fois donc un tableau multidimensionnel
        return $result; 
    }

    //------ Fonction delete user ------//

    function deleteUser(int $id) :void{
        $pdo = creationConnectionDB();
        $sql = "DELETE FROM users WHERE id_user = :id_user";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':id_user' => $id
        ));
    }

    //------ Fonction pour montrer toutes les infos d'un utilisateur en particulier en fonction de son ID  ------//

    function showUser(int $id) :mixed{
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM users WHERE id_user = :id_user";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':id_user' => $id
        ));
        $result = $request->fetch(); // fetch() pour récupérer une ligne bien déterminée grâce à l'id 
        return $result;
    }

    //------ Fonction pour récupérer toutes les infos des produits ------//

    function allProducts(): array {
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM products";
        $request = $pdo->query($sql);
        $result = $request->fetchAll();
        return $result;
    }

    //------ Fonction pour supprimer un produit selon son ID ------//

    function deleteProduct(int $id) :void{
        $pdo = creationConnectionDB();
        $sql = "DELETE FROM products WHERE id_product = :id";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':id' => $id
        ));
    }

    //------ Fonction pour récupérer un produit selon son ID ------//

    function showProduct(int $id) : mixed{
        $pdo = creationConnectionDB();
        $sql = "SELECT * FROM products WHERE id_product = :id";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':id' => $id 
        ));
        $result = $request->fetch(); // fetch() pour récupérer une ligne bien déterminée grâce à l'id 
        return $result; // fonction retournant un tableau avec une seule ligne
    }

    //------ Fonction pour ajouter un produit dans la table "products" ------//

    function addProduct(string $title, string $image, string $description, string $category, float $price, string $alt) : void{
        $pdo = creationConnectionDB();  
        $sql = "INSERT INTO products (title, image, description, category, price, alt) VALUES (:title , :image, :description, :category, :price, :alt)";
        $request = $pdo->prepare($sql);
        $request->execute(array( 
            ':title' => $title,
            ':image' => $image,
            ':description' => $description, 
            ':category' => $category,
            ':price' => $price,
            ':alt' => $alt
        ));
    }

    //------ Fonction pour mettre à jour un produit selon son ID ------//

    function updateProduct(int $id, string $title, string $image, string $description, string $category, float $price, string $alt): void
    {
        $pdo = creationConnectionDB();
        $sql = "UPDATE products SET id_product = :id, title = :title, image = :image, description = :description, category = :category, price = :price, alt = :alt WHERE id_product = :id"; 
        $request = $pdo->prepare($sql);     
        $request->execute(array( 
            ':id' => $id,
            ':title' => $title,
            ':image' => $image,
            ':description' => $description, 
            ':category' => $category,
            ':price' => $price,
            ':alt' => $alt
        ));
    }

    //------ Fonction pour mettre à jour des coordonnées dans la page modification de compte ------//

    function updateUserInfo(int $id, string $pseudo, string $mail, string $address, string $zip, string $city, string $country): void
    {
        $pdo = creationConnectionDB();
        $sql = "UPDATE users SET pseudo = :pseudo, mail = :mail, address = :address, zip = :zip, city = :city, country = :country WHERE id_user = :id"; 
        $request = $pdo->prepare($sql);     
        $request->execute(array( 
            ':id' => $id,
            ':pseudo' => $pseudo,
            ':mail' => $mail,
            ':address' => $address, 
            ':zip' => $zip,
            ':city' => $city,
            ':country' => $country
        ));
    }

    //------ Fonction pour mettre à jour la photo de profil dans la page modification photo de profil du compte ------//

    function updateUserImgProfil(int $id, string $img): void
    {
        $pdo = creationConnectionDB();
        $sql = "UPDATE users SET image_profil = :image_profil WHERE id_user = :id"; 
        $request = $pdo->prepare($sql);     
        $request->execute(array( 
            ':id' => $id,
            ':image_profil' => $img
        ));
    }
    
?>