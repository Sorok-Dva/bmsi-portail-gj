<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 04/04/2016
 * @Time    : 09:59
 * @File    : formBuilder.php
 * @Version : 1.0
 * @LastUpdate  : 04/04/2016 à 09:59
 */
?>
<style id="content-styles">
    /* Styles that are also copied for Preview */
    body {
        margin: 10px 0 0 10px;
    }
    .control-label {
        display: inline-block !important;
        padding-top: 5px;
        vertical-align: baseline;
        padding-right: 10px;
    }
    .droppedField {
        padding-left:5px;
    }
    .action-bar .droppedField {
        float: left;
        padding-left:5px;
    }
</style>

<script>

    function generate(){
        var ajaxJSON = [];

        $('#DNDForm').find(':input').each(function(index, element){
            var input;
            if($(element).attr("type") != "hidden"){
                var part = "part_"+$(element).parent('div').parent('div').attr("data-part");
                console.log(part);
                var required = $(element).parent('div').children('input[type=hidden]').attr('value');
                if(required === undefined){
                    required = false;
                }
                var label = $(element).parent('div').children('label').text();

                if($(element).get(0).tagName.toLowerCase() == "select"){
                    var select = [];

                    $(element).find('option').each(function(i, e){

                        var options = {'value':$(this).attr('value'), 'name':$(e).text()};
                        select.push(options);

                    });

                    input = [part,['elements',{
                        'type': $(element).attr('type'),
                        'label': label,
                        'name':  $(element).attr('name'),
                        'required': required,
                        'options': {
                            'values': select
                        }
                    }]];

                }

                if($(element).get(0).tagName.toLowerCase() == "input"){

                    input = [part,['elements',{
                        'type':$(element).attr('type'),
                        'label': label,
                        'name': $(element).attr('name'),
                        'required': required,
                        'placeholder': $(element).attr('placeholder')
                    }]];
                }

                ajaxJSON.push(input);
                console.log(input)
            }


        });
        console.log(JSON.stringify(ajaxJSON));


//        console.log(ajaxJSON);
    }

    function makeCustomizable(){
        $("[id^='CTRL-']").on('click', function(index){
            var me = $(this);
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
        });
    }

    /* Make the control draggable */
    function makeDraggable() {
        $(".selectorField").draggable({ helper: "clone",stack: "div",cursor: "move", cancel: null  });
    }

    function docReady() {
        console.log("[============= The form builder is ready... =============]");
        var reg  =   /([0-9]+)/;

        reg.exec($(".droppedField").last().attr("id"));

        var _ctrl_index = RegExp.$1;

        console.log(" --> Index ctrl is defined at "+ _ctrl_index);
        _ctrl_index++;

        makeCustomizable();

        compileTemplates();

        makeDraggable();

        $( ".droppedFields" ).droppable({
            activeClass: "activeDroppable",
            hoverClass: "hoverDroppable",
            accept: ":not(.ui-sortable-helper)",
            drop: function( event, ui ) {
                console.log("   [-- Dragged element "+_ctrl_index+"  --]");
                var draggable = ui.draggable;
                draggable = $(ui.draggable).find(".modele").clone();
                // draggable = draggable.clone();
                draggable.removeClass("modele");
                draggable.removeClass("selectorField");
                draggable.addClass("droppedField");
                draggable[0].id = "CTRL-DIV-"+(_ctrl_index++); // Attach an ID to the rendered control
                draggable.appendTo(this);

                /* Once dropped, attach the customization handler to the control */
                draggable.click(function () {
                    // The following assumes that dropped fields will have a ctrl-defined.
                    //   If not required, code needs to handle exceptions here.
                    var me = $(this);
                    var ctrl = me.find("[class*=ctrl]")[0];
                    var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
                    customize_ctrl(ctrl_type, this.id);
                    //window["customize_"+ctrl_type](this.id);
                });
                makeDraggable();
            }
        });

        /* Make the droppedFields sortable and connected with other droppedFields containers*/
        $( ".droppedFields" ).sortable({
            cancel: null, // Cancel the default events on the controls
            connectWith: ".droppedFields"
        }).disableSelection();

    }
    /*
     Preview the customized form
     -- Opens a new window and renders html content there.
     */
    function preview() {
        console.log('    [/!\\ Preview Called /!\\] ');

        var selected_content = $("#selected-content").clone();
        selected_content.find("div").each(function(i,o) {
            var obj = $(o);
            obj.removeClass("draggableField ui-draggable well ui-droppable ui-sortable");
        });

        generate();
    }

    if(typeof(console)=='undefined' || console==null) { console={}; console.log=function(){}}

    /* Delete the control from the form */
    function delete_ctrl() {
        if(window.confirm("Êtes-vous certain ?")) {
            var ctrl_id = $("#theForm").find("[name=forCtrl]").val()
            console.log("        -------[__A FIELD WAS REMOVED ("+ctrl_id+")__]------- ");
            $("#"+ctrl_id).remove();
        }
    }

    /* Compile the templates for use */
    function compileTemplates() {
        window.templates = {};
        window.templates.common = Handlebars.compile($("#control-customize-template").html());

        /* HTML Templates required for specific implementations mentioned below */

        // Mostly we donot need so many templates
        window.templates.textbox = Handlebars.compile($("#textbox-template").html());
        window.templates.passwordbox = Handlebars.compile($("#textbox-template").html());
        window.templates.combobox = Handlebars.compile($("#combobox-template").html());
        window.templates.selectmultiplelist = Handlebars.compile($("#combobox-template").html());
        window.templates.radiogroup = Handlebars.compile($("#combobox-template").html());
        window.templates.checkboxgroup = Handlebars.compile($("#combobox-template").html());
        window.templates.text = Handlebars.compile($("#text-template").html());
        window.templates.date = Handlebars.compile($("#date-template").html());
    }

    // Object containing specific "Save Changes" method
    save_changes = {};

    // Object comaining specific "Load Values" method.
    load_values = {};

    /* Common method for all controls with Label and Name */
    load_values.common = function(ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#"+ctrl_id);
        // Gestion du champs obligatoire
        var listeHiddenObligatoire = div_ctrl.find(".hiddenObligatoire");
        if (listeHiddenObligatoire != null && listeHiddenObligatoire.length > 0) {
            var ctrlObligatoire = listeHiddenObligatoire[0];
            form.find("[name=obligatoire]").attr('checked', ctrlObligatoire.value == "true");
            form.find("#pObligatoire").show();
        }
        else {
            form.find("#pObligatoire").hide();
        }
        // Gestion du chargement champs spécifiques
        form.find("[name=label]").val(div_ctrl.find('.control-label').text())
        var specific_load_method = load_values[ctrl_type];
        if(typeof(specific_load_method)!='undefined') {
            specific_load_method(ctrl_type, ctrl_id);
        }
    };

    /* Specific method to load values from a textbox control to the customization dialog */
    load_values.textbox = function(ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#" + ctrl_id);
        var ctrlText = div_ctrl.find("input[type=text]")[0];
        form.find("[name=name]").val(ctrlText.name);
        form.find("[name=placeholder]").val(ctrlText.placeholder);
    };

    // Passwordbox uses the same functionality as textbox - so just point to that
    load_values.passwordbox = load_values.textbox;

    /* Specific method to load values from a combobox control to the customization dialog  */
    load_values.combobox = function(ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#"+ctrl_id);
        var ctrl = div_ctrl.find("select")[0];
        form.find("[name=name]").val(ctrl.name)
        var options= '';
        $(ctrl).find('option').each(function(i,o) { options+=o.text+'\n'; });
        form.find("[name=options]").val($.trim(options));
    };
    // Multi-select combobox has same customization features
    load_values.selectmultiplelist = load_values.combobox;

    /* Specific method to load values from a radio group */
    load_values.radiogroup = function(ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#"+ctrl_id);
        var options= '';
        var ctrls = div_ctrl.find("div").find("span");
        var radios = div_ctrl.find("div").find("input");

        ctrls.each(function(i,o) { options+=$(o).text()+'\n'; });
        form.find("[name=name]").val(radios[0].name)
        form.find("[name=options]").val($.trim(options));
    };

    // Checkbox group  customization behaves same as radio group
    load_values.checkboxgroup = load_values.radiogroup;

    /* Specific method to load values from a button */
    load_values.btn = function(ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#"+ctrl_id);
        var ctrl = div_ctrl.find("button")[0];
        form.find("[name=name]").val(ctrl.name)
        form.find("[name=label]").val($(ctrl).text().trim())
    };
    /* Specific method to load values from a text to the customization dialog */
    load_values.text = function (ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#" + ctrl_id);
        var ctrlText = div_ctrl.find(".ctrl-text");
        form.find("[name=texte]").val(ctrlText.text());
    };
    /* Specific method to load values from a date to the customization dialog */
    load_values.date = function (ctrl_type, ctrl_id) {
        var form = $("#theForm");
        var div_ctrl = $("#" + ctrl_id);
        var ctrlText = div_ctrl.find(".ctrl-date");
        form.find("[name=dateformat]").val(ctrlText.text());
    };

    /* Common method to save changes to a control  - This also calls the specific methods */
    save_changes.common = function(values) {
        var div_ctrl = $("#"+values.forCtrl);
        div_ctrl.find('.control-label').text(values.label);
        // Gestion du champs obligatoire
        var listeHiddenObligatoire = div_ctrl.find(".hiddenObligatoire");
        if (listeHiddenObligatoire != null && listeHiddenObligatoire.length > 0) {
            var ctrlObligatoire = listeHiddenObligatoire[0];
            ctrlObligatoire.value = values.obligatoire;
        }
        var specific_save_method = save_changes[values.type];
        if(typeof(specific_save_method)!='undefined') {
            specific_save_method(values);
        }
    };

    /* Specific method to save changes to a text box */
    save_changes.textbox = function(values) {
        var div_ctrl = $("#"+values.forCtrl);
        var ctrlText = div_ctrl.find("input[type=text]")[0];
        // var ctrl = div_ctrl.find("input")[0];
        ctrlText.placeholder = values.placeholder;
        ctrlText.name = values.name;
        // console.log(values.obligatoire);
    };
    // Password box customization behaves same as textbox
    save_changes.passwordbox= save_changes.textbox;
    /* Specific method to save changes to a combobox */
    save_changes.combobox = function(values) {
        console.log(values);
        var div_ctrl = $("#"+values.forCtrl);
        var ctrl = div_ctrl.find("select")[0];
        ctrl.name = values.name;
        $(ctrl).empty();
        $(values.options.split('\n')).each(function(i,o) {
            $(ctrl).append("<option>"+$.trim(o)+"</option>");
        });
    };

    /* Specific method to save a radiogroup */
    save_changes.radiogroup = function(values) {
        var div_ctrl = $("#"+values.forCtrl);

        var label_template = $(".selectorField .ctrl-radiogroup span")[0];
        var radio_template = $(".selectorField .ctrl-radiogroup input")[0];
        var ctrl = div_ctrl.find(".ctrl-radiogroup");
        ctrl.empty();
        $(values.options.split('\n')).each(function(i,o) {
            var label = $(label_template).clone().text($.trim(o))
            var radio = $(radio_template).clone();
            radio[0].name = values.name;
            label.prepend(radio);
            $(ctrl).append(label);
        });
    };

    /* Same as radio group, but separated for simplicity */
    save_changes.checkboxgroup = function(values) {
        var div_ctrl = $("#"+values.forCtrl);

        var label_template = $(".selectorField .ctrl-checkboxgroup span")[0];
        var checkbox_template = $(".selectorField .ctrl-checkboxgroup input")[0];

        var ctrl = div_ctrl.find(".ctrl-checkboxgroup");
        ctrl.empty();
        $(values.options.split('\n')).each(function(i,o) {
            var label = $(label_template).clone().text($.trim(o))
            var checkbox = $(checkbox_template).clone();
            checkbox[0].name = values.name;
            label.prepend(checkbox);
            $(ctrl).append(label);
        });
    };

    // Multi-select customization behaves same as combobox
    save_changes.selectmultiplelist = save_changes.combobox;

    /* Specific method for Button */
    save_changes.btn = function(values) {
        var div_ctrl = $("#"+values.forCtrl);
        var ctrl = div_ctrl.find("button")[0];
        $(ctrl).html($(ctrl).html().replace($(ctrl).text()," "+$.trim(values.label)));
        ctrl.name = values.name;
        //console.log(values);
    };

    /* Specific method to save changes to a text box */
    save_changes.text = function (values) {
        save_changes_simple_text(values, ".ctrl-text", values.texte)
    };
    /* Specific method to save changes to a text box */
    save_changes.date = function (values) {
        save_changes_simple_text(values, ".ctrl-date", values.dateformat)
    };
    function save_changes_simple_text(values, ctrl, value) {
        var div_ctrl = $("#" + values.forCtrl);
        var ctrlText = div_ctrl.find(ctrl);
        ctrlText.text(value);
    }
    /* Save the changes due to customization
     - This method collects the values and passes it to the save_changes.methods
     */
    function save_customize_changes(e, obj) {
        //console.log('save clicked', arguments);
        var formValues = {};
        var val=null;
        $("#theForm").find("input, textarea, select").each(function(i,o) {
            if(o.type=="checkbox"){
                val = o.checked;
            }
            else {
                val = o.value;
            }
            formValues[o.name] = val;
        });
        save_changes.common(formValues);
    }

    /*
     Opens the customization window for this
     */
    function customize_ctrl(ctrl_type, ctrl_id) {
        console.log("    [# Call Customization Window for : "+ctrl_type+" #] ");
        var ctrl_params = {};
        /* Load the specific templates */
        var specific_template = templates[ctrl_type];
        if(typeof(specific_template)=='undefined') {
            specific_template = function(){return ''; };
        }
        var modal_header = $("#"+ctrl_id).find('.control-label').text();

        var template_params = {
            header:modal_header,
            content: specific_template(ctrl_params),
            type: ctrl_type,
            forCtrl: ctrl_id,
            displayNom: ctrl_type == 'text' || ctrl_type == 'date' ? 'none' : 'block'
        };

        // Pass the parameters - along with the specific template content to the Base template
        var s = templates.common(template_params) + "";
        $("[name=customization_modal]").remove(); // Making sure that we just have one instance of the modal opened and not leaking
        $('<div id="customization_modal" name="customization_modal"  class="modal fade" role="dialog" />').append(s).modal('show');

        setTimeout(function() {
            // For some error in the code  modal show event is not firing - applying a manual delay before load
            load_values.common(ctrl_type, ctrl_id);
        },300);
    }
    function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateTips("Length of " + n + " must be between " +
                min + " and " + max + ".");
            return false;
        } else {
            return true;
        }
    }
    function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
            o.addClass("ui-state-error");
            updateTips(n);
            return false;
        } else {
            return true;
        }
    }
