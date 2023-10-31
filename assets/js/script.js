// Fonction pour le loader du site //

let loader = document.querySelector(`#loader`);

window.addEventListener(`load`, function loadingScreen(){
    loader.classList.add(`hide-loader`);
    // Exécution des fonctions qui permettent de changer le background des images selon l'attribut "alt"
    backgroundHomeSize();
    backgroundProductsSize();
    backgroundProductSize();
})

// Les Fonctions pour appliquer un background spécifique à une image en fonction de son nom //

// Pour l'accueil // 

let imgHomeSize = document.querySelectorAll(`.random-img-accueil-size`);
let imgHomeSizeBis = document.querySelectorAll(`.random-img-accueil-bis-size`);

function backgroundHomeSize(){
    for (let i = 0; (i < imgHomeSize.length); i++){
        let imgHome = imgHomeSize[i].querySelector(`img`);

        if(imgHome.alt.includes(`red version`)){
            imgHomeSize[i].classList.add(`img-size-red-style`);
            imgHomeSizeBis[i].classList.add(`img-size-red-style`);
        }else if(imgHome.alt.includes(`blue version`)){
            imgHomeSize[i].classList.add(`img-size-blue-style`);
            imgHomeSizeBis[i].classList.add(`img-size-blue-style`);
        } else if(imgHome.alt.includes(`Blue Hada & Red Yro`)){
            imgHomeSize[i].classList.add(`img-size-blue-red-style-bis`);
        } else if(imgHome.alt.includes(`Blue Hada & Red Yro Armored`)){
            imgHomeSize[i].classList.add(`img-size-blue-red-style`);
        } else if(imgHome.alt.includes(`Red`)){
            imgHomeSize[i].classList.add(`img-size-red-style`);
        } else{
            imgHomeSize[i].classList.add(`img-size-blue-style`);
        }
    }
    for(let i = 0; (i < imgHomeSizeBis.length); i++){
        let imgHomeBis = imgHomeSizeBis[i].querySelector(`img`);

        if(imgHomeBis.alt.includes(`red version`)){
            imgHomeSizeBis[i].classList.add(`img-size-red-style`);
        } else if(imgHomeBis.alt.includes(`blue version`)){
            imgHomeSizeBis[i].classList.add(`img-size-blue-style`);
        }
    }
}

// Pour la page "all-products" //

let imgAllProductsSizes = document.querySelectorAll(`.img-all-products-size`);

function backgroundProductsSize(){
    for (let i = 0; i < imgAllProductsSizes.length; i++){
        let imgProductSize = imgAllProductsSizes[i].querySelector(`img`);

        if(imgProductSize.alt.includes(`red version`)){
            imgAllProductsSizes[i].classList.add(`img-size-red-style`);
        }else if(imgProductSize.alt.includes(`blue version`)){
            imgAllProductsSizes[i].classList.add(`img-size-blue-style`);
        } else if(imgProductSize.alt.includes(`Blue Hada & Red Yro`)){
            imgAllProductsSizes[i].classList.add(`img-size-blue-red-style-bis`);
        } else if(imgProductSize.alt.includes(`Blue Hada & Red Yro Armored`)){
            imgAllProductsSizes[i].classList.add(`img-size-blue-red-style`);
        } else if(imgProductSize.alt.includes(`Red`)){
            imgAllProductsSizes[i].classList.add(`img-size-red-style`);
        } else{
            imgAllProductsSizes[i].classList.add(`img-size-blue-style`);
        }
    }
}

// Pour la page "all-products" //

let imgProductSize = document.querySelector(`.img-product-size`);
let imgProduct = imgProductSize.querySelector(`img`);

function backgroundProductSize(){
    if(imgProduct.alt.includes(`red version`)){
        imgProductSize.classList.add(`img-size-red-style`);
    }else if(imgProduct.alt.includes(`blue version`)){
        imgProductSize.classList.add(`img-size-blue-style`);
    } else if(imgProduct.alt.includes(`Blue Hada & Red Yro`)){
        imgProductSize.classList.add(`img-size-blue-red-style-bis`);
    } else if(imgProduct.alt.includes(`Blue Hada & Red Yro Armored`)){
        imgProductSize.classList.add(`img-size-blue-red-style`);
    } else if(imgProduct.alt.includes(`Red`)){
        imgProductSize.classList.add(`img-size-red-style`);
    } else{
        imgProductSize.classList.add(`img-size-blue-style`);
    }
}

// Fonction pour montrer le "password" dans inscription //

let showPassword = document.querySelector(`#mdp`);
let showPasswordConfirm = document.querySelector(`#confirmMdp`);

function mdpInscription(){
    if(showPassword.type === `password` && showPasswordConfirm.type === `password`){
        showPassword.type = `text`;
        showPasswordConfirm.type = `text`;
    } else{
        showPassword.type = `password`;
        showPasswordConfirm.type = `password`;
    }
}

// Fonction pour montrer le "password" dans "log in" //

let showPasswordLog = document.querySelector(`#password`);

function showPasswordLogIn(){
    if(showPasswordLog.type === `password`){
        showPasswordLog.type = `text`;
    } else{
        showPasswordLog.type = `password`;
    }
}

// Fonction pour montrer le "password" dans "modification de compte" //

let showPasswordModify = document.querySelector(`#passwordModif`);
let showPasswordModifConfirm = document.querySelector(`#passwordModifConfirm`);

function showPasswordModif(){
    if(showPasswordModify.type === `password` && showPasswordModifConfirm.type === `password`){
        showPasswordModify.type = `text`;
        showPasswordModifConfirm.type = `text`;
    } else{
        showPasswordModify.type = `password`;
        showPasswordModifConfirm.type = `password`;
    }
}