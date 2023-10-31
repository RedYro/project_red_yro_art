<?php
    $contentDescription = "Red Yro's Art Services";
    $title = "Services";

    require_once("inc/functions.inc.php");
    require_once("inc/header.inc.php");

    if(isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role'] == 'ADMIN'){
?>
<main class="container-fluid bg-blue-2">
    <h1 class="text-center mb-5 p-2 m-auto bg-blue title-style-h1">Services</h1>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-blue title-style-h2 title-size-1">Services : Illustration</h2>
            <p class="paragraphe-style paragraphe-color-blue w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-blue title-style-h2 title-size-1">Services : Logo</h2>
            <p class="paragraphe-style paragraphe-color-blue w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-blue title-style-h2 title-size-1">Services : Illustration</h2>
            <p class="paragraphe-style paragraphe-color-blue w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row p-5">
        <a href="<?=RACINE_SITE?>/contact.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-blue btn-size-2">Me contacter</a>
    </div>
</main>
<?php
    } else{
?>
<main class="container-fluid bg-red-2">
    <h1 class="text-center mb-5 p-2 m-auto bg-red title-style-h1">Services</h1>
    <div class="row p-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-red title-style-h2 title-size-1">Services : Illustration</h2>
            <p class="paragraphe-style paragraphe-color-red w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-red title-style-h2 title-size-1">Services : Logo</h2>
            <p class="paragraphe-style paragraphe-color-red w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-5">
            <h2 class="text-center fs-3 mb-5 p-2 bg-red title-style-h2 title-size-1">Services : Illustration</h2>
            <p class="paragraphe-style paragraphe-color-red w-75">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias voluptatibus eius voluptas consequuntur nesciunt doloremque perspiciatis blanditiis accusantium quae saepe iste aspernatur ratione enim, pariatur reiciendis quos reprehenderit iusto doloribus?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem iste soluta totam reiciendis odio, fuga ex labore pariatur, officia praesentium earum, nesciunt debitis veniam laboriosam. Ratione suscipit magnam repellendus nostrum.
            </p>
        </div>
    </div>
    <div class="row p-5">
        <a href="<?=RACINE_SITE?>/contact.php" class="m-auto btn btn-lg fs-3 btn-style btn-color-red btn-size-2">Me contacter</a>
    </div>
</main>
<?php
    }

    require_once "inc/footer.inc.php";
?>