</script>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="col-md-4">
            <div class='selectorField draggableField'>
                <div class="textbox well well-mini"><b></b> Texte Simple</div>
                <div class='modele'>
                    <label class="control-label">Texte</label>
                    <input type="text" placeholder="Placeholder" class="ctrl-textbox"/>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="password well well-mini"><b></b> Mot de passe</div>
                <div class='modele'>
                    <label class="control-label">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe ..." class="ctrl-passwordbox"/>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="combobox well well-mini"><b></b> Liste d&eacute;roulante</div>
                <div class='modele'>
                    <label class="control-label">Liste d&eacute;roulante</label>
                    <select class="ctrl-combobox">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="radiogroup well well-mini"><b></b> Liste de choix</div>
                <div class='modele'>
                    <label class="control-label" style="vertical-align:top">Liste de choix</label>
                    <div style="display:inline-block;" class="ctrl-radiogroup">
                        <span style="display:block;"><input type="radio" name="radioField" value="option1"/>Option 1</span>
                        <span style="display:block;"><input type="radio" name="radioField" value="option2"/>Option 2</span>
                        <span style="display:block;"><input type="radio" name="radioField" value="option3"/>Option 3</span>
                    </div>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="checkboxgroup well well-mini"><b></b> Choix multiple</div>
                <div class='modele'>
                    <label class="control-label" style="vertical-align:top">Choix multiple</label>
                    <div style="display:inline-block;" class="ctrl-checkboxgroup">
                        <span style="display:block;"><input type="checkbox" name="checkboxField" value="option1"/>Option 1</span>
                        <span style="display:block;"><input type="checkbox" name="checkboxField" value="option2"/>Option 2</span>
                        <span style="display:block;"><input type="checkbox" name="checkboxField" value="option3"/>Option 3</span>
                    </div>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="selectmultiple well well-mini"><b></b> Selection multiple</div>
                <div class='modele'>
                    <label class="control-label" style="vertical-align:top">Selection multiple</label>
                    <div style="display:inline-block;">
                        <select multiple="multiple" style="width:150px" class="ctrl-selectmultiplelist">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                    </div>
                    <input type="hidden" class="hiddenObligatoire"/>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="displaydate well well-mini"><b></b> Date</div>
                <div class='modele'>
                    <label class="control-label">Date</label>
                    <span class="ctrl-date">{DD/MM/YYYY}</span>
                </div>
            </div>
            <div class='selectorField draggableField'>
                <div class="displaytext well well-mini"><b></b> Texte</div>
                <div class='modele'>
                    <label class="control-label">Texte</label>
                    <span class="ctrl-text">{Texte}</span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="col-md-12" id="selected-content">
                <form id="DNDForm">
                    <div class="row-fluid">
                        <h3>Informations du jeune</h3>
                        <div class="well droppedFields" data-part="1">
                            <?php $part = 1; include 'baseForm.php'; ?>
                        </div>
                        <hr>
                    </div>

                    <div class="row-fluid">
                        <h3>Situation et parcours du jeune</h3>
                        <div class="well droppedFields" data-part="2"></div>
                        <hr>
                    </div>
                    <div class="row-fluid">
                        <h3>Situation de précarité et autres</h3>
                        <div class="well droppedFields" data-part="3"></div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<!-- Preview button -->
