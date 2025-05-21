<!-- sidebar-->
<aside class="aside-container">
    <!-- START Sidebar (left)-->
    <div class="aside-inner">
        <nav class="sidebar" data-sidebar-anyclick-close="">
            <!-- START sidebar nav-->
            <ul class="sidebar-nav">
                <!-- START user info-->
                <li class="has-user-block">
                    <div class="collapse" id="user-block">
                        <div class="item user-block">
                            <!-- User picture-->
                            <div class="user-block-picture">
                                <div class="user-block-status"><img class="img-thumbnail rounded-circle" src="Content/user/02.jpg" alt="Avatar" width="60" height="60">
                                    <div class="circle bg-success circle-lg"></div>
                                </div>
                            </div><!-- Name and Job-->
                            <div class="user-block-info"><span class="user-block-name">Hello, Mike</span><span class="user-block-role">Designer</span></div>
                        </div>
                    </div>
                </li><!-- END user info-->
                <!-- Iterates over all sidebar items-->
                <li class="nav-heading "><span data-localize="sidebar.heading.HEADER">Main Navigation</span></li>
                <li class=" "><a href="#Parametres" title="Paramètres" data-toggle="collapse">
                        <em class="icon-settings"></em><span data-localize="sidebar.nav.DASHBOARD">Paramètres</span>
                    </a>
                    <ul class="sidebar-nav sidebar-subnav collapse" id="Parametres">
                        <li class="sidebar-subnav-header">Paramètres</li>

                        <li class=" "><a href="#Categorisation" title="Catégorisation" data-toggle="collapse"><span>Catégorisation</span></a>
                            <ul class="sidebar-nav sidebar-subnav collapse" id="Categorisation">
                                <li class=" "><a href="Categorie" title="Catégories d'annonces"><span>Catégories d'annonces</span></a></li>
                                <li class=" "><a href="SousCategorie" title="Sous catégories"><span>Sous catégories</span></a></li>
                            </ul>
                        </li>

                        <li class=" "><a href="#Localisation" title="Localisation" data-toggle="collapse"><span>Localisation</span></a>
                            <ul class="sidebar-nav sidebar-subnav collapse" id="Localisation">
                                <li class=" "><a href="Departement" title="Département"><span>Département</span></a></li>
                                <li class=" "><a href="Pays" title="Level1 Item"><span>Pays</span></a></li>
                                <li class=" "><a href="Ville" title="Ville"><span>Ville</span></a></li>
                            </ul>
                        </li>

                        <li class=" "><a href="#GrilleTarifaire" title="Grille tarifaire" data-toggle="collapse"><span>Grille tarifaire</span></a>
                            <ul class="sidebar-nav sidebar-subnav collapse" id="GrilleTarifaire">
                                <li class=" "><a href="TarifImage" title="Tarification des images"><span>Tarifs sur image</span></a></li>
                                <li class=" "><a href="TarifTexte" title="Tarification des textes"><span>Tarifs sur texte</span></a></li>
                            </ul>
                        </li>

                        <li class=" "><a href="ModePaiement" title="Modes de paiement"><span>Modes de paiement</span></a></li>
                        <!-- <li class=" "><a href="Pays" title="Pays"><span>Pays</span></a></li> -->
                        <li class=" "><a href="ProfilUtilisateur" title="Profils utilisateur"><span>Profils utilisateur</span></a></li>
                        <li class=" "><a href="TypeAnnonce" title="Type d'annonces"><span>Type d'annonces</span></a></li>
                        <li class=" "><a href="TypePieceJointe" title="Type de pièces jointes"><span>Type de pièces jointes</span></a></li>

                        <li class=" "><a href="#ComptesUtilisateurs" title="Comptes utilisateurs" data-toggle="collapse"><span>Comptes utilisateurs</span></a>
                            <ul class="sidebar-nav sidebar-subnav collapse" id="ComptesUtilisateurs">
                                <li class=" "><a href="Utilisateur/IndexAdmin" title="Liste des admins"><span>Liste des admins</span></a></li>
                                <li class=" "><a href="Utilisateur/Index" title="Liste des clients"><span>Liste des clients</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-heading "><span data-localize="sidebar.heading.COMPONENTS">Annonces</span></li>
                <li class=" ">
                    <a href="#elements" title="Elements" data-toggle="collapse">
                        <em class="fa fa-bullhorn"></em>
                        <span data-localize="sidebar.nav.element.ELEMENTS">Gestion des annonces</span>
                    </a>
                    <ul class="sidebar-nav sidebar-subnav collapse" id="elements">
                        <li class="sidebar-subnav-header">Gestion des annonces</li>
                        <li class=" "><a href="Annonce/ListeAnnonces" title="Buttons"><span data-localize="sidebar.nav.element.BUTTON">Liste des annonces</span></a></li>
                    </ul>
                </li>

            </ul><!-- END sidebar nav-->
        </nav>
    </div><!-- END Sidebar (left)-->
</aside>
