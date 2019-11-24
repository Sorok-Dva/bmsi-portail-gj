<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 24/13/2016
 * @Time    : 16:33
 * @File    : result.php
 * @Version : 1.0
 */

//Affichage des erreurs : foreach + switch
?>
<div class="container">
    <div class="row">
        <section>
            <div class="wizard">

                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="complete">
                        <fieldset>
                            <legend>Résultat de la saisie du formulaire</legend>
                            <?php

                            foreach ($errors as $error):
                                switch ($error):
                                    case "NONE":
                                        $alert = "info";
                                        $message = "Le formulaire est correct et a bien été envoyé sur le serveur. Vous pouvez le compléter en vous rendant <a href='/youth/manage/$user_id'>ici</a>";
                                        break;
                                    
                                endswitch; ?>
                                <div class="alert alert-<?= $alert ?>"><?= $message ?></div>
                            <?php endforeach;
                            ?>
                        </fieldset>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
    </div>
</div>
