<?php $this->titre = "Liste des utilisateurs"; ?>

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

        <div class="container-fluid">
            <div class="card">
                <div Class="form-inline padding-bottom-1">
                    <div Class="col-md-8" style="margin-top: 30px">
                        <div Class="col-md-12">
                            <div Class="form-group">
                                <a class="mb-1 btn btn-primary" title="Nouveau" href="Utilisateur/Ajouter">
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
                            <th class="sorting_asc_disabled sorting_desc_disabled" >Photo Profil</th>
                            <th data-priority="1">Prénom & Nom</th>
                            <th>Téléphone</th>
                            <th>Date Inscription</th>
                            <th>Profil</th>
                            <th>Action(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($utilisateurs as $l_Utilisateur): ?>
                            <tr class="gradeX">
                                <td><img class="img-fluid rounded-circle img-thumbnail thumb64" src="<?= $this->nettoyer($l_Utilisateur->getPhotoProfil()) ?>" alt="Contact"></td>
                                <td><?= $this->nettoyer($l_Utilisateur->getPrenom()).' '.$this->nettoyer($l_Utilisateur->getNom()) ?></td>
                                <td><?= $this->nettoyer($l_Utilisateur->getTelephone()) ?></td>
                                <td><?= $this->nettoyer($l_Utilisateur->getDateInscription()->format('d/m/Y H:i:s')) ?></td>
                                <td><?= $this->nettoyer($l_Utilisateur->getProfilUtilisateur()->getLibelle()) ?></td>

                                <td>
                                    <a class="btn btn-warning btn-square" title="Modifier" href="Utilisateur/Modifier/<?= $this->nettoyer($l_Utilisateur->getIdUtilisateur())?>" >
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-primary btn-square" title="Informations supplémentaires" href="Utilisateur/Detailler/<?= $this->nettoyer($l_Utilisateur->getIdUtilisateur())?>" >
                                        <i class="fas fa-list" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-danger btn-square" title="Supprimer" href="Utilisateur/Supprimer/<?= $this->nettoyer($l_Utilisateur->getIdUtilisateur())?>" >
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