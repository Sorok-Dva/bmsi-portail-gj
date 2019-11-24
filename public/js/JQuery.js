/**
 *    @Author Created by Llyam Garcia (Liightman) on 22/03/2016.
 *    @File JQuery.js
 *    @version 1.0
 */

(function ( $ ) {
    $.fn.feedback = function(success, fail) {
        self=$(this);
        self.find('.dropdown-menu-form').on('click', function(e){e.stopPropagation()})

        self.find('.screenshot').on('click', function(){
            self.find('.cam').removeClass('fa-camera fa-check').addClass('fa-refresh fa-spin');
            html2canvas($(document.body), {
                onrendered: function(canvas) {
                    self.find('.screen-uri').val(canvas.toDataURL("image/png"));
                    self.find('.cam').removeClass('fa-refresh fa-spin').addClass('fa-check');
                }
            });
        });

        self.find('.do-close').on('click', function(){
            self.find('.dropdown-toggle').dropdown('toggle');
            self.find('.reported, .failed').hide();
            self.find('.report').show();
            self.find('.cam').removeClass('fa-check').addClass('fa-camera');
            self.find('.screen-uri').val('');
            self.find('textarea').val('');
        });

        failed = function(){
            self.find('.loading').hide();
            self.find('.failed').show();
            if(fail) fail();
        }

        self.find('form').on('submit', function(){
            self.find('.report').hide();
            self.find('.loading').show();
            $.post( $(this).attr('action'), $(this).serialize(), null, 'json').done(function(res){
                if(res.result == 'success'){
                    self.find('.loading').hide();
                    self.find('.reported').show();
                    if(success) success();
                } else failed();
            }).fail(function(){
                failed();
            });
            return false;
        });
    };
}( jQuery ));


function getFolder(){
    $.post('../../app/Ajax.php', {"action": "getNumRowFolders"}, function (data) {
        $('.rowFolders').empty().append(data.num);
    }, 'json');
}

function deleteAlert(id){
    if(confirm("Voulez-vous marquer cette alerte comme lue ?\n Elle ne sera plus affichée sur cette page.")){
        $.post('../../app/Ajax.php', {"action": "readAlert", "id": id}, function (data) {
            if(data.done != "error"){
                if(data.done != "errorUpdate"){
                    $('#alert-'+id).fadeOut(500).parent().remove();
                } else {
                    alert('Une erreur est survenue lors de la mise à jour de votre alerte');
                }
            } else {
                alert('Cette alerte ne vous appartient pas! Vous ne pouvez donc pas la supprimer');
            }
        }, 'json');
    }
} 

$(document).ready(function(){
    getFolder();
    $('.feedback').feedback();

    $("button[type=submit]").click(function() {
        var $btn = $(this);
        $btn.button('loading');
        setTimeout(function() {
            $btn.button('reset');
        }, 10000);
    });
});