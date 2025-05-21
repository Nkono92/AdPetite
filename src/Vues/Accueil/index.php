<?php $this->titre = "PrimoAnnonce - Plateforme d'annonces classifiées"; ?>

<?php $this->layout = "LayoutFront.php"; ?>


<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

    <?php require 'Vues/Shared/HeaderFront.php'; ?>

</header>

<!-- END HEADER -->


<!-- Main section-->
<section class="categories-icon section-padding bg-drack">
    <div class="container">
        <div class="row">
            <?php foreach ($SousCategories as $SousCategorie): ?>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="Categorie">
                    <div class="icon-box">
                        <div class="icon">
                            <i class="<?= $this->nettoyer($SousCategorie->getFontIcone()) ?>"></i>
                        </div>
                        <h4><?= $this->nettoyer($SousCategorie->getLibelle()) ?></h4>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="featured section-padding">
    <div class="container">
        <h1 class="section-title">Annonces Récentes</h1>
        <div class="row">
            <?php foreach ($Annonces as $Annonce): ?>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                    <div class="featured-box">
                        <figure>
                            <div class="icon">
                                <?php if (isset($sessionClient)): ?>
                                    <a href="Annonce/Favoris/<?= $this->nettoyer($Annonce->getIdAnnonce()) ?>">
                                        <i class="lni-heart"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                            <a href="Annonce/Detailler/<?= $this->nettoyer($Annonce->getIdAnnonce()) ?>">
                                <img class="img-fluid" src="
                                            <?php
                                foreach ($Annonce->getLesPiecesJointes() as $pieceJointe)
                                {
                                    if ($pieceJointe->getTypePieceJointe()->getIdTypePieceJointe() == PIECE_JOINTE_PRINCIPALE)
                                    {
                                        echo $pieceJointe->getUrl().'"alt="'.$pieceJointe->getLibelle().'">';
                                    }
                                }?>
                            </a>
                        </figure>
                        <div class="feature-content">
                            <div class="product">
                                <a href="javascript:void(0)"><i class="lni-folder"></i> <?= $this->nettoyer($Annonce->getSousCategorie()->getLibelle()) ?></a>
                            </div>
                            <h4><a href="ads-details.html"><?= $this->nettoyer($Annonce->getTitre()) ?></a></h4>
                            <span>Dernière mise à jour : <?= $this->nettoyer($Annonce->getDateCreation()->format('d/m/Y')) ?> à <?= $this->nettoyer($Annonce->getDateCreation()->format('H:i:s')) ?> </span>
                            <ul class="address">
                                <li>
                                    <a href="javascript:void(0)"><i class="lni-map-marker"></i> <?= $this->nettoyer($Annonce->getVille()->getLibelle()) ?> </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni-alarm-clock"></i> <?= $this->nettoyer($Annonce->getDateCreation()->format('d/m/Y')) ?></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni-user"></i>
                                        <?= $this->nettoyer($Annonce->getUtilisateur()->getPrenom()) ?> <?= $this->nettoyer($Annonce->getUtilisateur()->getNom()) ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni-package"></i> <?= $this->nettoyer($Annonce->getTypeAnnonce()->getLibelle()) ?></a>
                                </li>
                            </ul>
                            <div class="listing-bottom">
                                <h3 class="price float-left"><?= $this->nettoyer($Annonce->getPrix()) ?> XAF</h3>
                                <?php if ($this->nettoyer($Annonce->getStatut()) == STATUT_VALIDE) :?>
                                    <a href="javascript:void(0)" class="btn-verified float-right"><i class="lni-check-box"></i> Annonce vérifiée</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="services section-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.2s">
                    <div class="icon">
                        <i class="lni-book"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">Fully Documented</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.4s">
                    <div class="icon">
                        <i class="lni-leaf"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">Clean & Modern Design</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
                    <div class="icon">
                        <i class="lni-map"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">Great Features</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.8s">
                    <div class="icon">
                        <i class="lni-cog"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">Completely Customizable</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="1s">
                    <div class="icon">
                        <i class="lni-pointer-up"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">User Friendly</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="1.2s">
                    <div class="icon">
                        <i class="lni-layout"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="javascript:void(0)">Awesome Layout</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="counter-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-layers"></i></div>
                    <h2 class="counterUp">12090</h2>
                    <p>Regular Ads</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-map"></i></div>
                    <h2 class="counterUp">350</h2>
                    <p>Locations</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-user"></i></div>
                    <h2 class="counterUp">23453</h2>
                    <p>Reguler Members</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-briefcase"></i></div>
                    <h2 class="counterUp">250</h2>
                    <p>Premium Ads</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!--<section id="pricing-table" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mainHeading">
                    <h2 class="section-title">Select A Package</h2>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="table">
                    <div class="icon">
                        <i class="lni-gift"></i>
                    </div>
                    <div class="title">
                        <h3>SILVER</h3>
                    </div>
                    <div class="pricing-header">
                        <p class="price-value"><sup>$</sup>29<span>/ Mo</span></p>
                    </div>
                    <ul class="description">
                        <li><strong>Free</strong> ad posting</li>
                        <li><strong>No</strong> Featured ads availability</li>
                        <li><strong>For 30</strong> days</li>
                        <li><strong>100%</strong> Secure!</li>
                    </ul>
                    <button class="btn btn-common">Buy Now</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="table" id="active-tb">
                    <div class="icon">
                        <i class="lni-leaf"></i>
                    </div>
                    <div class="title">
                        <h3>STANDARD</h3>
                    </div>
                    <div class="pricing-header">
                        <p class="price-value"><sup>$</sup>89<span>/ Mo</span></p>
                    </div>
                    <ul class="description">
                        <li><strong>Free</strong> ad posting</li>
                        <li><strong>6</strong> Featured ads availability</li>
                        <li><strong>For 30</strong> days</li>
                        <li><strong>100%</strong> Secure!</li>
                    </ul>
                    <button class="btn btn-common">Buy Now</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="table">
                    <div class="icon">
                        <i class="lni-layers"></i>
                    </div>
                    <div class="title">
                        <h3>PLANINIUM</h3>
                    </div>
                    <div class="pricing-header">
                        <p class="price-value"><sup>$</sup>99<span>/ Mo</span></p>
                    </div>
                    <ul class="description">
                        <li><strong>Free</strong> ad posting</li>
                        <li><strong>20</strong> Featured ads availability</li>
                        <li><strong>For 25</strong> days</li>
                        <li><strong>100%</strong> Secure!</li>
                    </ul>
                    <button class="btn btn-common">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</section>-->


