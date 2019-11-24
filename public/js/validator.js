$(document).ready(function(){

    $("a[data-original-title='Valider ce dossier']").click(function(){
        var motif = $('.motif').val();
        var date = $('.datepicker').val();
        var lieu = $( ".lieu option:selected" ).text();
        if(confirm("Voulez vous envoyer ce dossier en commission?")){
            if(motif === ""){
                $('.motif').css('border', '2px solid red');
            } else {
                $.post('../../app/Ajax.php', {
                    "action": "validateFolder",
                    "p": "V",
                    "id": id,
                    "r": referant,
                    "j": jeune,
                    "j_id": jeune_id,
                    'motif': motif,
                    "date": date,
                    "lieu": lieu
                }, function (data) {
                    if (data != "error") {
                        notif({
                            msg: "<b>Information:</b> Statut du dossier mise à jour (Validé).",
                            type: "info"
                        });
                        $(".state").empty().append("validé");
                    } else {
                        alert('Une erreur est survenue');
                    }
                }, 'json');
            }
        }
    });

    $("a[data-original-title='Mettre en attente']").click(function(){
        var motif = $('.motif').val();
        var date = $('.datepicker').val();
        var lieu = $( ".lieu option:selected" ).text();
        if(confirm("Voulez vous mettre ce dossier en attente et le renvoyer au conseiller precripteur? (manque d'information)")){
            if(motif === ""){
                $('.motif').css('border', '2px solid red');
            } else {
                $.post('../../app/Ajax.php', {
                    "action": "validateFolder",
                    "p": "P",
                    "id": id,
                    "r": referant,
                    "j": jeune,
                    "j_id": jeune_id,
                    'motif': motif,
                    "date": date,
                    "lieu": lieu
                }, function (data) {
                    if(data != "error"){
                        notif({
                            msg: "<b>Information:</b> Statut du dossier mise à jour (En attente).",
                            type: "info"
                        });
                        $(".state").empty().append("en attente");
                        $('.motif').css('border', '1px solid black');
                    } else {
                        alert('Une erreur est survenue');
                    }
                }, 'json');
            }

        }
    });

    $("a[data-original-title='Refuser ce dossier']").click(function(){
        var motif = $('.motif').val();
        var date = $('.datepicker').val();
        var lieu = $( ".lieu option:selected" ).text();
        if(confirm("Voulez vous fermer ce dossier? (ne correspond pas aux critères de la GJ)")) {
            if(motif === ""){
                $('.motif').css('border', '2px solid red');
            } else {
                $.post('../../app/Ajax.php', {
                    "action": "validateFolder",
                    "p": "R",
                    "id": id,
                    "r": referant,
                    "j": jeune,
                    "j_id": jeune_id,
                    'motif': motif,
                    "date": date,
                    "lieu": lieu
                }, function (data) {
                    if (data != "error") {
                        notif({
                            msg: "<b>Information:</b> Statut du dossier mise à jour (Refusé).",
                            type: "info"
                        });
                        $('.motif').css('border', '1px solid black');
                        $(".state").empty().append("refusé");
                    } else {
                        alert('Une erreur est survenue');
                    }
                }, 'json');
            }
        }
    });
});


