@extends('header')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Formule
               { title }
                <p>

                </p>

            </h3>
            <table class="table">
                <tr>
                    <th>Matiere 1</th>
                    <th>Quantite</th>
                </tr>

            </table>
        </div>
    </div>
    <p>

        @include('message')
    </p>
    </body>
@endsection
@if (Route::is('test'))
@endif

</html>
