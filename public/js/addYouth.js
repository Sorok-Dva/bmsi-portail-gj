/**
 * Created by Llyam GARCIA on 24/03/2016.
 */

var sendForm = false;

function addPostalCode(town) {
    $.post(prefix+'/app/Ajax.php', {"action": "getPostalCode", "town": town}, function (data) {
        $('.birthplace_postal_code').val("" + data.code + "");
    }, 'json');
}

function addCounselor(antenna) {
    //Mise à jour de la liste des conseillers prescripteur
    $.post(prefix+'/app/Ajax.php', {"action": "getCounselorForYouth", "antenna": antenna}, function (data) {
        $('#cp').empty().append($('<option value="-">').text("Choisissez un conseiller prescripteur"));
        $('.phone_ML_referring_in_charge').val('');
        $.each(data.list, function (i, value) {
            $('#cp').append($('<option value="' + value + '">').text(value).attr('value', value));
        });
        $('#cp option[value="'+data.session+'"]').prop('selected', true);
        addCounselorPhone(data.session);
    }, 'json');
}

function addCounselorPhone(counselor) {
    $.post(prefix+'/app/Ajax.php', {"action": "getCounselorPhone", "counselor": counselor}, function (data) {
        $('.phone_ML_referring_in_charge').val("" + data.phone + "");
    }, 'json');
}

function getTown() {
    setTimeout(function(){
        $.post(prefix+'/app/Ajax.php', {"action": "getTown", "code": $('.postal_code').val()}, function (data) {
            $('select[name=town]').empty().append($('<option value="-">Choisissez une ville</option>'));
            $.each(data, function (i, value) {
                $('select[name=town]').append($('<option value="' + value + '">').text(value).attr('value', value));
            });
        }, 'json');
    }, 100 / 60);

}

//Step 1
function verifChecked() {
    setTimeout(function () {
        if ($('#FR').prop("checked") === true) {
            $("#FR-birthplace").show().find('input').val('').prop("disabled", false);
            $("#UE-birthplace").find('input').val('').prop("disabled", true);
            $("#AUTRE-birthplace").find('input').val('').prop("disabled", true);
            $("#otherBirthplaceInfo").hide().find('input').val('').prop("disabled", true);
        } else {
            $("#FR-birthplace").hide();

        }
        if ($('#UE').prop("checked") === true) {
            $("#UE-birthplace").show().find('input').val('').prop("disabled", false);
            $("#otherBirthplaceInfo").show().find('input').val('').prop("disabled", false);
            $("#FR-birthplace").find('input').val('').prop("disabled", true);
            $("#AUTRE-birthplace").find('input').val('').prop("disabled", true);
        } else {
            $("#UE-birthplace").hide();
        }
        if ($('#AUTRE').prop("checked") === true) {
            $("#AUTRE-birthplace").show().find('input').val('').prop("disabled", false);
            $("#otherBirthplaceInfo").show().find('input').val('').prop("disabled", false);
            $("#UE-birthplace").find('input').val('').prop("disabled", true);
            $("#FR-birthplace").find('input').val('').prop("disabled", true);
        } else {
            $("#AUTRE-birthplace").hide();
        }
    }, 100 / 60);
}

//Step 2
function verifChecked2() {
    setTimeout(function () {
        if ($('#register_yes').prop("checked") === true) {
            $("#Is_register_ML").show().find('input').prop("disabled", false);
        } else {
            $("#Is_register_ML").hide().find('input').val('').prop("disabled", true);
        }

        if ($('#youth_employment_no').prop("checked") === true) {
            $("#allowed_to_work").show().find('input').val('').prop("disabled", true);
        } else {
            $("#allowed_to_work").hide().find('input').val('').prop("disabled", true);
        }

        if ($('#ongoing_with_the_knowed_structure_yes').prop("checked") === true) {
            $("#ongoing_with_the_knowed_structure").show().find('select').val('').prop("disabled", false);
        } else {
            $("#ongoing_with_the_knowed_structure").hide().find('select').val('').prop("disabled", true);
        }

    }, 100 / 60);
}

function verifPublic(){
    setTimeout(function () {
        if ($('#student_training_yes').prop("checked") === true) {
            notif({
                msg: "<b>Information:</b> Statut du dossier passé à dérogatoire.",
                type: "info"
            });
        } else {

        }
    }, 100 / 60);
}


$(document).ready(function () {

    $(".datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        autoSize: true,
        changeYear: true,
        minDate: "-30y",
        maxDate: "-16y",
        dayNames: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        dayNamesShort: ["Dim", "Mar", "Mer", "Jeu", "Ven", "Sam", "Lun"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"]
    });

    $(".arrived_in_france").datepicker({
        dateFormat: "dd/mm/yy",
        autoSize: true,
        changeYear: true,
        minDate: "-30y",
        maxDate: "-14y",
        dayNames: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        dayNamesShort: ["Dim", "Mar", "Mer", "Jeu", "Ven", "Sam", "Lun"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"]
    });

    $(".end_residence_permit").datepicker({
        dateFormat: "dd/mm/yy",
        autoSize: true,
        changeYear: true,
        minDate: "-1y",
        maxDate: "+10y",
        dayNames: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        dayNamesShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"]
    });

    $(".register_ml_date").datepicker({
        dateFormat: "dd/mm/yy",
        autoSize: true,
        changeYear: true,
        minDate: "-10y",
        maxDate: "-1d",
        dayNames: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        dayNamesShort: ["Dim", "Mar", "Mer", "Jeu", "Ven", "Sam", "Lun"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"]
    });

    $('.postal_code').focusout(function () {
        getTown()
    });

    $.post(prefix+'/app/Ajax.php', {"action": "getAntennaForYouth"}, function (data) {
        $.each(data.list, function (i, value) {
            $('#srgj').append($('<option value="' + value + '">').text(value).attr('value', value));
        });

        $('#srgj option[value="'+data.session+'"]').prop('selected', true);
        addCounselor(data.session);

    }, 'json');

    $('.postal_code').autocomplete({
        source: prefix+'/app/Ajax.php?type=postal_code',
        dataType: 'json'
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>").data("item.autocomplete", item)
            .append("<span onclick='getTown()'>" + item.value + "</span>")
            .appendTo(ul);
    };

    $('.birthplace').autocomplete({
        source: prefix+'/app/Ajax.php?type=town',
        dataType: 'json'
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>").data("item.autocomplete", item)
            .append("<span onclick='addPostalCode(\"" + item.value + "\")'>" + item.value + "</span>")
            .appendTo(ul);
    };

    if($('postal_code').val() != ""){
        getTown();
        setTimeout(function () {
            var value = $('select[name=town]').attr('data-selected');
            $('select[name=town]').val(value);
        }, 1000 / 10);
    }

    $("select > option").each(function() {
        var value = $(this).parent('select').attr('data-selected');
        if($(this).attr('value') == value) {
            $(this).parent('select').val(value);
        }
    });

});