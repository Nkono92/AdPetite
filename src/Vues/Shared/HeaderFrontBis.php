<div id="hero-area">
    <div class="overlay"></div>
    <div class="container" style="max-width: 1500px !important;">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 text-center">
                <div class="contents">
                    <div class="search-bar">
                        <div class="search-inner">
                            <form class="search-form" method="post" action="Accueil/TrouverAnnonce">
                                <div class="form-group inputwithicon">
                                    <i class="lni-tag"></i>
                                    <input type="text" name="MotCle" id="MotCle" class="form-control" placeholder="Saisir un mot clé">
                                </div>
                                <div class="form-group inputwithicon">
                                    <i class="lni-map-marker"></i>
                                    <div class="select">
                                        <select class="" name="IdVille" id="IdVille">
                                            <option selected="selected" disabled="true">Veuillez sélectionnez une ville</option>
                                            <?php foreach ($Pays as $pays): ?>
                                                    <?php foreach ($pays->getDepartementPays() as $departement): ?>
                                                            <?php foreach ($departement->getVilleDepartement() as $ville): ?>
                                                                <option value="<?= $this->nettoyer($ville->getIdVille()) ?>">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->nettoyer($ville->getLibelle()) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group inputwithicon">
                                    <i class="lni-menu"></i>
                                    <div class="select">
                                        <select class="" name="IdSousCategorie" id="IdSousCategorie">
                                            <option selected="selected" disabled="true">Veuillez sélectionnez une catégorie</option>
                                            <?php foreach ($Categorie as $categorie): ?>
                                                <?php foreach ($categorie->getLesSousCategories() as $sousCategorie): ?>
                                                    <option value="<?= $this->nettoyer($sousCategorie->getIdSousCategorie()) ?>">
                                                        <?= $this->nettoyer($sousCategorie->getLibelle()) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-common" type="submit"><i class="lni-search"></i> Rechercher </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>