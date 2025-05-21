<?php $this->titre = "Liste des sous annonces"; ?>

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
            <div>Gestion des annonces</div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div Class="form-inline padding-bottom-1">
                    <div Class="col-md-8" style="margin-top: 30px">
                        <div Class="col-md-12">
                            <div Class="form-group">

                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <table class="table table-striped my-4 w-100" id="datatable3" style="text-align: center">
                        <thead>
                        <tr>
                            <th data-priority="1">Identifiant</th>
                            <th>Titre</th>
                            <th>Type d'annonce</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Action(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($Annonces as $uneAnnonce): ?>
                            <tr class="gradeX">
                                <td><?= $this->nettoyer($uneAnnonce->getIdAnnonce()) ?></td>
                                <td><?= $this->nettoyer($uneAnnonce->getTitre()) ?></td>
                                <td><?= $this->nettoyer($uneAnnonce->getTypeAnnonce()->getLibelle()) ?></td>
                                <td><?= $this->nettoyer($uneAnnonce->getSousCategorie()->getLibelle()) ?></td>
                                <td>
                                    <?php
                                        if ($this->nettoyer($uneAnnonce->getStatut() == STATUT_BLOQUE))
                                        {
                                            echo 'Bloquée';
                                        }
                                        elseif ($this->nettoyer($uneAnnonce->getStatut() == STATUT_NON_VALIDE))
                                        {
                                            echo 'Non validée';
                                        }
                                        elseif ($this->nettoyer($uneAnnonce->getStatut() == STATUT_VALIDE))
                                        {
                                            echo 'Validée';
                                        }
                                        else
                                        {
                                            echo 'Inconnu';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-square" target="_blank" title="Detailler l'annonce" href="Annonce/Detailler/<?= $this->nettoyer($uneAnnonce->getIdAnnonce())?>" >
                                        <i class="fas fa-list" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-danger btn-square" title="Bloquer" href="Annonce/Bloquer/<?= $this->nettoyer($uneAnnonce->getIdAnnonce())?>" >
                                        <i class="fas fa-times" aria-hidden="true"></i>
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