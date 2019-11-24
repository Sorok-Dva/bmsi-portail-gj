<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 13/04/2016
 * @Time    : 15:27
 * @File    : generate.php
 * @Version : 1.0
 * @LastUpdate  : 13/04/2016 à 15:27
 */

require ROOT.'/core/html2pdf/vendor/autoload.php';
ob_start();
?>
<style>
    @media (min-width: 768px)
        .form-horizontal .control-label {
            text-align: right;
            margin-bottom: 0;
            padding-top: 7px;
        }
        @media (min-width: 992px)
            .col-md-4 {
                width: 33.33333333%;
            }
            @media (min-width: 992px)
                .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
                    float: left;
                }
                .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
                    /* position: relative; */
                    min-height: 1px;
                    padding-left: 15px;
                    padding-right: 15px;
                }
                label {
                    display: inline-block;
                    max-width: 100%;
                    margin-bottom: 5px;
                    font-weight: bold;
                }
                * {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                }

                .form-control {
                    display: block;
                    width: 100%;
                    height: 34px;
                    padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    color: #555555;
                    background-color: #ffffff;
                    background-image: none;
                    border: 1px solid #cccccc;
                    border-radius: 4px;
                    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                }
                .draggableField > input, select, button, .checkboxgroup, .selectmultiple, .radiogroup {
                    margin-top: 10px;
                    margin-right: 10px;
                    margin-bottom: 10px;
                }
                input, button, select, textarea {
                    font-family: inherit;
                    font-size: inherit;
                    line-height: inherit;
                }
                button, select {
                    text-transform: none;
                }
                button, input, optgroup, select, textarea {
                    color: inherit;
                    font: inherit;
                    margin: 0;
                }

                @media (min-width: 992px)
                    .col-md-4 {
                        width: 33.33333333%;
                    }
                    @media (min-width: 992px)
                        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
                            float: left;
                        }
                        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
                            /* position: relative; */
                            min-height: 1px;
                            padding-left: 15px;
                            padding-right: 15px;
                        }
</style>
<?= $form->formConstruct("part_1"); ?>
<hr><hr>
<?= $form->formConstruct("part_2"); ?>
    <hr><hr>
<?= $form->formConstruct("part_3"); ?>
<?php

$pdf = ob_get_clean();

try{
    $html2pdf = new HTML2PDF("P", "A4", "fr");
//    $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont("Arial");
    $html2pdf->writeHTML($pdf);
    $html2pdf->Output(date("d-m-y", $youth->commission_date)."_{$youth->commission_lieu}_GJ_".strtoupper($youth->lastName)."_{$youth->name}.pdf");
}catch(HTML2PDF_exception $e){
    die($e);
}

?>