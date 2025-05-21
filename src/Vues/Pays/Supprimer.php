<?php $this->titre = "Supprimer un pays"; ?>

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
            <div>Gestion des pays</div>
        </div>


        <!-- START row-->
        <div class="row">
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="Pays/Supprimer" method="post">
                    <input  type="hidden" name="IdPays" value="<?= $this->nettoyer($Pays->getIdPays()) ?>" required>

                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title text-danger text-bold"><h3>Voulez-vous vraiment supprimer cet élément?</h3></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Libelle">Libelle <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Libelle" type="text" placeholder="Veuillez entrer le libelle" tabindex="1" value="<?= $this->nettoyer($Pays->getLibelle()) ?>" name="Libelle" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="CodePays">Code <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="CodePays" type="text" placeholder="Veuillez entrer le code" tabindex="2" value="<?= $this->nettoyer($Pays->getCodePays()) ?>" name="CodePays" required>
                                </div>

                            </div>
                            <div class="required text-danger">* Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="Pays"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>
