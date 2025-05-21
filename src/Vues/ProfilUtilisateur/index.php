<?php $this->titre = "Liste des profils utilisateur"; ?>

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

        <div class="container-fluid">
            <div class="card">
                <div Class="form-inline padding-bottom-1">
                    <div Class="col-md-8" style="margin-top: 30px">
                        <div Class="col-md-12">
                            <div Class="form-group">
                                <a class="mb-1 btn btn-primary" title="Nouveau" href="ProfilUtilisateur/Ajouter">
                                <i class="fas fa-plus"></i>&nbsp; Nouveau
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <table class="table table-striped my-4 w-100" id="datatable3" style="text-align: center">
                        <thead>
                        <tr>
                            <th data-priority="1">Identifiant</th>
                            <th>Libelle</th>
                            <th>Action(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($profilUtilisateurs as $profilUtilisateur): ?>
                            <tr class="gradeX">
                                <td><?= $this->nettoyer($profilUtilisateur->getIdProfilUtilisateur()) ?></td>
                                <td><?= $this->nettoyer($profilUtilisateur->getLibelle()) ?></td>
                                <td>
                                    <a class="btn btn-warning btn-square" title="Modifier" href="ProfilUtilisateur/Modifier/<?= $this->nettoyer($profilUtilisateur->getIdProfilUtilisateur())?>" >
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-danger btn-square" title="Supprimer" href="ProfilUtilisateur/Supprimer/<?= $this->nettoyer($profilUtilisateur->getIdProfilUtilisateur())?>" >
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
