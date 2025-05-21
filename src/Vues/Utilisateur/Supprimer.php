<?php $this->titre = "Supprimer un utilisateur"; ?>

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
            <div class="col-xl-12">
                <form method="post" data-parsley-validate="" action="Utilisateur/Modifier" method="post">
                    <input  type="hidden" name="IdUtilisateur" value="<?= $this->nettoyer($Utilisateur->getIdUtilisateur()) ?>" required>
                    <input  type="hidden" name="Statut" value="<?= $this->nettoyer($Utilisateur->getStatut()) ?>" required>
                    <input  type="hidden" name="DateInscription" value="<?= $this->nettoyer($Utilisateur->getDateInscription()->format('d/m/Y H:i:s')) ?>" required>

                    <!-- START card-->
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-title text-danger text-bold"><h3>Voulez-vous vraiment supprimer cet élément?</h3></div>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Nom">Nom <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Nom" type="text" placeholder="Veuillez entrer le nom" tabindex="1" name="Nom" value="<?= $this->nettoyer($Utilisateur->getNom()) ?>"required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="Prenom">Prenom <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Prenom" type="text" placeholder="Veuillez entrer le prénom" tabindex="2" name="Prenom" value="<?= $this->nettoyer($Utilisateur->getPrenom()) ?>" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Telephone">Téléphone <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Telephone" data-masked="" data-inputmask="'mask': '(999)999-999-999'" im-insert="true" type="text"
                                           placeholder="Veuillez entrer le numéro de téléphone" tabindex="3" name="Telephone" value="<?= $this->nettoyer($Utilisateur->getTelephone()) ?>" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="Email">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Email" type="email" placeholder="Veuillez entrer l'email" tabindex="4" name="Email" value="<?= $this->nettoyer($Utilisateur->getEmail()) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="MotDePasse">Mot de passe <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="MotDePasse" type="password" placeholder="Veuillez entrer le mot de passe" tabindex="5" name="MotDePasse" required>
                                </div>

                                <label class="col-sm-2 col-form-label" for="MotDePasseConfirmation">Confirmation mot de passe <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="MotDePasseConfirmation" type="password" placeholder="Veuillez confirmer le mot de passe" tabindex="6" name="MotDePasseConfirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="Rue">Rue</label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="Rue" type="text" placeholder="Veuillez entrer le nom de la rue" tabindex="7" value="<?= $this->nettoyer($Utilisateur->getRue()) ?>" name="Rue">
                                </div>

                                <label class="col-sm-2 col-form-label" for="BoitePostale">Boite postale</label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly id="BoitePostale" type="text" placeholder="Veuillez entrer la boite postale" tabindex="8" value="<?= $this->nettoyer($Utilisateur->getBoitePostale()) ?>" name="BoitePostale" data-parsley-type="number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="PhotoProfil">Photo de profil</label>
                                <div class="col-sm-4">
                                    <input class="form-control filestyle" readonly tabindex="9" id="PhotoProfil" placeholder="Veuillez choisir votre photo de profil" name="PhotoProfil"
                                           type="file" data-classbutton="btn btn-secondary" data-classinput="form-control inline"
                                           data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
                                </div>

                                <label class="col-sm-2 col-form-label" for="IdProfilUtilisateur">Profil Utilisateur <span class="text-danger">*</span> </label>
                                <div class="col-sm-4">
                                    <select class="form-control select2-1" disabled tabindex="10" name="IdProfilUtilisateur" id="IdProfilUtilisateur" required>
                                        <option selected>Veuillez sélectionner un profil utilisateur</option>
                                        <?php foreach ($ProfilUtilisateur as $leProfilUtilisateur): ?>
                                            <option <?php if ($leProfilUtilisateur->getIdProfilUtilisateur() == $this->nettoyer($Utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur())) echo 'selected'; ?> value="<?= $this->nettoyer($leProfilUtilisateur->getIdProfilUtilisateur()) ?>" >

                                            <?= $this->nettoyer($leProfilUtilisateur->getLibelle()) ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                            </div>

                            <div class="required text-danger"><span class="text-danger">*</span> Champ(s) requi(s)</div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="Utilisateur/<?php echo $this->nettoyer($Utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur()) == ADMIN_PROFILE_CODE?"IndexAdmin":"Index"; ?>"> Annuler </a>
                        </div>
                    </div><!-- END card-->
                </form>
            </div>
        </div>
        <!-- END row-->

    </div>
</section>