<div class="row-fluid">
    <div class="span12">
        <input type="button" class="btn btn-primary" value="Preview" onclick="preview();"/>
    </div>
</div>

<script type="text/javascript" src="<?= App::env("SITE_URL") ?>public/js/handlebars.js"></script>

<script id="control-customize-template" type="text/x-handlebars-template">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{header}}</h4>
            </div>
            <div class="modal-body">
                <form id="theForm" class="form-horizontal">

                    <input type="hidden" value="{{type}}" name="type"/>
                    <input type="hidden" value="{{forCtrl}}" name="forCtrl"/>

                    <div class="form-group" id="pLibelle">
                        <label class="col-md-4 control-label" for="handlebars-textbox-label">Libell&eacute;</label>
                        <div class="col-md-4"><input type="text" class="form-control input-md" name="label" value="" id="handlebars-textbox-label"/></div>
                    </div>

                    <div class="form-group" style="display:{{displayNom}}">
                        <label class="col-md-4 control-label" for="handlebars-textbox-name">Nom</label>
                        <div class="col-md-4"><input type="text" class="form-control input-md" value="" name="name" id="handlebars-textbox-name"/></div>
                    </div>

                    <div class="form-group" id="pObligatoire">
                        <label class="col-md-4 control-label" for="checkbox-obligatoire-textbox">Obligatoire</label>
                        <div class="col-md-4"><input type="checkbox" class="form-control" name="obligatoire" value="" id="checkbox-obligatoire-textbox"/></div>
                    </div>

                    {{{content}}}
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
                <button class="btn btn-primary" data-dismiss="modal" onclick='save_customize_changes()'>Sauvegarder</button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick='delete_ctrl()'>Supprimer</button>
            </div>
        </div>

    </div>
</script>

<script id="textbox-template" type="text/x-handlebars-template">
    <div class="form-group">
        <label class="col-md-4 control-label">Placeholder</label>
        <div class="col-md-4"><input type="text" class="form-control input-md" name="placeholder" value=""/></div>
    </div>
</script>

<script id="combobox-template" type="text/x-handlebars-template">
    <p><label class="control-label">Options</label> <textarea name="options" rows="5"></textarea></p>
</script>

<script id="text-template" type="text/x-handlebars-template">
    <p><label class="control-label" for="handlebars-textbox-text">Texte</label> <textarea name="texte" rows="10" id="handlebars-textbox-text"></textarea></p>
</script>

<script id="date-template" type="text/x-handlebars-template">
    <p>
        <label class="control-label" for="handlebars-textbox-formatdate" style="padding-top:16px;">Format</label>
        <select name="dateformat" id="handlebars-textbox-formatdate">
            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
            <option value="DD/MM/YYYY hh:mm:ss">DD/MM/YYYY hh:mm:ss</option>
        </select>
    </p>
</script>

<script>
    $(document).ready(docReady);
</script>