<?php $this->titre = "Nouvel interval"; ?>

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
            <div>Gestion de la tarification des images</div>
        </div>

        <!-- START row-->
        <div class="row">
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="TarifImage/Ajouter" method="post">
                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title"><h3>Formulaire de création</h3></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Libelle">Libelle <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Libelle" type="text" placeholder="Veuillez entrer le libelle" tabindex="1" name="Libelle" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="BorneInf">Borne Inférieure <span class="text-danger">*</span> </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="BorneInf" type="text" placeholder="Veuillez entrer la borne inférieure" tabindex="2" name="BorneInf" required data-parsley-type="integer">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="BorneSup">Borne Supérieure <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" id="BorneSup" required tabindex="3" placeholder="Veuillez entrer la borne supérieure" name="BorneSup" data-parsley-type="integer">
                                </div>

                                <label class="col-sm-2 col-form-label" for="Montant">Montant <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" id="Montant" required tabindex="4" placeholder="Veuillez entrer le montant" name="Montant" data-parsley-type="number">
                                </div>
                            </div>

                            <div class="required text-danger"><span class="text-danger">*</span> Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Valider</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="TarifImage"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

</div>
</section>