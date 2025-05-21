<?php $this->titre = "AdPetite - Mes Favoris"; ?>

<?php $this->layout = "LayoutFront.php"; ?>


<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

</header>

<!-- END HEADER -->

<div class="page-header" style="background: url(Assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Mes Favoris</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li><a href="Annonce">Annonces /</a></li>
                        <li class="current">Mes Favoris</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content" class="section-padding">
    <div class="container" style="max-width: 1300px !important;">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
                <aside>
                    <div class="sidebar-box">
                        <div class="user">
                            <a href="#"><img style="width: 100% !important;" class="img-thumbnail" src="<?= $this->nettoyer($sessionClient->getPhotoProfil()) ?>" alt=""></a>
                            <div class="usercontent">
                                <h3 style="font-size: 12px !important;"><?= $this->nettoyer($sessionClient->getNom()).' '.$this->nettoyer($sessionClient->getPrenom()) ?></h3>
                            </div>
                        </div>
                        <nav class="navdashboard">
                            <ul>
                                <li>
                                    <a href="Accueil">
                                        <i class="lni-home"></i>
                                        <span>Accueil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Utilisateur/Profile">
                                        <i class="lni-user"></i>
                                        <span>Réglages du profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Annonce">
                                        <i class="lni-layers"></i>
                                        <span>Mes Annonces</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Paiement">
                                        <i class="lni-wallet"></i>
                                        <span>Mes Paiements</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="active" href="Annonce/Favoris">
                                        <i class="lni-heart"></i>
                                        <span>Mes favoris</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Utilisateur/Deconnecter">
                                        <i class="lni-enter"></i>
                                        <span>Se déconnecter</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="widget">
                        <h4 class="widget-title">Publicités</h4>
                        <div class="add-box">
                            <img class="img-fluid" src="Assets/img/img1.jpg" alt="">
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="page-content">
                    <div class="inner-box">
                        <div class="dashboard-box">
                            <h2 class="dashbord-title">Mes annonces favorites</h2>
                        </div>
                        <div class="dashboard-wrapper" >

                            <a class="mb-1 btn btn-primary" title="Nouveau" href="Annonce/Ajouter">
                                <i class="fas fa-plus"></i>&nbsp; Nouvelle annonce
                            </a>
                            <br><br>
                            <table class="table table-striped text-center" id="datatable3" style="text-align: center; width: 100% !important;" >
                                <thead>
                                <tr>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Photo</th>
                                    <th data-priority="1">Titre</th>
                                    <th>Catégorie</th>
                                    <th>Statut</th>
                                    <th>Prix</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($Favoris as $favoris): ?>
                                    <tr class="gradeX">
                                        <td class="photo">
                                            <a href="Annonce/Detailler/<?= $this->nettoyer($favoris->getAnnonce()->getIdAnnonce())?>">
                                                <img class="img-fluid" src="
                                            <?php
                                                foreach ($favoris->getAnnonce()->getLesPiecesJointes() as $pieceJointe)
                                                {
                                                    if ($pieceJointe->getTypePieceJointe()->getIdTypePieceJointe() == PIECE_JOINTE_PRINCIPALE)
                                                    {
                                                        echo $pieceJointe->getUrl().'"alt="'.$pieceJointe->getLibelle().'"';
                                                    }
                                                }?>">
                                            </a>
                                        </td>
                                        <td><?= $this->nettoyer($favoris->getAnnonce()->getTitre()) ?></td>
                                        <td><?= $this->nettoyer($favoris->getAnnonce()->getSousCategorie()->getLibelle()) ?></td>
                                        <?php if ($this->nettoyer($favoris->getAnnonce()->getStatut()) == 1) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatusactive">Active</span></td>
                                        <?php }elseif($this->nettoyer($favoris->getAnnonce()->getStatut()) == 0) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatusinactive">Inactive</span></td>
                                        <?php }elseif($this->nettoyer($favoris->getAnnonce()->getStatut()) == -1) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatussold">Bloquée</span></td>
                                        <?php }?>
                                        <td><?= $this->nettoyer($favoris->getAnnonce()->getPrix()) ?></td>

                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
