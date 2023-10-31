<?php
    $contentDescription = "Red Yro's Art Contact";
    $title = "Contact";

    require_once("inc/functions.inc.php");
    require_once("inc/header.inc.php");
    
    
    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
    <main class="bg-blue-2"> 
        <h1 class="text-center mb-5 p-2 w-25 m-auto bg-blue title-style-h1">Contact</h1>
        <div class="w-75 m-auto form-contact-style">
            <form method="post" class="p-5" id="formContact">
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="firstName" class="form-label mb-3">Prénom</label>
                        <input type="text" class="form-control fs-5" id="firstName" name="firstName" >
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="lastName" class="form-label mb-3">Nom</label>
                        <input type="text" class="form-control fs-5" id="lastName" name="lastName">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="pseudo" class="form-label mb-3">Pseudo</label>
                        <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="mail" class="form-label mb-3">Email</label>
                        <input type="text" class="form-control fs-5" id="mail" name="mail" placeholder="exemple.email@exemple.com">
                    </div>      
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="message">Message</label>
                        <textarea type="text" class="form-control" id="message" name="message" rows="10"></textarea>
                    </div>
                </div>
                <div class="row p-5">
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-blue">Me contacter</button>
                </div>
            </form>
        </div>
    </main>
<?php
    } else if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'USER'){
?>
    <main class="bg-red-2"> 
        <h1 class="text-center mb-5 p-2 w-25 m-auto bg-red title-style-h1">Contact</h1>
        <div class="w-75 m-auto form-contact-style">
            <form method="post" class="p-5" id="formContact">
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="firstName" class="form-label mb-3">Prénom</label>
                        <input type="text" class="form-control fs-5" id="firstName" name="firstName" >
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="lastName" class="form-label mb-3">Nom</label>
                        <input type="text" class="form-control fs-5" id="lastName" name="lastName">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="pseudo" class="form-label mb-3">Pseudo</label>
                        <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="mail" class="form-label mb-3">Email</label>
                        <input type="text" class="form-control fs-5" id="mail" name="mail" placeholder="exemple.email@exemple.com">
                    </div>      
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="message">Message</label>
                        <textarea type="text" class="form-control" id="message" name="message" rows="10"></textarea>
                    </div>
                </div>
                <div class="row p-5">
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-red">Me contacter</button>
                </div>
            </form>
        </div>
    </main>
<?php
    } else{
?>
    <main class="bg-red-2"> 
        <h1 class="text-center mb-5 p-2 w-25 m-auto bg-red title-style-h1">Contact</h1>
        <div class="w-75 m-auto form-contact-style">
            <form method="post" class="p-5" id="formContactBis">
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="firstNameBis" class="form-label mb-3">Prénom</label>
                        <input type="text" class="form-control fs-5" id="firstNameBis" name="firstNameBis" >
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="lastNameBis" class="form-label mb-3">Nom</label>
                        <input type="text" class="form-control fs-5" id="lastNameBis" name="lastNameBis">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                        <label for="mailBis" class="form-label mb-3">Email</label>
                        <input type="text" class="form-control fs-5" id="mailBis" name="mailBis" placeholder="exemple.email@exemple.com">
                    </div>      
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="messageBis">Message</label>
                        <textarea type="text" class="form-control" id="messageBis" name="messageBis" rows="10"></textarea>
                    </div>
                </div>
                <div class="row p-5">
                    <button class="w-50 m-auto btn btn-lg fs-5 btn-style btn-color-red">Me contacter</button>
                </div>
            </form>
        </div>
    </main>
<?php
    }

    require_once "inc/footer.inc.php";
?>