@extends('side')
@section('content')
    <form action="/insertMouvement" method="post">
        @csrf
        <div>Prix Unitaire : <input type="number" name="pu" step="0.01">Ar</div>
        <div>Quantite : <input type="number" name="quantite"></div>
        <div>Date : <input type="date" name="date"></div>
        <div>Produit :
            <select name="produit">
                <option></option>
                @foreach ($produits as $p)
                    <option value="{{ $p->id }}">{{ $p->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>Engard :
            <select name="engard">
                <option></option>
                @foreach ($engards as $e)
                    <option value="{{ $e->id }}">{{ $e->nom }}</option>
                @endforeach
            </select>
        </div>
        @if (isset($messages['success']))
            <div style="color: lightgreen">{{ $messages['success'] }}</div>
        @elseif (isset($messages['error']))
            <div style="color: red">{{ $messages['error'] }}</div>
        @endif
        <div><input type="submit" name="Enregistrer"></div>
    </form>
@endsection
