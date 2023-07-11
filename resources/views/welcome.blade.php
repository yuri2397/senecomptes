   @extends('main')

   @section('content')

   <main>
       <div class="slider-area ">
           <div class="slider-active">
               <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.png">
                   <div class="container">
                       <div class="row d-flex align-items-center">
                           <div class="col-lg-7 col-md-9 ">
                               <div class="hero__caption">
                                   <h1 data-animation="fadeInLeft" data-delay=".4s">Senecompte<br> Économisez de l'argent</h1>
                                   <p data-animation="fadeInLeft" data-delay=".6s" class="lead">Profitez du partage de compte Netflix avec notre plan d'abonnement de base pour seulement <b>2 500 FCFA</b> par mois. Ce plan vous permet de partager votre compte avec une personne supplémentaire, ce qui vous permet de diviser les coûts et de profiter d'un contenu exclusif.
                                   </p>
                                   <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                                       @if (!Auth::check())
                                       <li><a href="/register" class="btn hero-btn">Créer mon compte</a></li>
                                       @else
                                       <li><a href="/login" class="btn hero-btn"> Voir mon profil </a></li>
                                       </a></li>
                                       @endif
                                   </div>
                               </div>
                           </div>
                           <div class="col-lg-5">
                               <div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
                                   <img src="assets/img/logo.svg" alt="">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.png">
                   <div class="container">
                       <div class="row d-flex align-items-center">
                           <div class="col-lg-7 col-md-9 ">
                               <div class="hero__caption">
                                   <h1 data-animation="fadeInLeft" data-delay=".4s">Senecompte<br> Économisez de l'argent</h1>
                                   <p data-animation="fadeInLeft" data-delay=".6s" class="lead">Profitez du partage de compte Netflix avec notre plan d'abonnement de base pour seulement <b>2 500 FCFA</b> par mois. Ce plan vous permet de partager votre compte avec une personne supplémentaire, ce qui vous permet de diviser les coûts et de profiter d'un contenu exclusif.
                                       <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                                           <a href="industries.html" class="btn hero-btn">Contact Us</a>
                                       </div>
                               </div>
                           </div>
                           <div class="col-lg-5">
                               <div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
                                   <img src="assets/img/logo.svg" alt="">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </main>

   @endsection
