<?php $this->titre = "AdPetite - Ajouter une annonce"; ?>

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
                    <h2 class="product-title">Ajouter une annonce</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Ajouter une annonce</li>
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
                                <h3 class="text-center" style="font-size: 12px !important;">
                                    <?= $this->nettoyer($sessionClient->getNom()).' '.$this->nettoyer($sessionClient->getPrenom()) ?>
                                </h3>
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
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="page-content">
                    <div class="inner-box">
                        <div class="dashboard-box">
                            <h2 class="dashbord-title text-center text-bold">Veuillez remplir le formulaire ci-dessous pour ajouter une annonce</h2>
                            <br><br>
                        </div>
                        <div class="dashboard-wrapper" >

                            <form method="post" data-parsley-validate="" action="Annonce/Ajouter" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="IdTypeAnnonce">Type d'annonce*</label>
                                            <select class="form-control select2-1" tabindex="1" name="IdTypeAnnonce" id="IdTypeAnnonce" required>
                                                <option selected>Veuillez sélectionner un type d'annonce</option>
                                                <?php foreach ($TypeAnnonces as $TypeAnnonce): ?>
                                                    <option value="<?= $this->nettoyer($TypeAnnonce->getIdTypeAnnonce()) ?>">
                                                        <?= $this->nettoyer($TypeAnnonce->getLibelle()) ?>
                                                    </option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="IdVille">Ville*</label>
                                            <select class="form-control select2-1" tabindex="3" name="IdVille" id="IdVille" required>
                                                <option selected>Veuillez sélectionner une ville</option>
                                                <?php foreach ($Villes as $Ville): ?>
                                                    <option value="<?= $this->nettoyer($Ville->getIdVille()) ?>">
                                                        <?= $this->nettoyer($Ville->getLibelle()) ?>
                                                    </option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Description">Description*</label>
                                            <textarea class="form-control" tabindex="5" placeholder="Veuillez entrer la description"
                                                      required name="Description" id="Description" style="height: 109px">
                                            </textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="LienYoutube">Lien YouTube</label>
                                            <input class="form-control input-md" tabindex="8" placeholder="Veuillez entrer le lien YouTube"
                                                   id="LienYoutube" name="LienYoutube"  type="text">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Autre">Autre</label>
                                            <textarea class="form-control" tabindex="10" placeholder="Autres informations..."
                                                       name="Autre" id="Autre" style="height: 109px">
                                            </textarea>
                                        </div>

                                        <br>
                                        <label class="tg-fileuploadlabel" for="tg-photogallery">
                                            <span>Déposer le fichier</span>
                                            <span>Ou</span>
                                            <span class="btn btn-common">Sélectionnez le fichier</span>
                                            <span>Taille maximale du fichier: 1 MB</span>
                                            <input id="tg-photogallery" class="tg-fileinput" accept="image/png, image/jpeg" multiple type="file" name="PieceJointeSecondaires[]">
                                        </label>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="IdSousCategorie">Categorie d'annonces*</label>
                                            <select class="form-control select2-1" tabindex="2" name="IdSousCategorie" id="IdSousCategorie" required>
                                                <option selected>Veuillez sélectionner une catégorie</option>
                                                <?php foreach ($SousCategories as $SousCategorie): ?>
                                                    <option value="<?= $this->nettoyer($SousCategorie->getIdSousCategorie()) ?>">
                                                        <?= $this->nettoyer($SousCategorie->getLibelle()) ?>
                                                    </option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Titre">Titre*</label>
                                            <input class="form-control" placeholder="Veuillez entrer le titre" name="Titre" id="Titre" type="text" required tabindex="4">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Telephone">Téléphone</label>
                                            <input class="form-control" placeholder="Veuillez entrer le numéro de téléphone" tabindex="6"
                                                   name="Telephone" id="Telephone" data-mask="(+237) 999-999-999" type="text" value="<?= $this->nettoyer($Utilisateur->getTelephone()) ?>">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="Prix">Prix</label>
                                            <input class="form-control input-md" tabindex="7" placeholder="Veuillez entrer le prix"
                                                   name="Prix"  id="Prix" type="text">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label" for="LienVimeo">Lien Vimeo</label>
                                            <input class="form-control input-md" tabindex="9" placeholder="Veuillez entrer le lien Vimeo"
                                                   name="LienVimeo" id="LienVimeo"  type="text">
                                        </div>


                                        <br>

                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label for="customFile">
                                                Sélectionnez l'image principale -
                                                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer l'image">Vider</a>
                                            </label>
                                            <label class="custom-file-container__custom-file">
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                                       tabindex="11" id="customFile" name="PieceJointe" accept="image/png, image/jpeg" aria-label="sélectionnez l'image principale">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview" style="height: 290px;">
                                            </div>
                                        </div>

                                        <button class="btn btn-common" type="submit">Enregistrer</button>

                                    </div>

                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
