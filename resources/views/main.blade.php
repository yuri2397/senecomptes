<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <title>Créer votre compte - Senecomte</title>
</head>

<body>
    <header>
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="main-menu f-right ">
                            <nav>
                                <ul id="navigation">
                                    @if (Request::is('profile') && Auth::user()->is_admin)
                                    <li><a href="/users">Utitlisateurs</a></li>
                                    @endif

                                    @if (!Auth::check())
                                    <li><a href="/register">Créer mon compte</a></li>
                                    @endif

                                    @if (!Request::is('profile') && Auth::check())
                                    <li><a href="/login"> {{ Auth::user()->name }}</a></li>
                                    <img width="50px" class="border border-1 rounded-circle shadow-4-strong" alt="avatar2" src="https://img.freepik.com/free-vector/illustration-businessman_53876-5856.jpg?w=826&t=st=1679746168~exp=1679746768~hmac=79261ffacae273f35f849bb11e9c5356b885c3a77717a63de6e578bbfd3f0606" />
                                    </a></li>
                                    @endif

                                    @if (Request::is('profile'))
                                    <li><a href="/logout">Se déconnecter</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            {{-- if user is login  --}}
                            @if (!Auth::check())
                                    <li><a href="/register">Créer mon compte</a></li>
                                    @endif
                            @if (!Auth::check())
                            <a href="/login" class="btn header-btn">Se connecter</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield("content")
</body>


<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>

<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<script src="./assets/js/jquery.slicknav.min.js"></script>

<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>

<script src="./assets/js/gijgo.min.js"></script>

<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<script src="./assets/js/jquery.scrollUp.min.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script src="assets/js/app.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');

</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vb26e4fa9e5134444860be286fd8771851679335129114" integrity="sha512-M3hN/6cva/SjwrOtyXeUa5IuCT0sedyfT+jK/OV+s+D0RnzrTfwjwJHhd+wYfMm9HJSrZ1IKksOdddLuN6KOzw==" data-cf-beacon='{"rayId":"7ac02bc3ba7bf5be","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.2.0","si":100}' crossorigin="anonymous"></script>
</html>
