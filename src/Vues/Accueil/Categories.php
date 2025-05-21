<?php $this->titre = "AdPetite - Nos différentes catégories"; ?>

<?php $this->layout = "LayoutFront.php"; ?>


<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

    <?php require 'Vues/Shared/HeaderFrontBis.php'; ?>

</header>

<!-- END HEADER -->


<!-- Main section Start -->
<div class="main-container section-padding">
    <div class="container" style="max-width: 1400px !important;">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-xs-12 page-sidebar">
                <aside>

                    <!--<div class="widget_search">
                        <form role="search" id="search-form">
                            <input type="search" class="form-control" autocomplete="off" name="s" placeholder="Search..." id="search-input" value="">
                            <button type="submit" id="search-submit" class="search-btn"><i class="lni-search"></i></button>
                        </form>
                    </div>-->

                    <div class="widget categories">
                        <h4 class="widget-title">Les catégories</h4>
                        <ul class="categories-list">
                            <?php foreach ($SousCategories as $sousCategorie): ?>
                                <li>
                                    <a href="Accueil/Categories/<?= $this->nettoyer($sousCategorie->getIdSousCategorie()) ?>">
                                        <i class="<?= $this->nettoyer($sousCategorie->getFontIcone()) ?>"></i>
                                        <?= $this->nettoyer($sousCategorie->getLibelle()) ?>
                                        <span class="category-counter">(<?= count($sousCategorie->getLesAnnonces()) ?>) </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <div class="widget">
                        <h4 class="widget-title">Publicités</h4>
                        <div class="add-box">
                            <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-8 col-md-12 col-xs-12 page-content">

                <table class="table table-striped dashboardtable" id="datatable3" style="text-align: center; width: 100% !important;" >
                    <thead>
                    <tr >
                        <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    <div class="adds-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade">
                                <div class="row">
                                    <?php foreach ($Annonces as $Annonce): ?>
                                        <tr class="gradeX">
                                            <td class="photo" style="width: 100%">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="featured-box">
                                                        <figure  style="width: 40% !important;">
                                                            <div class="icon">
                                                                <?php if (isset($sessionClient)): ?>
                                                                    <a href="Annonce/Favoris/<?= $this->nettoyer($Annonce->getIdAnnonce()) ?>">
                                                                        <i class="lni-heart"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                            <a href="Annonce/Detailler/<?= $this->nettoyer($Annonce->getIdAnnonce()) ?>">
                                                                <img class="img-fluid" src="
                                                                <?php
                                                                foreach ($Annonce->getLesPiecesJointes() as $pieceJointe)
                                                                {
                                                                    if ($pieceJointe->getTypePieceJointe()->getIdTypePieceJointe() == PIECE_JOINTE_PRINCIPALE)
                                                                    {
                                                                        echo $pieceJointe->getUrl().'"alt="'.$pieceJointe->getLibelle().'"';
                                                                    }
                                                                }
                                                                ?>">
                                                            </a>
                                                        </figure>
                                                        <div class="feature-content" style="width: 60% !important;">
                                                            <div class="product">
                                                                <a href="javascript:void(0)"><i class="lni-folder"></i> <?= $this->nettoyer($Annonce->getSousCategorie()->getLibelle()) ?></a>
                                                            </div>
                                                            <h4>
                                                                <a href="Annonce/Detailler/<?= $this->nettoyer($Annonce->getIdAnnonce()) ?>">
                                                                    <?= $this->nettoyer($Annonce->getTitre()) ?>
                                                                </a>
                                                            </h4>
                                                            <span>Dernière mise à jour : <?= $this->nettoyer($Annonce->getDateCreation()->format('d/m/Y')) ?> à <?= $this->nettoyer($Annonce->getDateCreation()->format('H:i:s')) ?> </span>
                                                            <ul class="address">
                                                                <li>
                                                                    <a href="javascript:void(0)"><i class="lni-map-marker"></i><?= $this->nettoyer($Annonce->getVille()->getLibelle()) ?></a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)"><i class="lni-alarm-clock"></i> <?= $this->nettoyer($Annonce->getDateCreation()->format('d/m/Y')) ?></a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)"><i class="lni-user"></i>
                                                                        <?= $this->nettoyer($Annonce->getUtilisateur()->getPrenom()) ?> <?= $this->nettoyer($Annonce->getUtilisateur()->getNom()) ?>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)"><i class="lni-package"></i> <?= $this->nettoyer($Annonce->getTypeAnnonce()->getLibelle()) ?> </a>
                                                                </li>
                                                            </ul>
                                                            <div class="listing-bottom">
                                                                <h3 class="price float-left"><?= $this->nettoyer($Annonce->getPrix()) ?> XAF</h3>
                                                                <?php if ($this->nettoyer($Annonce->getStatut()) == STATUT_VALIDE) :?>
                                                                    <a href="javascript:void(0)" class="btn-verified float-right"><i class="lni-check-box"></i> Annonce vérifiée</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- Main section End -->
