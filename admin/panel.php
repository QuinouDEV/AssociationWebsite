<div class="dashboard-pg text-grey-blue">
    <nav class="navigation-bar d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="navigation-bar-left col-6 d-flex align-items-center">
                    <button type="button" class="navbar-open-btn text-grey-blue me-3">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="navigation-bar-right col-6 d-flex align-items-center justify-content-end">
                    <a href="#" class="profile-btn bg-blue text-white btn-circle me-3">
                        <i class="fas fa-user"></i>
                    </a>
                    <button type="button" class="notification-btn text-grey-blue">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="navigation-overlay position-fixed"></div>

    <div class="navigation-sidebar bg-light-grey">
        <div class="navbar-sb-head d-flex justify-content-between align-items-center px-4">
            <img src="../img/logo.png" width="100">
            <span>Justice Restaurative</span>
            <button class="navbar-close-btn text-grey-blue">
                <i class='fas fa-arrow-left'></i>
            </button>
        </div>

        <div class="navbar-sb-list p-4">
            <div class="navbar-sb-item mb-5">
                <h5 class="text-uppercase text-grey navbar-sb-item-title fs-12 ls-1">Informations Générales</h5>
                <ul class="navbar-sb-links p-0 list-unstyled">
                    <li class="navbar-sb-link my-3 nav-item">
                        <a href="dashboard.php"
                            class="text-decoration-none d-flex align-items-center justify-content-between">
                            <div class="text-light-blue d-flex align-items-center">
                                <span class="navbar-sb-icon me-3">
                                    <i class="fas fa-award"></i>
                                </span>
                                <span class="navbar-sb-text fs-14 fw-5 text-capitalize dashboard ">Dashboard</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-sb-item mb-5">
                <h5 class="text-uppercase text-grey navbar-sb-item-title fs-12 ls-1">Customs du site</h5>
                <ul class="navbar-sb-links p-0 list-unstyled">
                    <li class="navbar-sb-link my-3">
                        <a href="gestion_pages.php"
                            class="text-decoration-none d-flex align-items-center justify-content-between">
                            <div class="text-light-blue d-flex align-items-center">
                                <span class="navbar-sb-icon me-3">
                                    <i class="fa-solid fa-gauge"></i>
                                </span>
                                <span class="navbar-sb-text fs-14 fw-5 text-capitalize">Page Principale</span>
                            </div>
                        </a>
                    </li>
                    <li class="navbar-sb-link my-3">
                        <a href="forma.php"
                            class="text-decoration-none d-flex align-items-center justify-content-between">
                            <div class="text-light-blue d-flex align-items-center">
                                <span class="navbar-sb-icon me-3">
                                    <i class="fa-solid fa-spinner"></i>
                                </span>
                                <span class="navbar-sb-text fs-14 fw-5 text-capitalize">Formations</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-sb-item mb-5">
                <h5 class="text-uppercase text-grey navbar-sb-item-title fs-12 ls-1">Utilisateurs</h5>
                <ul class="navbar-sb-links p-0 list-unstyled">
                    <li class="navbar-sb-link my-3">
                        <a href="gestion_formateur.php" class="text-decoration-none d-flex align-items-center justify-content-between">
                            <div class="text-light-blue d-flex align-items-center">
                                <span class="navbar-sb-icon me-3">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </span>
                                <span class="navbar-sb-text fs-14 fw-5 text-capitalize">Gestion des formateurs</span>
                            </div>
                        </a>
                    </li>

                    <li class="navbar-sb-link my-3">
                        <a href="ajouter_admin.php"
                            class="text-decoration-none d-flex align-items-center justify-content-between">
                            <div class="text-light-blue d-flex align-items-center">
                                <span class="navbar-sb-icon me-3">
                                    <i class="fa-regular fa-circle-user"></i>
                                </span>
                                <span class="navbar-sb-text fs-14 fw-5 text-capitalize">Gestion des
                                    administrateurs</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-sb-item mb-5">
                <ul class="navbar-sb-links p-0 list-unstyled">
                    <li class="navbar-sb-link my-3">
                        <form action="../deco.php" method="post">
                            <button type="submit" name="deco"
                                class="text-decoration-none d-flex align-items-center justify-content-between deco">
                                <div class="text-light-blue d-flex align-items-center">
                                    <span class="navbar-sb-icon me-3">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <span class="navbar-sb-text fs-14 fw-5 text-capitalize">Déconnexion</span>
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.navbar-open-btn').click(function() {
            $('.navigation-sidebar').addClass('show-navigation-sidebar');
            $('.navigation-overlay').css('display', 'block');
        })

        $('.navbar-close-btn').click(function() {
            $('.navigation-sidebar').removeClass('show-navigation-sidebar');
            $('.navigation-overlay').css('display', 'none');
        })

        $(window).click(function(e) {
            if ($(e.target).hasClass('navigation-overlay')) {
                $('.navigation-sidebar').removeClass('show-navigation-sidebar');
                $('.navigation-overlay').css('display', 'none');
            }
        })

    });
</script>