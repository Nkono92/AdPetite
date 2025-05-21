<?php $this->titre = "PrimoAnnonce - Se connecter"; ?>

<?php $this->layout = "Layout.php"; ?>

<!-- START HEADER-->

<header id="header-wrap">

</header>

<!-- END HEADER -->



<div class="block-center mt-4 wd-xl" style="width: 30%">
    <div class="card card-flat">
        <div class="card-header text-center bg-dark"><a href="javascript:void(0)"><img class="block-center rounded" src="Content/img/logo.png" alt="Image"></a></div>
        <div class="card-body">
            <p class="text-center py-2">CONNECTEZ-VOUS POUR CONTINUER.</p>
            <form method="post" data-parsley-validate="" action="Utilisateur/LoginAdmin" method="post">
                <div class="card-header">
                    <div class="card-title text-danger"><?= $this->nettoyer($MessageError)?></div>
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
<!--            <p class="pt-3 text-center">Vous ne disposez pas d'un compte?</p><a class="btn btn-block btn-secondary" href="Utilisateur/Register">Register Now</a>-->        </div>
    </div>
    <!-- <div class="p-3 text-center">
        <span class="mr-2">&copy;</span><span>2020</span><span class="mr-2">-</span><span>Angle</span><br><span>Bootstrap Admin Template</span>
    </div>
</div>

