<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 22/03/2016
 * @Time    : 10:08
 * @File    : navbar.php
 * @Version : 1.0
 * @LastUpdate  : 22/03/2016 à 10:08
 */

if (!empty($_SESSION)): ?>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li><a href="/">Accueil</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Espace Conseiller<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/youth/add">Créer un dossier</a></li>
                    <li><a href="/youth/quickadd">Créer un dossier (Importation depuis I-milo)</a></li>
                    <li><hr></li>
                    <li><a href="/youth/myfolders">Les dossiers dont je suis en charge</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Espace Validateur<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/validator/index">Valider des dossiers  <span class="badge badge-important rowFolders"></span></a> </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Espace Commission<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/commission/index">Liste des dossiers</a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Espace Administrateur<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/formbuilder">Gérer le formulaire</a></li>
                    <li><a href="/users/add">Ajouter des conseillers</a></li>
                    <li><a href="/bug/index">Rapport de problème</a></li>
                </ul>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Mon compte <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/users/manage">Modifier mes informations</a></li>
                    <li><a href="/users/logout">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
<?php endif; ?>