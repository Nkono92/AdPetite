<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="lni-menu"></span>
                <span class="lni-menu"></span>
                <span class="lni-menu"></span>
            </button>
            <a href="Accueil" class="navbar-brand"><img src="Assets/img/logo.png" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="Accueil" aria-haspopup="true" aria-expanded="false">
                        Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Accueil/Categories">
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Accueil/AProposDeNous">
                        A propos
                    </a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pages
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="about.html">About Us</a>
                        <a class="dropdown-item" href="services.html">Services</a>
                        <a class="dropdown-item" href="ads-details.html">Ads Details</a>
                        <a class="dropdown-item" href="post-ads.html">Ads Post</a>
                        <a class="dropdown-item" href="pricing.html">Packages</a>
                        <a class="dropdown-item" href="testimonial.html">Testimonial</a>
                        <a class="dropdown-item" href="faq.html">FAQ</a>
                        <a class="dropdown-item" href="404.html">404</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="blog.html">Blog - Right Sidebar</a>
                        <a class="dropdown-item" href="blog-left-sidebar.html">Blog - Left Sidebar</a>
                        <a class="dropdown-item" href="blog-grid-full-width.html"> Blog full width </a>
                        <a class="dropdown-item" href="single-post.html">Blog Details</a>
                    </div>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="Accueil/Contact">
                        Contact
                    </a>
                </li>
            </ul>
            <?php if (isset($sessionClient)): ?>
                <ul class="sign-in">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="lni-user"></i> <?= $this->nettoyer($sessionClient->getNom()).' '.$this->nettoyer($sessionClient->getPrenom()) ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Utilisateur/Profile"><i class="lni-user"></i> Mon profil</a>
                            <a class="dropdown-item" href="Annonce"><i class="lni-wallet"></i> Mes annonces</a>
                            <a class="dropdown-item" href="Annonce/Favoris"><i class="lni-heart"></i> Mes favoris</a>
                            <a class="dropdown-item" href="Paiement/MesPaiement"><i class="lni-wallet"></i> Mes Paiements</a>
                            <a class="dropdown-item" href="Utilisateur/Deconnecter"><i class="lni-enter"></i> Se déconnecter</a>
                        </div>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="sign-in">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="Utilisateur/Login" aria-haspopup="true" aria-expanded="false">
                            <i class="lni-user"></i> Se Connecter
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            <!--<a class="tg-btn" href="post-ads.html">
                <i class="lni-pencil-alt"></i> Post An Ad
            </a>-->
        </div>
    </div>

    <ul class="mobile-menu">
        <li>
            <a class="active" href="Accueil" aria-haspopup="true" aria-expanded="false">
                Accueil
            </a>
        </li>

        <li>
            <a href="Accueil/Categories">
                Categories
            </a>
        </li>

        <li>
            <a href="Accueil/AProposDeNous">
                A propos
            </a>
        </li>

     <!--   <li>
            <a href="#">Pages</a>
            <ul class="dropdown">
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="ads-details.html">Ads Details</a></li>
                <li><a href="post-ads.html">Ads Post</a></li>
                <li><a href="pricing.html">Packages</a></li>
                <li><a href="testimonial.html">Testimonial</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="404.html">404</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Blog</a>
            <ul class="dropdown">
                <li><a href="blog.html">Blog - Right Sidebar</a></li>
                <li><a href="blog-left-sidebar.html">Blog - Left Sidebar</a></li>
                <li><a href="blog-grid-full-width.html"> Blog full width </a></li>
                <li><a href="single-post.html">Blog Details</a></li>
            </ul>
        </li>-->
        <li>
            <a href="Accueil/Contact">Contactez nous</a>
        </li>
        <?php if (isset($sessionClient)): ?>

        <li>
            <a><?= $this->nettoyer($sessionClient->getNom()).' '.$this->nettoyer($sessionClient->getPrenom()) ?> </a>
            <ul class="dropdown">
                <li><a href="Utilisateur/Profile"><i class="lni-user"></i> Mon profil</a></li>
                <li><a href="Annonce"><i class="lni-wallet"></i> Mes annonces</a></li>
                <li><a href="Annonce/Favoris"><i class="lni-heart"></i> Mes favoris</a></li>
                <li><a href="Paiement/MesPaiement"><i class="lni-wallet"></i> Mes Paiements</a></li>
                <li><a href="Utilisateur/Deconnecter"><i class="lni-enter"></i> Se déconnecter</a></li>
            </ul>
        </li>
        <?php else: ?>
            <ul class="sign-in">
                <li class="nav-item dropdown">
                    <a href="Utilisateur/Login"  aria-haspopup="true" aria-expanded="false">
                        <i class="lni-user"></i> Se Connecter
                    </a>
                </li>
            </ul>
        <?php endif; ?>

    </ul>

</nav>