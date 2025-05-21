<?php $this->titre = "PrimoAnnonce - Informations détaillées sur l'annonce"; ?>

<?php $this->layout = "LayoutFront.php"; ?>


<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

</header>

<!-- END HEADER -->




<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Informations détaillées</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li><a href="Annonce">Annonces /</a></li>
                        <li class="current">Informations détaillées</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section-padding" id="DetailleDetailAnnonce">
    <div class="container" style="max-width: 1300px !important;">

        <div class="product-info row">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="details-box ads-details-wrapper">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <?php foreach ($Annonce->getLesPiecesJointes() as $piecesJointe): ?>

                            <div class="item">
                                <div class="product-img">
                                    <img class="img-fluid" src="<?= $this->nettoyer($piecesJointe->getUrl()) ?>" alt="">
                                </div>
                                <span class="price"><?= $this->nettoyer($Annonce->getPrix()) ?> XAF</span>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="details-box">
                    <div class="ads-details-info">
                        <h2><?= $this->nettoyer($Annonce->getTitre()) ?></h2>
                        <p class="mb-2"><?= $this->nettoyer($Annonce->getDescription()) ?></p>
                        <div class="details-meta">
                            <span>
                                    <i class="lni-alarm-clock"></i>Date Publication: <?= $this->nettoyer($Annonce->getDateCreation()->format('d/m/Y H:i:s')) ?>
                            </span><br>
                            <span>
                                    <i class="lni-map-marker"></i>Lieu d'exécution: <?= $this->nettoyer($Annonce->getVille()->getLibelle()) ?>
                            </span>
                            <!--<span><a href="javascript:void(0)"><i class="lni-eye"></i> 299 View</a></span>-->
                        </div>
                        <h4 class="title-small mb-3">Spécifications:</h4>
                        <i class="lni-check-mark-circle"></i> Téléphone: <?= $this->nettoyer($Annonce->getTelephone()) ?> <br>
                        <i class="lni-check-mark-circle"></i> Prix: <?= $this->nettoyer($Annonce->getPrix()) ?> XAF <br>
                        <i class="lni-check-mark-circle"></i> Lien YouTube: <a href="<?= $this->nettoyer($Annonce->getLienYoutube()) ?>" target="_blank">
                            <?= $this->nettoyer($Annonce->getLienYoutube()) ?>
                        </a> <br>
                        <i class="lni-check-mark-circle"></i> Lien Vimeo: <a href="<?= $this->nettoyer($Annonce->getLienVimeo()) ?>" target="_blank">
                            <?= $this->nettoyer($Annonce->getLienVimeo()) ?>
                        </a> <br><br>
                    </div>
                    <ul class="advertisement mb-4">
                        <li>
                            <p style="text-transform: uppercase;"><strong><i class="lni-archive"></i> Type d'annonce:</strong>
                                <?= $this->nettoyer($Annonce->getTypeAnnonce()->getLibelle()) ?>
                            </p>
                        </li>
                        <li>
                            <p style="text-transform: uppercase;"><strong><i class="lni-folder"></i> Catégorie:</strong>
                               <?= $this->nettoyer($Annonce->getSousCategorie()->getLibelle()) ?>
                            </p>
                        </li>
                    </ul>
                    <div class="ads-btn mb-4">
                        <a href="mailto:<?= $this->nettoyer($Annonce->getUtilisateur()->getEmail())?>" class="btn btn-common btn-reply"><i class="lni-envelope"></i> Email</a>
                        <a href="tel:<?= $this->nettoyer($Annonce->getTelephone()) ?>" class="btn btn-common"><i class="lni-phone-handset"></i> Appeler</a>
                        <?php if (isset($sessionClient) && $this->nettoyer($Annonce->getStatut()) == STATUT_NON_VALIDE): ?>
                                <a class="btn btn-success" style="border-radius: 50px; border-top-left-radius: 50px; border-top-right-radius: 50px;
                border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;" title="Modifier" href="Paiement/index/<?= $this->nettoyer($Annonce->getIdAnnonce())?>">
                                    <i class="fa fa-dollar-sign "></i> Certifier l'annonce
                                </a>
                        <?php endif; ?>
                    </div>
                    <div class="share">
                        <span>Partager: </span>
                        <div class="social-link">
                            <a class="facebook" href="javascript:void(0)"><i class="lni-facebook-filled"></i></a>
                            <a class="twitter" href="javascript:void(0)"><i class="lni-twitter-filled"></i></a>
                            <a class="linkedin" href="javascript:void(0)"><i class="lni-linkedin-fill"></i></a>
                            <a class="google" href="javascript:void(0)"><i class="lni-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="description-info">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="description">
                        <h4>Autres informations</h4>
                        <p><?= $this->nettoyer($Annonce->getAutre()) ?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="short-info">
                        <h4>Raccourcis</h4>
                        <ul>
                            <li><a href="Annonce/LiseAnnonce/<?= $this->nettoyer($Annonce->getUtilisateur()->getIdUtilisateur());?>">
                                    <i class="lni-users"></i> Plus d'annonces de
                                    <span><?= $this->nettoyer($Annonce->getUtilisateur()->getPrenom());?> <?= $this->nettoyer($Annonce->getUtilisateur()->getNom());?>
                                    </span></a></li>
                            <li><a href="javascript:void(0)" onclick="PrintDiv('DetailleDetailAnnonce')"><i class="lni-printer"></i> Imprimer cette annonce</a></li>
                            <!--<li><a href="javascript:void(0)"><i class="lni-reply"></i> Send to a friend</a></li>
                            <li><a href="javascript:void(0)"><i class="lni-warning"></i> Report this ad</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($sessionClient)): ?>
            <?php if ($sessionClient->getIdUtilisateur() == $this->nettoyer($Annonce->getUtilisateur()->getIdUtilisateur()) ): ?>
                <a class="btn btn-warning" style="border-radius: 50px; border-top-left-radius: 50px; border-top-right-radius: 50px;
                border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;" title="Modifier" href="Annonce/Modifier/<?= $this->nettoyer($Annonce->getIdAnnonce())?>">
                    <i class="lni-pencil "></i> Modifier
                </a>
            <?php endif; ?>
        <?php endif; ?>



    </div>
</div>

