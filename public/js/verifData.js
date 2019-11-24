/**
 * Created by Llyam GARCIA on 29/03/2016.
 */

// USERS ADD

//YOUTH ADD
var identityAvailable = false;
var phoneAvailable = false;
var mailAvailable = false;

function verifYouthIdentity() {
    var name = $('.verifDataName').val();
    var lastName = $('.verifDataLName').val();
    var identity = name + " " + lastName;

    if ($(".errorIdentity").length === 0) {
        $('.verifDataLName').parent('div').after('<div class="col-md-4 alert-danger errorIdentity"></div>');
    }

    $.post('../app/Ajax.php', {"action": "verifDataYouth", "row": "identity", "value": identity}, function (data) {
        if (data.result === "error") {
            $('.verifDataName').css({"border": "2px solid red", "color": "red"});
            $('.verifDataLName').css({"border": "2px solid red", "color": "red"});
            $('.errorIdentity').append('Un jeune possède déjà cette identité. Veuillez verifier si son dossier a déjà été créer').show();
            identityAvailable = false;
        } else {
            $('.verifDataName').css({"border": "2px solid green", "color": "black"});
            $('.verifDataLName').css({"border": "2px solid green", "color": "black"});
            $('.errorIdentity').empty().hide();
            identityAvailable = true;
        }
    }, 'json');
}

function verifYouthPhone() {
    var phone = $('.verifPhone').val();

    if ($(".errorPhone").length === 0) {
        $('.verifPhone').parent('div').after('<div class="col-md-4 alert-danger errorPhone"></div>');
    }

    if ($('.verifPhone').val().length != 10) {
        $('.verifPhone').css({"border": "2px solid red", "color": "red"});
        $('.errorPhone').empty().append('Le numéro saisi n\'est pas au bon format. Le numéro doit comporter 10 nombres').show();
        phoneAvailable = false;
    } else {
        $.post('../app/Ajax.php', {"action": "verifDataYouth", "row": "phone_number", "value": phone}, function (data) {
            if (data.result === "error") {
                $('.verifPhone').css({"border": "2px solid red", "color": "orange"});
                $('.errorPhone').empty().append('Ce numéro de téléphone est déjà utilisé par un autre jeune. Veuillez revérifier cette information.').show();
                phoneAvailable = true;
            } else {
                $('.verifPhone').css({"border": "2px solid green", "color": "black"});
                $('.errorPhone').empty().hide();
                phoneAvailable = true;
            }
        }, 'json');
    }
}

function verifYouthMail() {
    var mail = $('.verifMail').val();
    var regMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if ($(".errorMail").length === 0) {
        $('.verifMail').parent('div').after('<div class="col-md-4 alert-danger errorMail"></div>');
    }

    if (!regMail.test(mail)) {
        $('.verifMail').css({"border": "2px solid red", "color": "red"});
        $('.errorMail').empty().append('L\'adresse e-mail saisie n\'est pas au bon format. Voici un exemple : adresse@domaine.fr').show();
        mailAvailable = false;
    } else {
        $.post('../app/Ajax.php', {"action": "verifDataYouth", "row": "mail", "value": mail}, function (data) {
            if (data.result === "error") {
                $('.verifMail').css({"border": "2px solid red", "color": "red"});
                $('.errorMail').append('Cette adresse e-mail est déjà assignée à un autre jeune. Veuillez revérifier cette information.').show();
            } else {
                $('.verifMail').css({"border": "2px solid green", "color": "black"});
                $('.errorMail').empty().hide();
            }
        }, 'json');
    }
}

$(document).ready(function () {
    $(".verifDataName").keyup(function () {
        verifYouthIdentity()
    });
    $(".verifPhone").keyup(function () {
        verifYouthPhone()
    });
    $(".verifMail").keyup(function () {
        verifYouthMail()
    });
});