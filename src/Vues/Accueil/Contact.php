<?php $this->titre = "AdPetite - Contact"; ?>

<?php $this->layout = "LayoutFront.php"; ?>


<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

</header>

<!-- END HEADER -->


<!-- Main section-->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Contactez-nous</h2>
                    <ol class="breadcrumb">
                        <li><a href="#">Accueil /</a></li>
                        <li class="current">Contactez-nous</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<section id="google-map-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="conatiner-map"></div>
            </div>
        </div>
    </div>
</section>-->


<section id="content" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <h2 class="contact-title">
                    Envoyez nous un message
                </h2>

                <form id="contactForm" class="contact-form" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Veuillez entrer votre nom">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email" required data-error="veuillez entrer votre email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="msg_subject" name="subject" placeholder="Veuillez saisir un sujet" required data-error="Veuillez saisir un sujet">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Veuillez saisir un message" rows="10" data-error="Veuillez saisir un message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="submit" class="btn btn-common">Envoyer</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <h2 class="contact-title">
                    Get In Touch
                </h2>
                <div class="information">
                    <p>Lorem Ipsum Is simply dummy text of the printing and typesetting Industry.
                        Lorem Ipsum has been the Industry's</p>
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="lni-map-marker icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Address</h3>
                            <span class="detail">Level 13, 2 Ellzabeth St, <br> Lorem Ipsum Is simply dummy text</span>
                        </div>
                    </div>
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="lni-pointer icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Have any Questions?</h3>
                            <span class="detail"><a href="https://preview.uideck.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6635131616091412260b070f0a4805090b">[email&#160;protected]</a></span>
                        </div>
                    </div>
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="lni-phone-handset icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Call Us & Hire us</h3>
                            <span class="detail">Main Office: +880 123 456 789</span>
                        </div>
                    </div>
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="lni-phone icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Telephone</h3>
                            <span class="detail">(+88) 112345678 912</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

