<?php $this->titre = "PrimoAnnonce - Erreur"; ?>

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
                    <h2 class="product-title">Erreur</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Erreur</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="error section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="error-content">
                    <div class="error-message">
                        <h2>ERREUR</h2>
                        <h3><span>Ooooops!</span> <?= $this->nettoyer($message) ?></h3>
                    </div>
                    <!--<form class="form-error-search">
                        <input type="search" name="search" class="form-control" placeholder="Search Here">
                        <button class="btn btn-common btn-search" type="button">Search Now</button>
                    </form>-->
                    <div class="description">
                        <span><a href="Accueil">Retourner à la page d'acceuil</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
