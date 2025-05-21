<?php $this->titre = "Modifier le profil utilisateur"; ?>

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
            <div>Gestion des profils utilisateur</div>
        </div>


        <!-- START row-->
        <div class="row">
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="ProfilUtilisateur/Modifier" method="post">
                    <input  type="hidden" name="IdProfilUtilisateur" value="<?= $this->nettoyer($ProfilUtilisateur->getIdProfilUtilisateur()) ?>" required>

                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title"><h3>Formulaire de modification</h3></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Libelle">Libelle <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="Libelle" type="text" placeholder="Veuillez entrer le libelle" tabindex="1" value="<?= $this->nettoyer($ProfilUtilisateur->getLibelle()) ?>" name="Libelle" required>
                                </div>
                            </div>
                            <div class="required text-danger">* Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning" type="submit">Modifier</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="ProfilUtilisateur"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>