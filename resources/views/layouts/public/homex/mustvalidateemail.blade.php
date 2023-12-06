@extends('layouts.public.homex.base')

@section('descendant-site')

    @include('layouts.public.homex.header-four')


    <section class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login_massage pb_60">
                        <h4 class="pb_20 color-primary">Köszönjük, hogy regisztráltál!</h4>
                        <p>
                            A folytatáshoz azonban vissza kell igazolnod a regisztrációnál megadott e-mail címed.<br>
                            Ehhez nézd meg a leveleid és kattints a megfelelő linkre a tőlünk kapott levélben!
                        </p>
                        <p><a class="btn btn-primary col-md-3" style="text-align: center;" href="{{ route('home') }}">Továbblépés a kezdőlapra</a></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('layouts.public.homex.footer')

@endsection
