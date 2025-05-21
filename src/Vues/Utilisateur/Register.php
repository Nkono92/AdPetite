<?php $this->titre = "Inscription"; ?>

<?php $this->layout = "Layout.php"; ?>


<div class="block-center mt-4 wd-xl" style="width: 80%">
    <!-- START card-->
    <div class="card card-flat">
        <div class="card-header text-center bg-dark"><a href="#"><img class="block-center" src="Content/img/logo.png" alt="Image"></a></div>
        <div class="card-body">
            <p class="text-center py-2">FORMULAIRE D'INSCRIPTION</p>

            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="Utilisateur/Register" method="post" enctype="multipart/form-data">
                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title text-danger"><?= $this->nettoyer($MessageError) ?></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Nom">Nom <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Nom" type="text" placeholder="Veuillez entrer le nom" tabindex="1" name="Nom" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="Prenom">Prenom <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Prenom" type="text" placeholder="Veuillez entrer le prénom" tabindex="2" name="Prenom" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Telephone">Téléphone <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Telephone" data-masked="" data-inputmask="'mask': '(+237) 999-999-999'" im-insert="true" type="text"
                                           placeholder="Veuillez entrer le numéro de téléphone" tabindex="3" name="Telephone" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="Email">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Email" type="email" placeholder="Veuillez entrer l'email" tabindex="4" name="Email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="MotDePasse">Mot de passe <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="MotDePasse" type="password" placeholder="Veuillez entrer le mot de passe" tabindex="5" name="MotDePasse" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="MotDePasseConfirmation">Confirmation mot de passe <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="MotDePasseConfirmation" type="password" placeholder="Veuillez confirmer le mot de passe" tabindex="6" name="MotDePasseConfirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Rue">Rue</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="Rue" type="text" placeholder="Veuillez entrer le nom de la rue" tabindex="7" name="Rue">
                                </div>

                                <label class="col-sm-2 col-form-label" for="BoitePostale">Boite postale</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="BoitePostale" type="text" placeholder="Veuillez entrer la boite postale" tabindex="8" name="BoitePostale" data-parsley-type="number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="PhotoProfil">Photo de profil</label>
                                <div class="col-sm-4">
                                    <input class="form-control filestyle" tabindex="9" id="PhotoProfil" placeholder="Veuillez choisir votre photo de profil" name="PhotoProfil"
                                           type="file" data-classbutton="btn btn-secondary" data-classinput="form-control inline"
                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
                                </div>

                            </div>

                            <div class="required text-danger"><span class="text-danger">*</span> Champ(s) requi(s)</div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Valider</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="Utilisateur"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>

            <p class="pt-3 text-center">Vous disposez déjà d'un compte?</p><a class="btn btn-block btn-secondary" href="Utilisateur/Login">Connectez-vous</a>
        </div>
    </div>
    <!-- END card-->
    <!-- <div class="p-3 text-center">
    <span class="mr-2">&copy;</span><span>2020</span><span class="mr-2">-</span><span>Angle</span><br><span>Bootstrap Admin Template</span></div>-->
</div>
