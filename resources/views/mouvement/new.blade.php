@extends('side')
@section('content')
    <h2>Nouvelle entree</h2>
    <form action="/insertEntree" method="post">
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
        @if (isset($messages['success0']))
            <div style="color: lightgreen">{{ $messages['success0'] }}</div>
        @elseif (isset($messages['error0']))
            <div style="color: red">{{ $messages['error0'] }}</div>
        @endif
        <div><input type="submit" name="Enregistrer"></div>
    </form>

    <h2>Nouvelle sortie</h2>
    <form action="/insertSortie" method="post">
        @csrf
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
        @if (isset($messages['success1']))
            <div style="color: lightgreen">{{ $messages['success1'] }}</div>
        @elseif (isset($messages['error1']))
            <div style="color: red">{{ $messages['error1'] }}</div>
        @endif
        <div><input type="submit" name="Enregistrer"></div>
    </form>
@endsection