<section class="testimonial section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="testimonials" class="owl-carousel">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="assets/img/testimonial/img1.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="javascript:void(0)">John Doe</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                                <h3>Developer at of <a href="javascript:void(0)">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="assets/img/testimonial/img2.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="javascript:void(0)">Jessica</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                                <h3>Developer at of <a href="javascript:void(0)">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="assets/img/testimonial/img3.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="javascript:void(0)">Johnny Zeigler</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                                <h3>Developer at of <a href="javascript:void(0)">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="assets/img/testimonial/img1.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="javascript:void(0)">John Doe</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                                <h3>Developer at of <a href="javascript:void(0)">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="assets/img/testimonial/img2.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="javascript:void(0)">Jessica</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                                <h3>Developer at of <a href="javascript:void(0)">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="subscribes section-padding">
    <div class="container">
        <div class="row wrapper-sub">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <form>
                    <div class="subscribe">
                        <input class="form-control" name="EMAIL" placeholder="Your email here" required="" type="email">
                        <button class="btn btn-common" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!--<section class="cta section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="single-cta">
                    <div class="cta-icon">
                        <i class="lni-grid"></i>
                    </div>
                    <h4>Refreshing Design</h4>
                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="single-cta">
                    <div class="cta-icon">
                        <i class="lni-brush"></i>
                    </div>
                    <h4>Easy to Customize</h4>
                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="single-cta">
                    <div class="cta-icon">
                        <i class="lni-headphone-alt"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie</p>
                </div>
            </div>
        </div>
    </div>
</section>-->
