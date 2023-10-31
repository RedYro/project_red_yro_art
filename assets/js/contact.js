// Fonction pour faire les vérifications du formulaire de contact //

// Pour quand un utilisateur à un compte

document.addEventListener(`DOMContentLoaded`,function(){ // L'évènement DOMContentLoaded est déclenché quand le document HTML est complètement chargé et analysé, sans attendre la fin du chargement des feuilles de styles, images et sous-document 
    let firstName = document.querySelector(`#firstName`);
    let lastName = document.querySelector(`#lastName`);
    let pseudo = document.querySelector(`#pseudo`);
    let mail = document.querySelector(`#mail`);
    let message = document.querySelector(`#message`);
    let formContact = document.querySelector(`#formContact`);
    
    function formVerifConnected(){
        let firstNameValue = firstName.value.trim();
        let lastNameValue = lastName.value.trim();
        let pseudoValue = pseudo.value.trim();
        let mailValue = mail.value.trim();
        let messageValue = message.value.trim();
        // Pour vérifier si les champs du formulaire ne sont pas vides
        if(firstNameValue == `` || lastNameValue == `` || pseudoValue == `` || mailValue == `` || messageValue == ``){
            alert(`Les informations sont incorrectes !`);
            return;
        }
    
        // Pour vérifier si le mail est correct
        let mailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!mailRegex.test(mailValue)){
            alert(`Le mail est incorrect`);
            return;
        }
    
        alert(`Envoi du formulaire effectué !`);
    }
    
    formContact.addEventListener(`submit`, formVerifConnected);
})


// Pour quand un utilisateur n'a pas de compte

document.addEventListener(`DOMContentLoaded`,function(){
    let firstNameBis = document.querySelector(`#firstNameBis`);
    let lastNameBis = document.querySelector(`#lastNameBis`);
    let mailBis = document.querySelector(`#mailBis`);
    let messageBis = document.querySelector(`#messageBis`);
    let formContactBis = document.querySelector(`#formContactBis`);
    
    function formVerifDisconnected(){
        let firstNameValueBis = firstNameBis.value.trim();
        let lastNameValueBis = lastNameBis.value.trim();
        let mailValueBis = mailBis.value.trim();
        let messageValueBis = messageBis.value.trim();
        // Pour vérifier si les champs du formulaire ne sont pas vides
        if(firstNameValueBis == `` || lastNameValueBis == `` || mailValueBis == `` || messageValueBis == ``){
            alert(`Les informations sont incorrectes !`);
            return;
        }
    
        // Pour vérifier si le mail est correct
        let mailRegexBis = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!mailRegexBis.test(mailValueBis)){
            alert(`Le mail est incorrect`);
            return;
        }
    
        alert(`Envoi du formulaire effectué !`);
    }

    formContactBis.addEventListener(`submit`, formVerifDisconnected);
})
