<?php $this->titre = "PrimoAnnonce - Réglages du profil"; ?>

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
                    <h2 class="product-title">Réglages du profil</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Réglages du profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="content" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
                <aside>
                    <div class="sidebar-box">
                        <div class="user">
                                <a href="#"><img style="width: 100% !important;" class="img-thumbnail" src="<?= $this->nettoyer($Utilisateur->getPhotoProfil()) ?>" alt=""></a>
                            <div class="usercontent">
                                <h3 style="font-size: 12px !important;"><?= $this->nettoyer($Utilisateur->getNom()).' '.$this->nettoyer($Utilisateur->getPrenom()) ?></h3>
                                <!--<h4><?/*= $this->nettoyer($Utilisateur->getProfilUtilisateur()->getLibelle()) */?></h4>-->
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
                                    <a class="active" href="Utilisateur/Profile">
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
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="row page-content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="inner-box">
                            <div class="tg-contactdetail">
                                <div class="dashboard-box">
                                    <h2 class="dashbord-title">Mes informations</h2>
                                </div>
                                <div class="dashboard-wrapper">
                                    <form method="post" data-parsley-validate="" action="Utilisateur/Profile" method="post" enctype="multipart/form-data">
                                        <input  type="hidden" name="IdUtilisateur" value="<?= $this->nettoyer($Utilisateur->getIdUtilisateur()) ?>" required>
                                        <input  type="hidden" name="Statut" value="<?= $this->nettoyer($Utilisateur->getStatut()) ?>" required>
                                        <input  type="hidden" name="DateInscription" value="<?= $this->nettoyer($Utilisateur->getDateInscription()->format('Y-m-d H:i:s')) ?>" required>
                                        <input  type="hidden" name="AncienEmail" value="<?= $this->nettoyer($Utilisateur->getEmail()) ?>" required>
                                        <input  type="hidden" name="IdProfilUtilisateur" value="<?= $this->nettoyer($Utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur()) ?>" required>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for ="Nom">Nom *</label>
                                            <input class="form-control input-md" value="<?= $this->nettoyer($Utilisateur->getNom()) ?>"
                                                   placeholder="Veuillez entrer le nom" required name="Nom" type="text">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Prenom">Prenom*</label>
                                            <input class="form-control input-md" value="<?= $this->nettoyer($Utilisateur->getPrenom()) ?>"
                                                   placeholder="Veuillez entrer le prénom" required name="Prenom"  type="text">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Telephone">Telephone*</label>
                                            <input class="form-control" data-masked="" data-inputmask="'mask': '(+237) 999-999-999'" im-insert="true"
                                                   placeholder="Veuillez entrer le numéro de téléphone" value="<?= $this->nettoyer($Utilisateur->getTelephone()) ?>"
                                                   name="Telephone" type="text"  required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Email">Email*</label>
                                            <input class="form-control" placeholder="Veuillez entrer l'email" value="<?= $this->nettoyer($Utilisateur->getEmail()) ?>"
                                                   name="Email" type="email" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="MotDePasse">Mot de passe*</label>
                                            <input class="form-control" placeholder="Veuillez entrer le mot de passe" name="MotDePasse" type="password" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="MotDePasseConfirmation">Confirmation mot de passe*</label>
                                            <input class="form-control" placeholder="Veuillez confirmer le mot de passe" name="MotDePasseConfirmation" type="password" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Rue">Rue</label>
                                            <input class="form-control input-md" value="<?= $this->nettoyer($Utilisateur->getRue()) ?>"
                                                   placeholder="Veuillez entrer la rue" required name="Rue"  type="text">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="BoitePostale">Boite Postale</label>
                                            <input class="form-control input-md" value="<?= $this->nettoyer($Utilisateur->getBoitePostale()) ?>"
                                                   placeholder="Veuillez entrer la boite postale" required name="BoitePostale"  type="text">
                                        </div>
                                        <label class="tg-fileuploadlabel" for="tg-photogallery">
                                            <span>Déposer le fichier</span>
                                            <span>Ou</span>
                                            <span class="btn btn-common">Sélectionnez le fichier</span>
                                            <span>Taille maximale du fichier: 1 MB</span>
                                            <input id="tg-photogallery" class="tg-fileinput" type="file" name="PhotoProfil">
                                        </label>

                                        <button class="btn btn-common" type="submit">Modifier</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
