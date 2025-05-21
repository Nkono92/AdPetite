<?php $this->titre = "PrimoAnnonce - Paiement"; ?>

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
                    <h2 class="product-title">Paiements</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Paiements</li>
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
                                <h3 style="font-size: 12px !important;"><?= $this->nettoyer($sessionClient->getNom()).' '.$this->nettoyer($sessionClient->getPrenom()) ?></h3>
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
            <div class="col-sm-12 col-md-8 col-lg-9" id="printdivcontent">
                <!-- Main section Start -->
                <!-- Page content-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h3 class="m-0">Facture N°: <?= $this->nettoyer($Paiement->getReference()) ?></h3>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-xl-6 col-6 br py-2">
                                <div class="row">
                                    <div class="col-lg-2 text-center d-none d-lg-block"><em class="fa fa-user fa-2x text-muted"></em></div>
                                    <div class="col-lg-10">
                                        <h4><?= $this->nettoyer($Paiement->getAnnonce()->getUtilisateur()->getPrenom()) ?>
                                            <?= $this->nettoyer($Paiement->getAnnonce()->getUtilisateur()->getNom()) ?>
                                        </h4>
                                        <address></address>Tel: <?= $this->nettoyer($Paiement->getAnnonce()->getUtilisateur()->getTelephone()) ?>
                                        <br>
                                        Email: <?= $this->nettoyer($Paiement->getAnnonce()->getUtilisateur()->getEmail()) ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-6 col-12 py-2">
                                <div class="clearfix">
                                    <p class="float-left">Facture N°:</p>
                                    <p class="float-right mr-2"><?= $this->nettoyer($Paiement->getReference()) ?></p>
                                </div>
                                <div class="clearfix">
                                    <p class="float-left">Date</p>
                                    <p class="float-right mr-2"><?= $this->nettoyer($Paiement->getAnnonce()->getDateCreation()->format('d/m/Y h:i:s')) ?></p>
                                </div>
                                <div class="clearfix">
                                    <p class="float-left">Date règlement</p>
                                    <p class="float-right mr-2"><?= $this->nettoyer((new DateTime("now"))->format('d/m/Y h:i:s')) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-bordered mb-3">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Réf #</th>
                                    <th>Description</th>
                                    <th>Quantité</th>
                                    <th class="text-right">Montant</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>TXT-<?= $this->nettoyer($Paiement->getTarifTexte()->getIdTarifTexte()) ?></td>
                                    <td><?= $this->nettoyer(mb_strtoupper($Paiement->getTarifTexte()->getLibelle())) ?></td>
                                    <td><?= $this->nettoyer($nombreMotAnnonce) ?> mots</td>
                                    <td class="text-right"><?= $this->nettoyer($formatter->formatCurrency($Paiement->getTarifTexte()->getMontant(), "EUR") )?> </td>
                                </tr>
                                <tr>
                                    <td>IMG-<?= $this->nettoyer($Paiement->getTarifImage()->getIdTarifImage()) ?></td>
                                    <td><?= $this->nettoyer(mb_strtoupper($Paiement->getTarifImage()->getLibelle())) ?></td>
                                    <td><?= $this->nettoyer($nombreImagesAnnonce) ?> Images</td>
                                    <td class="text-right"><?= $this->nettoyer($formatter->formatCurrency($Paiement->getTarifImage()->getMontant(), "EUR")) ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7 py-2">
                                <div class="row mb-3">
                                    <div class="col-8">Sous total</div>
                                    <div class="col-4">
                                        <div class="text-right"><?= $this->nettoyer($formatter->formatCurrency($sousTotal, "EUR")) ?> </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-8">Taxe (19,25%)</div>
                                    <div class="col-4">
                                        <div class="text-right"><?= $this->nettoyer($formatter->formatCurrency($taxe, "EUR")) ?> </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-7">
                                        <div class="h3">MONTANT TTC</div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-right h3"><?= $this->nettoyer($formatter->formatCurrency($montantTotal, "EUR")) ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="montantTotal" name="montantTotal" value="<?= $this->nettoyer($montantTotal) ?>">
                        <input type="hidden" id="IdAnnonce" name="IdAnnonce" value="<?= $this->nettoyer($Paiement->getAnnonce()->getIdAnnonce()) ?>">
                        <hr class="d-print-none">
                        <div class="clearfix">
                            <div id="paypal-button-container"></div>

                            <script
                                src="https://www.paypal.com/sdk/js?client-id=AfBvEdEMvEHTu070ijj7MN3X5Yqfuxs3ANeNW_C2ERfa9zPIvhlLtOW1HBpclRHvrqFjsY64yI-15hQL&currency=EUR"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
                            </script>
                            <br><br>
                            <button class="btn btn-secondary float-left" type="button" onclick="PrintDiv('printdivcontent');"> <i class="lni-printer"></i> Print</button>

                        </div>

                    </div>
                </div>
                <!-- Main section End -->
            </div>
        </div>
    </div>
</div>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: document.getElementById("montantTotal").value
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                window.location= "Paiement/PrevalidationPaiement/" + data.orderID;
            });
        }

    }).render('#paypal-button-container');

    //This function displays Smart Payment Buttons on your web page.
</script>

