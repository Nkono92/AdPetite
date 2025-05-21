<?php $this->titre = "Informations détaillées de l'utilisateur"; ?>
<?php $this->layout = "Layout.php"; ?>

<?php //echo $racineWeb; ?>

<?php require 'Vues/Shared/Header.php'; ?>

<?php require 'Vues/Shared/MenuVertical.php'; ?>

<?php require 'Vues/Shared/OffSideBar.php'; ?>

<!-- Main section-->
<section class="section-container">
    <!-- Page content-->
    <div class="content-wrapper">

        <div class="content-heading">
            <div>Gestion des utilisateurs</div>
        </div>

        <!-- START row-->
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-default">
                    <div class="card-body text-center">
                        <div class="py-4"><img class="img-fluid rounded-circle img-thumbnail thumb128" src="<?= $this->nettoyer($Utilisateur->getPhotoProfil()) ?>" alt="Contact"></div>
                        <h3 class="m-0 text-bold"><?= $this->nettoyer($Utilisateur->getNom()) ?> <?= $this->nettoyer($Utilisateur->getPrenom()) ?></h3>
                        <div class="my-3">
                            <h4 class="m-0 text-bold text-danger"><?= $this->nettoyer($Utilisateur->getProfilUtilisateur()->getLibelle()) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-default">
                    <div class="card-header d-flex align-items-center">
                        <div class="d-flex justify-content-center col">
                            <div class="h4 m-0 text-center">Informations Personnelles</div>
                        </div>
                        <div class="d-flex justify-content-end">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row py-4 justify-content-center">
                            <div class="col-12 col-sm-10">
                                <form class="form-horizontal">
                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Nom</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getNom()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Prénom</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getPrenom()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Telephone</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getTelephone()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Email</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getEmail()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Date Inscription</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getDateInscription()->format('d/m/Y h:i:s')) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Rue</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getRue()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row"><label class="text-bold col-xl-3 col-md-3 col-4 col-form-label text-right" for="inputContact1">Boite Postale</label>
                                        <div class="col-xl-8 col-md-9 col-8">
                                            <input class="form-control" readonly id="inputContact1" value="<?= $this->nettoyer($Utilisateur->getBoitePostale()) ?>" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <?php if ($this->nettoyer($Utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur()) == ADMIN_PROFILE_CODE){ ?>
                                        <a class="btn btn-warning btn-square" title="Modifier" href="Utilisateur/Modifier/<?= $this->nettoyer($Utilisateur->getIdUtilisateur())?>" >
                                            <i class="fas fa-edit" aria-hidden="true"></i> Modifier
                                        </a>
                                        <a class="btn btn-danger btn-square" title="Supprimer" href="Utilisateur/Supprimer/<?= $this->nettoyer($Utilisateur->getIdUtilisateur())?>" >
                                            <i class="fas fa-trash" aria-hidden="true"></i> Supprimer
                                        </a>
                                    <?php } ?>
                                    <a class="btn btn-primary" href="Utilisateur/<?php echo $this->nettoyer($Utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur()) == ADMIN_PROFILE_CODE?"IndexAdmin":"Index"; ?>"> Retour à la page d'accueil </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>
