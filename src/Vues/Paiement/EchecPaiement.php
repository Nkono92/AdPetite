<?php $this->titre = "PrimoAnnonce - Echec Paiement"; ?>

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
                    <h2 class="product-title">Echec paiement</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Echec paiement</li>
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
                                    <a href="offermessages.html">
                                        <i class="lni-envelope"></i>
                                        <span>Offers/Messages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Paiement">
                                        <i class="lni-wallet"></i>
                                        <span>Mes Payements</span>
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
            <div class="col-sm-12 col-md-4 col-lg-2"></div>
            <div class="col-sm-12 col-md-4 col-lg-5">
                <!-- Main section Start -->
                <!-- Page content-->
                    <img class="" src="Content/img/bgEchec.png" alt="Image">
                <!-- Main section End -->
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2"></div>

        </div>
    </div>
</div>
