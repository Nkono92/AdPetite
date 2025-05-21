<?php $this->titre = "AdPetite - Se connecter"; ?>

<?php $this->layout = "LayoutFront.php"; ?>

<!-- START HEADER-->

<header id="header-wrap">

    <?php require 'Vues/Shared/MenuHorizontal.php'; ?>

</header>

<!-- END HEADER -->



<!--<div class="block-center mt-4 wd-xl" style="width: 30%">
    <div class="card card-flat">
        <div class="card-header text-center bg-dark"><a href="javascript:void(0)"><img class="block-center rounded" src="Content/img/logo.png" alt="Image"></a></div>
        <div class="card-body">
            <p class="text-center py-2">CONNECTEZ-VOUS POUR CONTINUER.</p>
            <form method="post" data-parsley-validate="" action="Utilisateur/Login" method="post">
                <div class="card-header">
                    <div class="card-title text-danger"><?/*= $this->nettoyer($MessageError) */?></div>
                </div>

                <div class="form-group">
                    <div class="input-group with-focus">
                        <input class="form-control border-right-0" id="Login" name="Login" type="email" placeholder="Entrez votre email" autocomplete="off" required>
                        <div class="input-group-append">
                            <span class="input-group-text text-muted bg-transparent border-left-0"><em class="fa fa-envelope"></em></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group with-focus">
                        <input class="form-control border-right-0" id="MotDePasse" type="password" placeholder="Entrez votre mot de passe" name="MotDePasse" required>
                        <div class="input-group-append">
                            <span class="input-group-text text-muted bg-transparent border-left-0"><em class="fa fa-lock"></em></span>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="checkbox c-checkbox float-left mt-0"><label><input type="checkbox" value="" name="remember"><span class="fa fa-check"></span> Se souvenir de moi</label></div>
                    <div class="float-right"><a class="text-muted" href="Utilisateur/recover">Mot de passe oublié?</a></div>
                </div><button class="btn btn-block btn-primary mt-3" type="submit">Se connecter</button>
            </form>
            <p class="pt-3 text-center">Vous ne disposez pas d'un compte?</p><a class="btn btn-block btn-secondary" href="Utilisateur/Register">Register Now</a>
        </div>
    </div>
    <!-- <div class="p-3 text-center">
        <span class="mr-2">&copy;</span><span>2020</span><span class="mr-2">-</span><span>Angle</span><br><span>Bootstrap Admin Template</span>
    </div>
</div>
-->

<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Page de connexion</h2>
                    <ol class="breadcrumb">
                        <li><a href="Accueil">Accueil /</a></li>
                        <li class="current">Page de connexion</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="featured section-padding">
    <div class="container">
            <div class="card-title text-danger"><?= $this->nettoyer($MessageError) ?></div>
    </div>
</section>

<section class="login section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="login-form login-area">
                    <h3>
                        Connectez-vous
                    </h3>
                    <form role="form" class="login-form" method="post" data-parsley-validate="" action="Utilisateur/Login">

                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input class="form-control" id="Login" name="Login" type="email" placeholder="Entrez votre email" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input class="form-control" id="MotDePasse" type="password" placeholder="Entrez votre mot de passe" name="MotDePasse" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <input type="checkbox" name="rememberme" value="rememberme">
                                <label>Rester connecter</label>
                            </div>
                            <a class="forgetpassword" href="forgot-password.html">Mot de passe oublié?</a>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-common log-btn">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

