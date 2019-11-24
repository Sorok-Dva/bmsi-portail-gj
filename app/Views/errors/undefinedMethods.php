<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 29/03/2016
 * @Time    : 16:46
 * @File    : undefinedMethods.php
 * @Version : 1.0
 * @LastUpdate  : 29/03/2016 à 16:46
 */
$page = explode('/', substr($_SERVER['QUERY_STRING'], 1));
?>
<h1>Oops! On ne peut pas vous afficher cette page!</h1>
<p>Nous n'avons pas trouvé la page demandée! Erreur <span class="error">404, page non trouvée</span>.<br><br>
    <small>Si vous pensez qu'il s'agit d'une erreur, signalez nous le problème en cliquant sur l'icone en bas à gauche, puis spécifiez : <span class="error">Undefined Method - La méthode { <i><?= $page[1] ?></i> } de la classe { <i><?= $page[0] ?></i> } n'existe pas</span></small><br><br>
</p>
