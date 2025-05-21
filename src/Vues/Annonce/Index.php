<?php $this->titre = "AdPetite - Mes Annonces"; ?>

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
                    <h2 class="product-title">Mes annonces</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Mes annonces</li>
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
                                    <a class="active" href="Annonce">
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
                                    <a href="Annonce/Favoris">
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
                            <h2 class="dashbord-title">Mes annonces</h2>
                        </div>
                        <div class="dashboard-wrapper" >
                            <!--<nav class="nav-table">
                                <ul>
                                    <li class="active"><a href="#">All Ads (42)</a></li>
                                    <li><a href="#">Published (88)</a></li>
                                    <li><a href="#">Featured (12)</a></li>
                                    <li><a href="#">Sold (02)</a></li>
                                    <li><a href="#">Active (42)</a></li>
                                    <li><a href="#">Expired (01)</a></li>
                                </ul>
                            </nav>-->

                            <a class="mb-1 btn btn-primary" title="Nouveau" href="Annonce/Ajouter">
                                <i class="fas fa-plus"></i>&nbsp; Nouvelle annonce
                            </a>
                            <br><br>
                            <table class="table table-striped my-4 w-100 table-responsive dashboardtable" id="datatable3" style="text-align: center" >
                                <thead>
                                <tr>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Photo</th>
                                    <th data-priority="1">Titre</th>
                                    <th>Catégorie</th>
                                    <th>Statut</th>
                                    <th>Prix</th>
                                    <th>Action(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($Annonces as $Annonce): ?>
                                    <tr class="gradeX">
                                        <td class="photo">
                                            <img class="img-fluid" src="
                                            <?php
                                            foreach ($Annonce->getLesPiecesJointes() as $pieceJointe)
                                            {
                                                if ($pieceJointe->getTypePieceJointe()->getIdTypePieceJointe() == PIECE_JOINTE_PRINCIPALE)
                                                {
                                                    echo $pieceJointe->getUrl().'"alt="'.$pieceJointe->getLibelle().'"';
                                                }
                                            }?>">
                                        </td>
                                        <td><?= $this->nettoyer($Annonce->getTitre()) ?></td>
                                        <td><?= $this->nettoyer($Annonce->getSousCategorie()->getLibelle()) ?></td>
                                        <?php if ($this->nettoyer($Annonce->getStatut()) == 1) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatusactive">Active</span></td>
                                        <?php }elseif($this->nettoyer($Annonce->getStatut()) == 0) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatusinactive">Inactive</span></td>
                                        <?php }elseif($this->nettoyer($Annonce->getStatut()) == -1) {?>
                                            <td data-title="Ad Status"><span class="adstatus adstatussold">Bloquée</span></td>
                                        <?php }?>
                                        <td><?= $this->nettoyer($Annonce->getPrix()) ?></td>
                                        <td>
                                            <div class="btns-actions">
                                                <a class="btn-action btn-edit" title="Modifier" href="Annonce/Modifier/<?= $this->nettoyer($Annonce->getIdAnnonce())?>">
                                                    <i class="lni-pencil"></i>
                                                </a>
                                                <a class="btn-action btn-view" title="Informations supllémentaires" href="Annonce/Detailler/<?= $this->nettoyer($Annonce->getIdAnnonce())?>">
                                                    <i class="lni-eye"></i>
                                                </a>
                                                <a class="btn-action btn-delete" title="Supprimer" href="Annonce/Supprimer/<?= $this->nettoyer($Annonce->getIdAnnonce())?>">
                                                    <i class="lni-trash"></i>
                                                </a>
                                            </div>

                                        </td>
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
