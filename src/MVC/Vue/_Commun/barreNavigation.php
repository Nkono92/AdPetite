<!-- Barre de navigation en haut de la page -->
<div class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Partie de la barre toujours affichée -->
    <div class="navbar-header">
        <!-- Bouton affiché à droite si la zone d'affichage est trop petite -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Activer la navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Lien de retour à la page d'accueil -->
        <a class="navbar-brand" href=""><span class="glyphicon glyphicon-headphones"></span> PHP Music Store</a>
    </div>
    <!-- Partie de la barre masquée en fonction de la zone d'affichage -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($client)): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Bienvenue, <?= $this->nettoyer($client['prenom']) ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="client/">Informations personnelles</a></li>
                        <li class="divider"></li>
                        <li><a href="connexion/deconnecter">Se déconnecter</a></li>
                    </ul>
                </li>
                <li>
                    <!--button type="button" class="btn btn-default btn-primary navbar-btn"-->
                    <a href="panier/">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Panier <span class="badge"><?= $this->nettoyer($nbArticlesPanier) ?></span>
                    </a>
                    <!--/button-->
                </li>
            <?php else: ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Non connecté <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="connexion/">S'identifier</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>