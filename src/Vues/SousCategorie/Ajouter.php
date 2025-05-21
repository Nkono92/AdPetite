<?php $this->titre = "Nouvelle sous catégorie"; ?>

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
            <div>Gestion des sous catégories</div>
        </div>


        <!-- START row-->
        <div class="row">
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="SousCategorie/Ajouter" method="post">
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

                                <label class="col-sm-2 col-form-label" for="FontIcone">Font Icone <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="FontIcone" type="text" placeholder="Veuillez entrer le FontIcone" tabindex="2" name="FontIcone" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="IdCategorie">Catégorie <span class="text-danger">*</span> </label>
                                <div class="col-sm-4">
                                    <select class="form-control select2-1" name="IdCategorie" id="IdCategorie" required>
                                        <option selected>Veuillez sélectionner une categorie</option>
                                        <?php foreach ($Categorie as $laCategorie): ?>
                                            <option value="<?= $this->nettoyer($laCategorie->getIdCategorie()) ?>">
                                                <?= $this->nettoyer($laCategorie->getLibelle()) ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>

                            <div class="required text-danger"><span class="text-danger">*</span> Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Valider</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="SousCategorie"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>