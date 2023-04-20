@extends('side')
@section('content')
<form action="/updateMouvement" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $mouvement->id }}">
    <div>Prix Unitaire : <input type="number" name="pu" step="0.01" value="{{ $mouvement->prixunitaire }}">Ar</div>
    <div>Quantite : <input type="number" name="quantite" value="{{ $mouvement->quantite }}"></div>
    <div>Date : <input type="date" name="date" value="{{ $mouvement->date }}"></div>
    <div>Produit :
        <select name="produit">
            <option></option>
            @foreach ($produits as $p)
                <option value="{{ $p->id }}" {{ $p->id == $mouvement->produitid ? 'selected' : '' }}>{{ $p->nom }}</option>
            @endforeach
        </select>
    </div>
    <div>Engard :
        <select name="engard" value="{{ $mouvement->engardid }}">
            <option></option>
            @foreach ($engards as $e)
                <option value="{{ $e->id }}" {{ $e->id == $mouvement->engardid ? 'selected' : '' }}>{{ $e->nom }}</option>
            @endforeach
        </select>
    </div>
    @if (isset($messages['success']))
        <div style="color: lightgreen">{{ $messages['success'] }}</div>
    @elseif (isset($messages['error']))
        <div style="color: red">{{ $messages['error'] }}</div>
    @endif
    <div><input type="submit" name="Modifier"></div>
</form>
@endsection
