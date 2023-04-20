@extends('side')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Marge Beneficiaire</h5>
                    <form action="\updateMarge" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Taux %</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="marge" step="0.1" value="{{ $marge }}" required>
                            </div>
                        </div>
                        @if (isset($messages['success']))
                            <div style="color: lightgreen">{{ $messages['success'] }}</div>
                        @elseif (isset($messages['error']))
                            <div style="color: red">{{ $messages['error'] }}</div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
