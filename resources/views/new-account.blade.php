@extends('main')

@section('content')
<div class="active text-center p">
   <br>
    <div class="row">
        <div class="col-5 center">
            <div class="single-choose rounded rounded-4 p-5 active text-center mb-30" >
                <form action="/new-account" method="post">
                    @csrf
                    <div class="form-group ">
                        <label for="date" class="form-label lead">Choissir le nombre de mois pour votre abonnement</label>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" id="nb_month" type="radio" name="nb_month" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label lead" for="exampleRadios1">
                                1 mois x 2 500 FCFA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="nb_month"  type="radio" name="nb_month" id="exampleRadios2" value="2">
                            <label class="form-check-label lead" for="exampleRadios2">
                                2 mois x 2 500 FCFA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="nb_month" type="radio" name="nb_month" id="exampleRadios3" value="3">
                            <label class="form-check-label lead" for="exampleRadios3">
                                3 mois x 2 500 FCFA
                            </label>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit" >Finaliser l'abonnement</button>
                    </div>
                </form>
        
            </div>
        </div>
    </div>

</div>

@endsection
