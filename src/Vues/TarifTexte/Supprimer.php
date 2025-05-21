<?php $this->titre = "Supprimer la tarification"; ?>

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
            <div>Gestion de la tarification du texte</div>
        </div>


        <!-- START row-->
        <div class="row">
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="TarifTexte/Supprimer" method="post">
                    <input  type="hidden" name="IdTarifTexte" value="<?= $this->nettoyer($TarifTexte->getIdTarifTexte()) ?>" required>

                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title text-danger text-bold"><h3>Voulez-vous vraiment supprimer cet élément?</h3></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Libelle">Libelle <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Libelle" readonly type="text" placeholder="Veuillez entrer le libelle" tabindex="1" value="<?= $this->nettoyer($TarifTexte->getLibelle()) ?>" name="Libelle" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="BorneInf">Borne Inférieure <span class="text-danger">*</span> </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="BorneInf" readonly type="text" placeholder="Veuillez entrer la borne inférieure" tabindex="2" name="BorneInf" value="<?= $this->nettoyer($TarifTexte->getBorneInf()) ?>" required data-parsley-type="integer">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="BorneSup">Borne Supérieure <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" readonly id="BorneSup" required tabindex="3" placeholder="Veuillez entrer la borne supérieure" name="BorneSup" value="<?= $this->nettoyer($TarifTexte->getBorneSup()) ?>" data-parsley-type="integer">
                                </div>

                                <label class="col-sm-2 col-form-label" for="Montant">Montant <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" readonly id="Montant" required tabindex="4" placeholder="Veuillez entrer le montant" name="Montant" value="<?= $this->nettoyer($TarifTexte->getMontant()) ?>" data-parsley-type="number">
                                </div>
                            </div>

                            <div class="required text-danger">* Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="TarifTexte"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>